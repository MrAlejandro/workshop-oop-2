<?php

namespace App\LocationProvider;

interface Locator
{
    public function getLocation(string $ip = null): array;
}
