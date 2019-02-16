<?php

namespace App;

use Docopt;
use App\LocationProvider\IpApi;
use App\DataLoader\HttpDataLoader;

class App
{
    public function run()
    {
        $args = Docopt::handle($this->getDoc(), ['version' => 'GeoLocator 0.1.0']);
        $dataLoader = new HttpDataLoader();
        $dataProvider = new IpApi($dataLoader);
        $geoLocator = new GeoLocator($dataProvider);
        $geoData = $geoLocator->getLocation($args->args['<ip>'] ?: null);
        return $geoData;
    }

    protected function getDoc()
    {
        return <<<DOC
Get geographical location data

Usage:
    get-geo [<ip>]
    get-geo (-h|--help)
    
Options:
    -h --help                     Show this screen
DOC;
    }
}
