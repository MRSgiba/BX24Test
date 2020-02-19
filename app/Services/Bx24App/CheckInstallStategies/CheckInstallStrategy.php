<?php

namespace App\Services\Bx24App\CheckInstallStategies;

interface CheckInstallStrategy
{
    public function checkInstall(): bool;
}