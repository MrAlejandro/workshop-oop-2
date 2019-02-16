<?php

namespace App;

use Docopt;

class App
{
    public function run()
    {
        $args = Docopt::handle($this->getDoc(), ['version' => 'GeoLocator 0.1.0']);
        $geoLocator = new GeoLocator();
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
