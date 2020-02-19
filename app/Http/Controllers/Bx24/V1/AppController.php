<?php

namespace App\Http\Controllers\Bx24\V1;

use App\Http\Controllers\Controller;
use App\Services\Bx24App\Bx24AppService;

class AppController extends Controller
{
    /**
     * @var Bx24AppService
     */
    private $appService;

    public function __construct(Bx24AppService $appService)
    {
        $this->appService = $appService;
    }

    public function index()
    {
        return view('bx24.v1.index');
    }
    
    public function install()
    {
        try {
            $isInstalledSuccessfully = $this->appService->install();
        } catch (\Exception $exception) {
            $isInstalledSuccessfully = false;
        }

        return view('bx24.v1.install', compact('isInstalledSuccessfully'));
    }
}
