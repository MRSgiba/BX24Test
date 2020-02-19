<?php

namespace App\Services\Bx24App\InstallStrategies;

interface InstallStrategy
{
    public function install(): bool;
}