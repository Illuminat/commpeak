<?php
namespace App\Services\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

final class IpStack
{
    private $url = 'http://api.ipstack.com/';
    private $apiKey = 'ed09e98ccc0c3f163c4d575a764f3629';
    private $client;

    public function __construct($apiKey = null)
    {
        if (null !== $apiKey) {
            $this->apiKey = $apiKey;
        }
        $this->client = new Client();
    }


    /**
     * @param $ip
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function request($ip)
    {
        return $this->client->request('GET', $this->url . $ip . '?access_key=' . $this->apiKey)->getBody();
    }

}