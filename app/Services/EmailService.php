<?php


namespace App\Services;

use App\Contracts\EmailServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmailService implements EmailServiceInterface {

	public function send(array $recipient, string $subject, string $htmlContent, string $textContent = '')	{
		
		$apiUrl = env('INFINITO_API_URL');
        $clientId = env('INFINITO_CLIENT_ID'); 
        $clientPassword = env('INFINITO_CLIENT_PASSWORD');

        $concatenatedString = $clientId . ':' . $clientPassword;
        $encodedAuth = base64_encode($concatenatedString);

        $payload = [
            'apiver' => '1.0',
            'email' => [
                'ver' => '1.0',
                'messages' => [[
                    'id' => 'report-email-' . uniqid(),
                    'from' => [
                        'emailid' => 'noreply@staging.goforfit.in',
                        'name' => 'GoForFit Reports'
                    ],
                    'reply_to' => [
                        'emailid' => 'support@goforfit.in',
                        'name' => 'Support'
                    ],
                    'category' => 'Reports',
                    'content' => [
                        [
                            'type' => 'text/html',
                            'value' => $htmlContent
                        ]
                    ],
                    'addresses' => [
                        [
                            'subject' => $subject,
                            'to' => [
                                [
                                    'emailid' => $recipient['email'],
                                    'name' => $recipient['name']
                                ]
                            ]
                        ]
                    ]
                ]]
            ]
        ];


        try {
		    $response = Http::withHeaders([
	            'Authorization' => "Basic {$encodedAuth}",
	            'Content-Type' => 'application/json',
	        ])->post($apiUrl, $payload);

			$responseData = $response->json();

		    $error = $responseData['messageack']['guids'][0]['error'] ?? null;

		    //  Success condition: HTTP OK + no internal error
		    if ($response->successful() && !$error) {
		        Log::info("Email sent to {$recipient['email']} successfully.");
		        return true;
		    }

		    //  Infinito-level error present
		    if ($error) {
		        $errorCode = $error['errorcode'] ?? 'N/A';
		        $errorText = $error['errortext'] ?? 'Unknown error';

		        Log::error("Infinito email error for {$recipient['email']}: [{$errorCode}] {$errorText}");

		        echo "<pre>";
		        print_r([
		            'Error Code' => $errorCode,
		            'Error Text' => $errorText,
		        ]);
		        echo "</pre>";
		        //exit(); //  Remove in production
		    }

		    // Fallback error (unexpected structure)
		    Log::error("Email failed to {$recipient['email']}. Raw Response: " . $response->body());
		    return false;

		} catch (\Exception $e) {
		    Log::error("Infinito API Exception: " . $e->getMessage());
		    return false;
		}
	}
}



