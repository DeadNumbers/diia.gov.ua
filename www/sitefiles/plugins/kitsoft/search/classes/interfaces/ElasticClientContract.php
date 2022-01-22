<?php
namespace KitSoft\Search\Classes\Interfaces;

interface ElasticClientContract
{
    public function searchTemplate(array $params);
    public function index(array $params);
    public function update(array $params);
    public function delete(array $params);
    public function checkIndexExist(array $params);
    public function createIndex(array $params);
    public function deleteIndex(array $params);
}