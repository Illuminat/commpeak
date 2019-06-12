<?php

namespace App\Services\Files;

final class GeoFile
{
    private static $instance;
    private $geoArray;

    private function __construct()
    {
        $file = __DIR__. '/../../../files/geofile.json';
        $this->geoArray = json_decode(file_get_contents($file), true);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getGeoArray()
    {
        return $this->geoArray;
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }
}

