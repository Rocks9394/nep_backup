<?php

namespace App\Services\EmailVerification;
use App\Models\EmailVerification;


class EmailVerificationService {

    public function __construct(
        protected SyntaxChecker $syntaxChecker,
        protected DomainChecker $domainChecker,
        protected MxChecker $mxChecker,
        protected SmtpChecker $smtpChecker,
        protected CatchAllChecker $catchAllChecker,
        protected DisposableChecker $disposableChecker,
        protected RiskAnalyzer $riskAnalyzer
    ) {  }

    public function verify(string $email): array {

    	// Normalize email
    	$email = strtolower(trim($email));

    	// Check for recent verification
	    $recentVerification = EmailVerification::where('email', $email)
	        ->where('verified_at', '>=', now()->subDays(30))
	        ->latest('verified_at')
	        ->first();

	    if ($recentVerification) {
	        return $this->formatStoredResult($recentVerification);
	    }



        // 1. Syntax check
        $syntaxValid = $this->syntaxChecker->check($email);

        if (!$syntaxValid) {
            $verificationResult = [
                'email' => $email,
                'syntax_valid' => false,
                'domain_valid' => false,
                'mx_valid' => false,
                'mx_host' => null,
                'disposable' => false,
                'smtp' => null,
                'catch_all' => null,
            ];

            return $this->finalize($verificationResult);
        }

        // 2. Domain check
        $domainValid = $this->domainChecker->check($email);

        if (!$domainValid) {
            $verificationResult = [
                'email' => $email,
                'syntax_valid' => true,
                'domain_valid' => false,
                'mx_valid' => false,
                'mx_host' => null,
                'disposable' => false,
                'smtp' => null,
                'catch_all' => null,
            ];

            return $this->finalize($verificationResult);
        }

        // 3. MX check
        $mxResult = $this->mxChecker->check($email);

        if (!$mxResult['valid']) {
            $verificationResult = [
                'email' => $email,
                'syntax_valid' => true,
                'domain_valid' => true,
                'mx_valid' => false,
                'mx_host' => null,
                'disposable' => false,
                'smtp' => null,
                'catch_all' => null,
            ];

            return $this->finalize($verificationResult);
        }

        // 4. Disposable email check
        $disposable = $this->disposableChecker->check($email);

        if ($disposable) {
            $verificationResult = [
                'email' => $email,
                'syntax_valid' => true,
                'domain_valid' => true,
                'mx_valid' => true,
                'mx_host' => $mxResult['host'],
                'disposable' => true,
                'smtp' => null,
                'catch_all' => null,
            ];

            return $this->finalize($verificationResult);
        }

        // 5. SMTP check
        $smtpResult = $this->smtpChecker->check(
            $email,
            $mxResult['host']
        );

        // 6. Catch-all check
        $catchAllResult = null;

        if ($smtpResult['status'] === 'accepted') {
            $catchAllResult = $this->catchAllChecker->check(
                $email,
                $mxResult['host']
            );
        }

        // 7. Build complete verification result
        $verificationResult = [
            'email' => $email,
            'syntax_valid' => true,
            'domain_valid' => true,
            'mx_valid' => true,
            'mx_host' => $mxResult['host'],
            'disposable' => $disposable,
            'smtp' => $smtpResult,
            'catch_all' => $catchAllResult,
        ];

        return $this->finalize($verificationResult);
    }

    private function finalize(array $verificationResult): array {

	    // 8. Analyze risk
	    $riskResult = $this->riskAnalyzer->analyze(
	        $verificationResult
	    );

	    // Combine verification + risk result (9. Return complete result)
	    $result = array_merge(
	        $verificationResult,
	        $riskResult
	    );

	    // Save verification history
	    EmailVerification::create([
	        'email' => $result['email'],

	        'syntax_valid' => $result['syntax_valid'],
	        'domain_valid' => $result['domain_valid'],
	        'mx_valid' => $result['mx_valid'],

	        'mx_host' => $result['mx_host'] ?? null,

	        'disposable' => $result['disposable'],

	        'smtp_status' => $result['smtp']['status'] ?? null,
	        'smtp_code' => $result['smtp']['code'] ?? null,
	        'smtp_message' => $result['smtp']['message'] ?? null,

	        'catch_all' => $result['catch_all']['is_catch_all'] ?? null,

	        'risk_level' => $result['risk_level'],
	        'final_status' => $result['final_status'],

	        'risk_reasons' => $result['reasons'],

	        'verified_at' => now(),
	    ]);

	    return $result;
	}

	private function formatStoredResult( EmailVerification $verification ): array {
		
	    return [
	        'email' => $verification->email,

	        'syntax_valid' => $verification->syntax_valid,
	        'domain_valid' => $verification->domain_valid,
	        'mx_valid' => $verification->mx_valid,

	        'mx_host' => $verification->mx_host,

	        'disposable' => $verification->disposable,

	        'smtp' => $verification->smtp_status
	            ? [
	                'status' => $verification->smtp_status,
	                'code' => $verification->smtp_code,
	                'message' => $verification->smtp_message,
	            ]
	            : null,

	        'catch_all' => $verification->catch_all !== null
	            ? [
	                'is_catch_all' => $verification->catch_all,
	            ]
	            : null,

	        'risk_level' => $verification->risk_level,

	        'final_status' => $verification->final_status,

	        'reasons' => $verification->risk_reasons,

	        'verified_at' => $verification->verified_at,
	    ];
	}
}