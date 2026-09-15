<?php

namespace App\Services\EmailVerification;
use App\Models\EmailVerificationDomain;


class CatchAllChecker {

    public function __construct(
        protected SmtpChecker $smtpChecker
    ) {  }

    public function check(string $email, string $mxHost): array {

        $domain = substr(strrchr($email, '@'), 1);

        // Check cached domain result
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


        // Save / update domain result
        EmailVerificationDomain::updateOrCreate(
            [
                'domain' => $domain,
            ],
            [
                'catch_all' => $isCatchAll,
                'verified_at' => now(),
            ]
        );

        /*
        if ($smtpResult['status'] === 'accepted') {
            return [
                'is_catch_all' => true,
                'test_email' => $randomEmail,
                'smtp' => $smtpResult,
            ];
        }

        if ($smtpResult['status'] === 'rejected') {
            return [
                'is_catch_all' => false,
                'test_email' => $randomEmail,
                'smtp' => $smtpResult,
            ];
        }

        return [
            'is_catch_all' => null,
            'test_email' => $randomEmail,
            'smtp' => $smtpResult,
        ];

        */

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