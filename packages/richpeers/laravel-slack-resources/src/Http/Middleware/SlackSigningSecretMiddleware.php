<?php

namespace Richpeers\LaravelSlackResources\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;

class SlackSigningSecretMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $version = 'v0';
        $secret = config('services.slack.signing_secret');
        $body = $request->getContent();
        $timestamp = $request->header('X-Slack-Request-Timestamp');
        $remoteSignature = $request->header('X-Slack-Signature');

        // check timestamp is within slack api timeout
        if (Carbon::now()->diffInMinutes(Carbon::createFromTimestamp($timestamp)) > 5) {
            throw new \Exception('Invalid timestamp');
        }

        // local signature
        $sigBaseString = "{$version}:{$timestamp}:{$body}";
        $hash = \hash_hmac('sha256', $sigBaseString, $secret);
        $localSignature = "{$version}={$hash}";

        // check local and remote signatures match
        if ($remoteSignature !== $localSignature) {
            throw new \Exception("Invalid signature");
        }

        return $next($request);
    }
}
