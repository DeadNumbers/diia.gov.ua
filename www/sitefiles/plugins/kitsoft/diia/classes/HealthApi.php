<?php namespace KitSoft\Diia\Classes;

use GuzzleHttp\Client;
use Exception;

class HealthApi
{
    use \October\Rain\Support\Traits\Singleton;

    protected $client;

    /**
     * init
     */
    public function init()
    {
        $this->client = new Client(['verify' => false ]);
    }

    /**
     * request
     */
    public function request($items)
    {
        try {
            if (!$api = env('HEALTH_API')) {
                throw new Exception('Api is not configured.');
            }
            if (!$key = env('HEALTH_TOKEN')) {
                throw new Exception('Api is not configured.');
            }

            $response = $this->client->request('GET', $api, [
                'query' => array_merge($items, [
                    'format' => 'json'
                ]),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                    'Authorization' => 'Basic ' . $key,
//                    'X-Auth-Token' => $key
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
            }

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        return $data;
    }
}
