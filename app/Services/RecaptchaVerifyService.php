<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

/**
 * This service class is designed to verify reCAPTCHA Enterprise tokens.
 * It checks if reCAPTCHA is enabled, prepares the request to the reCAPTCHA Enterprise
 * API, and processes the response to determine if the verification was successful.
 */

class RecaptchaVerifyService
{
    public static function verifyRecaptcha($request)
    {
        // Add in config/services.php file and configure your reCAPTCHA Enterprise settings
        // 'recaptcha' => [
        //     'project_id' => env('RECAPTCHA_PROJECT_ID'),
        //     'api_key' => env('RECAPTCHA_API_KEY'),
        //     'site_key' => env('RECAPTCHA_SITE_KEY'),
        // ],

        // Ensure these environment variables are set in your .env file
        // RECAPTCHA_PROJECT_ID=your_project_id
        // RECAPTCHA_API_KEY=your_api_key
        // RECAPTCHA_SITE_KEY=your_site_key

        try {
            if (config('constant.recaptcha_enabled', false) === false) {
                return ['status' => 200, 'captcha' => "reCAPTCHA verification is disabled."];
            }

            $projectId = config('services.recaptcha.project_id');
            $apiKey = config('services.recaptcha.api_key');
            $siteKey = config('services.recaptcha.site_key');

            if (!$projectId || !$apiKey || !$siteKey) {
                Log::error('reCAPTCHA Enterprise configuration is missing.');
                return ['status' => 0, 'captcha' => 'reCAPTCHA configuration is not set properly.'];
            }

            // Define the expected action. This should match the action you set on the front-end.
            $expectedAction = $request->input('recaptcha_action') ?? 'contact';

            // --- Prepare the Request Data for the reCAPTCHA Enterprise API ---
            $remoteIp = $request->ip(); // To get the user's IP
            $userAgent = $request->userAgent();
            $recaptchaToken = $request->input('recaptcha');

            $url = "https://recaptchaenterprise.googleapis.com/v1/projects/$projectId/assessments?key=$apiKey";

            $payload = [
                'event' => [
                    'token' => $recaptchaToken,
                    'siteKey' => $siteKey,
                    'expectedAction' => $expectedAction,
                    'userIpAddress' => $remoteIp,
                    'userAgent' => $userAgent,
                ],
            ];

            try {
                $response = Http::post($url, $payload);

                // Check if the HTTP request itself failed
                if ($response->failed()) {
                    Log::error('reCAPTCHA Enterprise API call failed', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);
                    return ['status' => 0, 'captcha' => 'reCAPTCHA verification failed. Please try again.'];
                }

                $resultJson = $response->json();
            } catch (Exception $e) {
                // Handle network or other unexpected exceptions
                Log::error('reCAPTCHA Enterprise HTTP request exception', ['error' => $e->getMessage()]);
                return ['status' => 0, 'captcha' => 'reCAPTCHA verification failed due to a server error.'];
            }

            // --- Process the reCAPTCHA Enterprise API Response ---

            // Check if the reCAPTCHA token itself is valid
            if (!isset($resultJson['tokenProperties']['valid']) || !$resultJson['tokenProperties']['valid']) {
                $invalidReason = $resultJson['tokenProperties']['invalidReason'] ?? 'Unknown reason';
                Log::warning("reCAPTCHA Enterprise token invalid: $invalidReason", ['token' => $recaptchaToken]);
                return ['status' => 0, 'captcha' => "Invalid reCAPTCHA token: $invalidReason"];
            }

            // Get the score and action from the response
            $score = $resultJson['riskAnalysis']['score'] ?? 0;
            $action = $resultJson['tokenProperties']['action'] ?? '';

            // Check the score and action
            if ($score >= 0.5 && $action === $expectedAction) {
                return ['status' => 200, 'captcha' => "reCAPTCHA verification successful."];
            } else {
                return ['status' => 0, 'captcha' => "reCAPTCHA verification failed. Please try again."];
            }
        } catch (Exception $e) {
            report($e);
            return ['status' => 0, 'captcha' => "reCAPTCHA verification failed. Please try again."];
        }
    }
}
