<?php

namespace App\Services;

use App\Services\Api\IpStack;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class IpChecker
{
    private $api;

    public function __construct()
    {
        $this->api = new IpStack();
    }

    /**
     * @param $ip
     * @return string
     * @throws GuzzleException
     */
    public function getContinentByIp($ip): string
    {
        try {
            /** @var StreamInterface $response */
            $response = $this->api->request($ip);
            $content = json_decode($response->getContents(), true);

            if (!empty($content['continent_code'])) {
                return $content['continent_code'];
            }

            throw new Exception($content['error']['info']);
        } catch (Exception $e) {
            throw new Exception('Something wrong with Api of Ip: ' . $e->getMessage());
        }

    }


}