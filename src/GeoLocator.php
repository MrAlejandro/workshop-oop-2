<?php

namespace App;

use App\LocationProvider\IpApi;
use App\LocationProvider\Locator;

class GeoLocator
{
    protected $locator;

    public function __construct(Locator $locator = null)
    {
        $this->locator = $locator ?: new IpApi();
    }

    public function getLocation(string $ip = null)
    {
        return $this->locator->getLocation($ip);
    }
}
