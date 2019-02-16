<?php

namespace App;

use App\LocationProvider\Locator;

class GeoLocator
{
    protected $locator;

    public function __construct(Locator $locator)
    {
        $this->locator = $locator;
    }

    public function getLocation(string $ip = null)
    {
        return $this->locator->getLocation($ip);
    }
}
