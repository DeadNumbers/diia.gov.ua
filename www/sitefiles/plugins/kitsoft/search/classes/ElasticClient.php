<?php
namespace KitSoft\Search\Classes;

use Elasticsearch\ClientBuilder;
use KitSoft\Search\Classes\Interfaces\ElasticClientContract;
use KitSoft\Search\Models\Settings;

/**
* elasticsearch client implementation
*/
class ElasticClient implements ElasticClientContract
{
    public $client;

    public function __construct(string $logPath = null)
    {
        $client = ClientBuilder::create();

        if ($logPath) {
            $logger = ClientBuilder::defaultLogger($logPath);
            $client->setLogger($logger);
        }

        $settings = Settings::instance();

        $client->setHosts([$settings->elastic_host]);

        if ($settings->elastic_auth) {
            $client->setBasicAuthentication($settings->elastic_login, $settings->elastic_password);
        }

        $this->client = $client->build();
    }

    public function searchTemplate(array $params)
    {
        return $this->client->searchTemplate($params);
    }

    /**
     * put document at index
     * @param  array $params
     * @return array
     */
    public function index(array $params)
    {
        return $this->client->index($params);
    }

    /**
     * update document at index
     * @param  array $params
     * @return array
     */
    public function update(array $params)
    {
        return $this->client->update($params);
    }

    /**
     * get count of items
     * @param  array $params
     * @return array
     */
    public function count(array $params)
    {
        $response = $this->client->count($params);

        return $response['count'] ?? null;
    }

    /**
     * delete document from index
     * @param  array $params
     * @return array
     */
    public function delete(array $params)
    {
        return $this->client->delete($params);
    }

    public function checkIndexExist(array $params)
    {
        return $this->client->indices()->exists($params);
    }

    public function createIndex(array $params)
    {
        return $this->client->indices()->create($params);
    }

    public function deleteIndex(array $params)
    {
        return $this->client->indices()->delete($params);
    }
}
