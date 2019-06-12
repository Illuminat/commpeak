<?php

namespace App\Services;

use App\Services\Files\GeoFile;

class PhoneChecker {

    private $storage;

    public function __construct()
    {
        $geoArray = GeoFile::getInstance()->getGeoArray();
        foreach ($geoArray as $data) {
            if (empty($data['Phone'])) {
                continue;
            }
            $this->storage[$data['Phone']] = $data['Continent'];
        }
    }

    /**
     * @param $phone
     * @return string
     */
    public function getContinentByPhone($phone): string
    {
        foreach ($this->storage as $phoneMarker => $continent) {
            if (0 === strncmp($phone, $phoneMarker, strlen($phoneMarker))) {
                return $continent;
            }
        }
        return '';
    }
}