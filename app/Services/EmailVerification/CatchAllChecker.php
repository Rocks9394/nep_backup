<?php

namespace App\Services\EmailVerification;
use App\Models\EmailVerificationDomain;


class CatchAllChecker {

    public function __construct(
        protected SmtpChecker $smtpChecker
    ) {  }

    public function check(string $email, string $mxHost): array {


        $domain = substr(strrchr($email, '@'), 1);

        $cachedDomain = EmailVerificationDomain::where('domain', $domain)
            ->where('verified_at', '>=', now()->subDays(7))
            ->first();

        if ($cachedDomain) {
            return [
                'is_catch_all' => $cachedDomain->catch_all,
                'cached' => true,
            ];
        }


        // Generate random email for catch-all test
        $randomEmail = $this->generateRandomEmail($domain);

        // Perform SMTP check
        $smtpResult = $this->smtpChecker->check( $randomEmail, $mxHost);

        // Determine catch-all status
        if ($smtpResult['status'] === 'accepted') {
            $isCatchAll = true;
        } elseif ($smtpResult['status'] === 'rejected') {
            $isCatchAll = false;
        } else {
            $isCatchAll = null;
        }


        // Save domain result only when the check is conclusive
        if ($isCatchAll !== null) {
            EmailVerificationDomain::updateOrCreate(
                [
                    'domain' => $domain,
                ],
                [
                    'catch_all' => $isCatchAll,
                    'verified_at' => now(),
                ]
            );
        }

        return [
            'is_catch_all' => $isCatchAll,
            'test_email' => $randomEmail,
            'smtp' => $smtpResult,
            'cached' => false,
        ];

       
    }

    private function generateRandomEmail(string $domain): string {

        return 'verify_' . bin2hex(random_bytes(12)) . '@' . $domain;
    }
}