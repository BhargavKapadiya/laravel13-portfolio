<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
	/**
	 * Handle an incoming request and add common security headers.
	 */
	public function handle(Request $request, Closure $next): Response
	{
		/** @var Response $response */
		$response = $next($request);

		$response->headers->set('X-Content-Type-Options', 'nosniff');
		$response->headers->set('X-Frame-Options', 'DENY');
		$response->headers->set('Referrer-Policy', 'no-referrer');
		$response->headers->set('Permissions-Policy', "accelerometer=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()");
		$response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
		$response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

		// Only send HSTS over HTTPS to avoid issues in local development
		if ($request->isSecure()) {
			$response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
		}

		// Use CSP in report-only mode initially to avoid breakage. Switch to enforced once validated.
		$response->headers->set('Content-Security-Policy-Report-Only', "default-src 'self'; img-src 'self' data: blob:; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'");

		return $response;
	}
}


