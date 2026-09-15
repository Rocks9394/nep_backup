<?php

namespace App\Services\EmailVerification;

class SmtpChecker {

    public function check(string $email, string $mxHost): array {
        
        $socket = @fsockopen($mxHost, 25, $errno, $errstr, 10);

        if (!$socket) {
            return [
                'status' => 'unknown',
                'code' => null,
                'message' => 'Could not connect to SMTP server',
            ];
        }

        stream_set_timeout($socket, 10); 


        // 1. Read SMTP greeting
        $response = $this->readResponse($socket);

        if (!$this->isSuccessfulResponse($response)) {
            fclose($socket);

            return [
                'status' => 'unknown',
                'code' => $this->getCode($response),
                'message' => trim($response),
            ];
        }



        // 2. Introduce ourselves
        fwrite($socket, "EHLO nep.goforfit.in\r\n");

        $response = $this->readResponse($socket);

        if (!$this->isSuccessfulResponse($response)) {
            $this->quit($socket);

            return [
                'status' => 'unknown',
                'code' => $this->getCode($response),
                'message' => trim($response),
            ];
        }


        // 3. Tell SMTP server who the sender is
        fwrite(
            $socket,
            "MAIL FROM:<verify@nep.goforfit.in>\r\n"
        );

        $response = $this->readResponse($socket);

        if (!$this->isSuccessfulResponse($response)) {
            $this->quit($socket);

            return [
                'status' => 'unknown',
                'code' => $this->getCode($response),
                'message' => trim($response),
            ];
        }

        // 4. Ask whether recipient is accepted
        fwrite(
            $socket,
            "RCPT TO:<{$email}>\r\n"
        );

        $response = $this->readResponse($socket);

        $code = $this->getCode($response);

        // 5. Close SMTP connection
        $this->quit($socket);

         // Permanent rejection
        if ($code >= 500 && $code < 600) {
            return [
                'status' => 'rejected',
                'code' => $code,
                'message' => trim($response),
            ];
        }

        // Accepted
        if ($code >= 200 && $code < 300) {
            return [
                'status' => 'accepted',
                'code' => $code,
                'message' => trim($response),
            ];
        }

        // Temporary / unexpected response
        return [
            'status' => 'unknown',
            'code' => $code,
            'message' => trim($response),
        ];

    }

    private function readResponse($socket): string {

        $response = '';

        while (($line = fgets($socket)) !== false) {
            $response .= $line;

            // SMTP multiline response ends when
            // character 4 is a space.
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }

        return $response;
    }

    private function getCode(string $response): ?int {

        if (strlen($response) < 3) {
            return null;
        }

        $code = substr($response, 0, 3);

        if (!ctype_digit($code)) {
            return null;
        }

        return (int) $code;
    }

    private function isSuccessfulResponse(string $response): bool {

        $code = $this->getCode($response);

        return $code !== null
            && $code >= 200
            && $code < 400;
    }

    private function quit($socket): void {
        
        fwrite($socket, "QUIT\r\n");

        // We don't need the response here.
        $this->readResponse($socket);

        fclose($socket);
    }
}