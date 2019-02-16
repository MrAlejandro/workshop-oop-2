<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use App\GeoLocator;
use App\LocationProvider\IpApi;
use RuntimeException;

class AppTest extends TestCase
{
    /** @var \App\GeoLocator */
    protected $geoLocator;

    public function setUp()
    {
        $dataLoader = new IpApiHttpDataLoaderMock();
        $locator = new IpApi($dataLoader);
        $this->geoLocator = new GeoLocator($locator);
    }

    public function testGetDefaultLocation()
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

    public function testGetLocationByIp()
    {
        $expected = [
            'country'   => 'United States',
            'region'    => 'New Jersey',
            'city'      => 'North Bergen',
            'timezone'  => 'America/New_York',
            'latitude'  => '40.8054',
            'longitude' => '-74.0241',
        ];

        $ip = '206.189.199.81';
        $this->assertEquals($expected, $this->geoLocator->getLocation($ip));
    }

    public function testThrowExceptionForNonDetectableIp()
    {
        $this->expectException(RuntimeException::class);

        $nonDetectableIp = '127.0.0.1';
        $this->geoLocator->getLocation($nonDetectableIp);
    }
}
