<?php

namespace App;

class IpMetaInfo
{
    protected $country;
    protected $region;
    protected $city;
    protected $timezone;
    protected $latitude;
    protected $longitude;

    public function __construct(array $locationData)
    {
        $this->country   = $locationData['country'];
        $this->region    = $locationData['region'];
        $this->city      = $locationData['city'];
        $this->timezone  = $locationData['timezone'];
        $this->latitude  = $locationData['latitude'];
        $this->longitude = $locationData['longitude'];
    }

    public function __get($attrName)
    {
        return $this->{$attrName} ?? '';
    }
}
