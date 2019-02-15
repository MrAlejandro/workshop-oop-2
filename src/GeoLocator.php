<?php

namespace App;

use App\LocationProvider\Locator;

class GeoLocator
{
    protected $url;
    protected $locator;

    public function __construct(Locator $locator)
    {
        $this->locator = $locator;
    }

    public function getLocation()
    {
        return $this->locator->getLocation();
    }
}
