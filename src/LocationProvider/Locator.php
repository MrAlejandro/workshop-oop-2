<?php

namespace App\LocationProvider;

use App\IpMetaInfo;

interface Locator
{
    public function getLocation(string $ip = null): IpMetaInfo;
}
