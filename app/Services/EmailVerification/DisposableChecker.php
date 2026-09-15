<?php

namespace App\Services\EmailVerification;

use App\Models\DisposableEmailDomain;

class DisposableChecker
{
    public function check(string $email): bool
    {
        $domain = strtolower(
            substr(strrchr($email, '@'), 1)
        );

        return DisposableEmailDomain::where('domain', $domain)
            ->where('is_active', true)
            ->exists();
    }
}