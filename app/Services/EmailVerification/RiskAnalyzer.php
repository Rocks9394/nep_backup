<?php

namespace App\Services\EmailVerification;

class RiskAnalyzer {

    public function analyze(array $result): array {
        
        $reasons = [];

        // Disposable email
        if ($result['disposable'] === true) {
            $reasons[] = 'Disposable email domain';
        }

        // SMTP rejected
        if (
            isset($result['smtp']['status'])
            && $result['smtp']['status'] === 'rejected'
        ) {
            $reasons[] = 'SMTP server rejected the recipient';
        }

        // SMTP unknown
        if (
            isset($result['smtp']['status'])
            && $result['smtp']['status'] === 'unknown'
        ) {
            $reasons[] = 'SMTP verification was inconclusive';
        }

        // Catch-all
        if (
            isset($result['catch_all']['is_catch_all'])
            && $result['catch_all']['is_catch_all'] === true
        ) {
            $reasons[] = 'Email domain appears to be catch-all';
        }

        // Invalid syntax
        if ($result['syntax_valid'] === false) {
            $reasons[] = 'Invalid email syntax';
        }

        // Invalid domain
        if ($result['domain_valid'] === false) {
            $reasons[] = 'Email domain does not exist';
        }

        // Invalid MX
        if ($result['mx_valid'] === false) {
            $reasons[] = 'No valid MX record found';
        }

        /*
         * Final decision
         */

        if (
            $result['syntax_valid'] === false
            || $result['domain_valid'] === false
            || $result['mx_valid'] === false
            || $result['disposable'] === true
            || (
                isset($result['smtp']['status'])
                && $result['smtp']['status'] === 'rejected'
            )
        ) {
            return [
                'risk_level' => 'high',
                'final_status' => 'undeliverable',
                'reasons' => $reasons,
            ];
        }

        if (
            isset($result['smtp']['status'])
            && $result['smtp']['status'] === 'unknown'
        ) {
            return [
                'risk_level' => 'medium',
                'final_status' => 'unknown',
                'reasons' => $reasons,
            ];
        }

        if (
            isset($result['catch_all']['is_catch_all'])
            && $result['catch_all']['is_catch_all'] === true
        ) {
            return [
                'risk_level' => 'medium',
                'final_status' => 'risky',
                'reasons' => $reasons,
            ];
        }

        return [
            'risk_level' => 'low',
            'final_status' => 'deliverable',
            'reasons' => $reasons,
        ];
    }
}