<?php

namespace Pdffiller\LaravelSlack;

use Closure;
use Illuminate\Support\Arr;
use Symfony\Component\Finder\Exception\AccessDeniedException;

/**
 * Class VerifySlackToken
 *
 * @package App\Http\Middleware
 */
class VerifySlackToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Allow only verified requests
        $payload = json_decode($request->get('payload'), true);
        $verificationToken = $request->get('token') ?? Arr::get($payload, 'token');
        if (!$verificationToken || $verificationToken !== config('laravel-slack-plugin.verification_token')) {
            throw new AccessDeniedException('Slack Verification token does not exist or is not valid');
        }
        return $next($request);
    }
}
