<?php

namespace App\Services\EmailVerification;


class DomainChecker {
	
	public function check(string $email): bool {
		
        $domain = substr(strrchr($email, '@'), 1);

        return checkdnsrr($domain, 'A')
            || checkdnsrr($domain, 'AAAA')
            || checkdnsrr($domain, 'MX');
    }
}

?>