<?php

namespace App\Http\Middleware;

use App\Services\Bx24App\Bx24AppService;
use Closure;
use Illuminate\Support\Facades\Log;

class CheckBx24Installed
{
    /**
     * @var Bx24AppService
     */
    private $appService;
    /**
     * @var string
     */
    private $installRoute;

    public function __construct(Bx24AppService $appService)
    {
        $this->appService = $appService;
        $this->installRoute = app('bx24_install_route');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isInstalled = false;

        try {
            $isInstalled = $this->appService->checkInstall();
        } catch (\Exception $exception) {
            $logChannel = config('bx24.bad_requests_log_channel');
            Log::channel($logChannel)->error('Bx24 install check fail', [
                'exception_text' => $exception->getMessage(),
                'request_body' => $request->all(),
            ]);

            abort(500);
        }

        if (!$isInstalled) {
            $needRedirect = config('bx24.redirect_on_fail_check_install');

            if ($needRedirect) {
                return redirect()->route($this->installRoute, request()->all());
            }

            $failStatus = config('bx24.status_on_middleware_fail');
            abort($failStatus);
        }

        return $next($request);
    }
}
