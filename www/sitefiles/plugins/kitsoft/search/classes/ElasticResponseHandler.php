<?php namespace KitSoft\Search\Classes;

use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class ElasticResponseHandler
{
	protected $response;

	/**
	 * __construct
	 */
	public function __construct(array $response)
	{
		$this->response = $response;
		$this->validateResponse();
	}

	/**
	 * validateResponse
	 */
	protected function validateResponse()
	{
		if (!isset(
			$this->response['hits'],
			$this->response['hits']['hits'],
			$this->response['hits']['total'],
			$this->response['hits']['total']['value']
		)) {
			throw new Exception('Elastic response not valid.');
		}
	}

	/**
	 * getTotal
	 */
	public function getTotal()
	{
		return $this->response['hits']['total']['value'];
	}

	/**
	 * getCount
	 */
	public function getCount()
	{
		return count($this->getItems());
	}

	/**
	 * getSuggest
	 */
	public function getSuggest()
	{
		if (!$option = array_get($this->response, 'suggest.simple_phrase.0.options.0')) {
			return;
		}

		if (!array_get($option, 'collate_match')) {
			return;
		}

		return [
			'text' => array_get($option, 'text'),
			'highlighted' => array_get($option, 'highlighted')
		];
	}

	/**
	 * getItems
	 */
	public function getItems()
	{
		$result = [];

		foreach ($this->response['hits']['hits'] as $row) {
			$result[] = array_merge($row['_source'], [
				'highlights' => $row['highlight'] ?? null
			]);
		}

		return $result;

	}

	/**
	 * getFirst
	 */
	public function getFirst()
	{
		return array_first($this->getItems());
	}

	/**
	 * getAggregations
	 */
	public function getAggregations(string $type = null)
	{
		if ($type) {
			return array_get($this->response, "aggregations.{$type}.buckets");
		}

		return array_get($this->response, 'aggregations');
	}
}