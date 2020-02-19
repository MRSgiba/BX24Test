<?php

namespace App\Services\Bx24App\InstallStrategies;

use App\Models\Bx24Portal;

class SaveToPortalModelStrategy implements InstallStrategy
{
    /**
     * @var Bx24Portal
     */
    private $portal;

    public function setPortalModel(Bx24Portal $portal)
    {
        $this->portal = $portal;
    }

    public function install(): bool
    {
        if (!$this->portal) {
            throw new \Exception('You must specify portal model first');
        }

        return $this->portal->save();
    }
}