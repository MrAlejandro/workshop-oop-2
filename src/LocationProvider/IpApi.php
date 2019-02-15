<?php

namespace App\LocationProvider;

use App\DataLoader\Loader;

class IpApi implements Locator
{
    protected const SERVICE_URL = 'http://ip-api.com/json/';

    protected $client;

    public function __construct(Loader $client)
    {
        $this->client = $client;
    }

    public function getLocation(string $ip = null): array
    {
        $responseBody = $this->client->get(self::SERVICE_URL);
        $response = json_decode($responseBody, true);
        return [
            'country'   => isset($response['country']) ? $response['country'] : '',
            'region'    => isset($response['regionName']) ? $response['regionName'] : '',
            'city'      => isset($response['city']) ? $response['city'] : '',
            'timezone'  => isset($response['timezone']) ? $response['timezone'] : '',
            'latitude'  => isset($response['lat']) ? $response['lat'] : '',
            'longitude' => isset($response['lon']) ? $response['lon'] : '',
        ];
    }
}
