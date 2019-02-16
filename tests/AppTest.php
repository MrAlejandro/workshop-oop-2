<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use App\GeoLocator;
use App\IpMetaInfo;
use RuntimeException;
use App\LocationProvider\IpApi;

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
        $locationData = [
            'country'   => 'Russia',
            'region'    => 'Perm',
            'city'      => 'Perm',
            'timezone'  => 'Asia/Yekaterinburg',
            'latitude'  => '58',
            'longitude' => '56.3167',
        ];

        $expected = new IpMetaInfo($locationData);
        $this->assertEquals($expected, $this->geoLocator->getLocation());
    }

    public function testGetLocationByIp()
    {
        $locationData = [
            'country'   => 'United States',
            'region'    => 'New Jersey',
            'city'      => 'North Bergen',
            'timezone'  => 'America/New_York',
            'latitude'  => '40.8054',
            'longitude' => '-74.0241',
        ];

        $expected = new IpMetaInfo($locationData);
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
