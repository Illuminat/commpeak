<?php

namespace App\Services;

class FileCalculationManager
{
    public function calculate($file)
    {
        $phoneChecker = new PhoneChecker();
        $ipChecker = new IpChecker();

        $storage = [];
        $information = [
            'continentCountOfCalls' => 0,
            'continentSumOfMinutes' => 0,
            'allCountOfCalls' => 0,
            'allSumOfMinutes' => 0
        ];

        foreach ($this->readFile($file) as $data) {
            if (empty($data[0])) {
                continue;
            }

            if (!isset($storage[$data[0]])) {
                $storage[$data[0]] = $information;
            }
            $storage[$data[0]]['allSumOfMinutes'] += $data[2];
            $storage[$data[0]]['allCountOfCalls']++;

            try {
                $phoneContinent = $phoneChecker->getContinentByPhone($data[2]);
                $ipContinent = $ipChecker->getContinentByIp($data[4]);
                if ($phoneContinent === $ipContinent) {
                    $storage[$data[0]]['continentCountOfCalls']++;
                    $storage[$data[0]]['continentSumOfMinutes'] += $data[2];
                }
            } catch (\Exception $e) {

            }
        }

        return $storage;

    }

    private function readFile($file)
    {
        $handle = fopen($file, "r");

        while (!feof($handle)) {
            yield fgetcsv($handle);
        }

        fclose($handle);
    }

}