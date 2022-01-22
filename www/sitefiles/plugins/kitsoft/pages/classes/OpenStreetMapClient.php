<?php namespace KitSoft\Pages\Classes;

use Exception;
use GuzzleHttp\Client;
use KitSoft\Pages\Classes\Interfaces\OpenStreetMapClientInterface;

class OpenStreetMapClient implements OpenStreetMapClientInterface
{
    use \October\Rain\Support\Traits\Singleton;

    CONST URL = 'https://nominatim.openstreetmap.org/search';

    protected $client;

    /**
     * init
     */
    public function init()
    {
        $this->client = new Client();
    }

    /**
     * search
     * params: q OR street,city,county,state,country,postalcode
     */
    public function search(array $attributes)
    {
        try {
            $response = $this->client->request('GET', self::URL, [
                'query' => array_merge($attributes, [
                    'format' => 'json'
                ]),
                'timeout'  => 3,
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new Exception('Status code: ' . $response->getStatusCode());
            }

            $data = json_decode($response->getBody(), true);
        } catch (Exception $e) {
            trace_log($e);
            return;
        }

        return $data;
    }
}
