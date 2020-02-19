<?php

namespace App\Services\Bx24App;

use App\Services\Bx24App\CheckInstallStategies\CheckInstallStrategy;
use App\Services\Bx24App\InstallStrategies\InstallStrategy;

class Bx24AppService
{
    /**
     * @var InstallStrategy
     */
    private $installStrategy;
    /**
     * @var CheckInstallStrategy
     */
    private $checkInstallStrategy;

    public function setInstallStrategy(InstallStrategy $installStrategy): void
    {
        $this->installStrategy = $installStrategy;
    }

    public function setCheckInstallStrategy(CheckInstallStrategy $checkInstallStrategy): void
    {
        $this->checkInstallStrategy = $checkInstallStrategy;
    }

    public function install(): bool
    {
        if (!$this->installStrategy) {
            throw new \Exception('You must specify install strategy first');
        }

        return $this->installStrategy->install();
    }

    public function checkInstall(): bool
    {
        if (!$this->checkInstallStrategy) {
            throw new \Exception('You must specify check install strategy first');
        }

        return $this->checkInstallStrategy->checkInstall();
    }
}