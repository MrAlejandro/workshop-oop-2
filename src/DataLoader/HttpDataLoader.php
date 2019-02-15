<?php

namespace App\DataLoader;

use GuzzleHttp\Client;

class HttpDataLoader implements Loader
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get(string $url): string
    {
        $response = $this->client->get($url);
        $responseBody = $response->getBody();
        return $responseBody;
    }
}
