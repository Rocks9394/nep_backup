<?php

namespace App\Services\EmailVerification;

class MxChecker
{
    public function check(string $email): array {

        $domain = substr(strrchr($email, '@'), 1);

        $mxHosts = [];
        $weights = [];

        $hasMx = getmxrr($domain, $mxHosts, $weights);

        if (!$hasMx || empty($mxHosts)) {
            return [
                'valid' => false,
                'host' => null,
            ];
        }

        return [
            'valid' => true,
            'host' => $mxHosts[0],
        ];
    }
}