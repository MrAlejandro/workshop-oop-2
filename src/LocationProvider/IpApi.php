<?php

namespace App\LocationProvider;

use App\DataLoader\HttpDataLoader;
use App\DataLoader\HttpLoader;
use RuntimeException;

class IpApi implements Locator
{
    protected const SERVICE_URL = 'http://ip-api.com/json/';
    protected const RESPONSE_STATUS_FAIL = 'fail';

    protected $locationLoader;

    public function __construct(HttpLoader $locationLoader = null)
    {
        $this->locationLoader = $locationLoader ?: new HttpDataLoader();
    }

    public function getLocation(string $ip = null): array
    {
        $body = $this->getResponseBody($ip);
        if (!isset($body['status']) || $body['status'] === self::RESPONSE_STATUS_FAIL) {
            throw new RuntimeException('Cannot detect location');
        }

        $normalizedLocation = $this->getNormalizedLocation($body);
        return $normalizedLocation;
    }

    protected function getResponseBody($ip): array
    {
        $requestUrl = $this->prepareRequestUrl($ip);
        $rawBody = $this->locationLoader->getResponseBody($requestUrl);
        $body = json_decode($rawBody, true);

        return $body;
    }

    protected function prepareRequestUrl($ip)
    {
        return $ip ? self::SERVICE_URL . $ip : self::SERVICE_URL;
    }

    protected function getNormalizedLocation($response)
    {
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
