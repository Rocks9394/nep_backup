<?php

namespace App\Services\EmailVerification;

class SyntaxChecker {
    
    public function check(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}