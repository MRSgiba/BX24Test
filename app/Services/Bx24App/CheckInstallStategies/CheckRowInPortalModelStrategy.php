<?php

namespace App\Services\Bx24App\CheckInstallStategies;

use App\Models\Bx24Portal;

class CheckRowInPortalModelStrategy implements CheckInstallStrategy
{
    /**
     * @var Bx24Portal
     */
    private $portal;

    public function setPortalModel(Bx24Portal $portal)
    {
        $this->portal = $portal;
    }

    public function checkInstall(): bool
    {
        if (!$this->portal) {
            throw new \Exception('You must specify portal model first');
        }

        return $this->portal->exists;
    }
}