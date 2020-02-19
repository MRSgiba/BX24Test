<?php

namespace App\Http\Middleware;

use Bitrix24\App\App;
use Bitrix24\Application\Application as Bx24App;
use Bitrix24\Bitrix24;
use Closure;
use Illuminate\Support\Facades\Log;

class CheckBx24Connection
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isRequestValid = Bx24App::isRequestValid($request->all());
        $failStatus = config('bx24.status_on_middleware_fail');

        if (!$isRequestValid) {
            abort($failStatus);
        }

        $bx24 = app(Bitrix24::class);
        $bx24App = new App($bx24);

        try {
            $bx24App->info();
        } catch (\Throwable $e) {
            $logChannel = config('bx24.bad_requests_log_channel');
            Log::channel($logChannel)->error('Bad Bx24 Request', [
                'exception_text' => $e->getMessage(),
                'request_body' => $request->all(),
            ]);
            abort($failStatus);
        }

        return $next($request);
    }
}
