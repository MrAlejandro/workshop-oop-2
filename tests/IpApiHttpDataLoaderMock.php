<?php

namespace App\Tests;

use App\DataLoader\HttpLoader;

class IpApiHttpDataLoaderMock implements HttpLoader
{
    public function getResponseBody(string $url): string
    {
        $file_name = $this->getFileNameByUrl($url);
        $file_path = implode(DIRECTORY_SEPARATOR, [__DIR__, '/fixtures/', $file_name]);
        return file_get_contents($file_path);
    }

    protected function getFileNameByUrl(string $url)
    {
        $urlParts = explode('/', $url);
        $lastItemInPath = $urlParts[count($urlParts) - 1];

        $file_name = 'default_location.json';
        if ($this->isIpAddress($lastItemInPath)) {
            $file_name = str_replace('.', '_', $lastItemInPath) . '.json';
        }

        return $file_name;
    }

    protected function isIpAddress(string $str)
    {
        return filter_var($str, FILTER_VALIDATE_IP);
    }
}
