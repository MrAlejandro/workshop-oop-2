<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use App\GeoLocator;
use App\LocationProvider\IpApi;
use App\DataLoader\HttpDataLoader;

class AppTest extends TestCase
{
    /** @var \App\GeoLocator */
    protected $geoLocator;

    public function setUp()
    {
        $dataLoader = new HttpDataLoader();
        $locator = new IpApi($dataLoader);
        $this->geoLocator = new GeoLocator($locator);
    }

    public function testGetNormalizedResponse()
    {
        $expected = [
            'country'   => 'Russia',
            'region'    => 'Perm',
            'city'      => 'Perm',
            'timezone'  => 'Asia/Yekaterinburg',
            'latitude'  => '58',
            'longitude' => '56.3167',
        ];

        $this->assertEquals($expected, $this->geoLocator->getLocation());
    }
}
