<?php

namespace GarchiCMS\Wrappers;

use GarchiCMS\APIClient;
use GarchiCMS\Contracts\GarchiItem;
use GarchiCMS\Contracts\GarchiItemMeta;
use GarchiCMS\Contracts\GarchiItemAPIResponse;

class DataItem {
    protected APIClient $client;

    public function __construct(APIClient $client) {
        $this->client = $client;
    }

    public function create(array $params): GarchiItem {
        $response = $this->client->request('POST', "/item", ['json' => $params]);
        return new GarchiItem($response['data']);
    }

    public function delete(array $params): string {
        $response = $this->client->request('POST', "/delete/item", ['json' => $params]);
        return $response['data'];
    }

    public function update(array $params): string {
        $response = $this->client->request('POST', "/update/item", ['json' => $params]);
        return $response['data'];
    }

    public function createMetaInfo(array $params): array {
        $response = $this->client->request('POST', "/item_meta", ['json' => $params]);
        return array_map(fn($item) => new GarchiItemMeta($item), $response['data']);
    }

    public function deleteMetaInfo(array $params): string {
        $response = $this->client->request('POST', "/delete/item_meta", ['json' => $params]);
        return $response['data'];
    }

    public function updateMetaInfo(array $params): string {
        $response = $this->client->request('POST', "/update/item_meta", ['json' => $params]);
        return $response['data'];
    }

    public function getBySpace(array $params): GarchiItemAPIResponse {
        $response = $this->client->request('GET', "/space/{$params['uid']}/items", ['query' => $params]);
        return new GarchiItemAPIResponse($response);
    }

    public function semanticSearch(array $params): array {
        $response = $this->client->request('GET', "/items/semantic-search", ['query' => $params]);
        return array_map(fn($item) => new GarchiItem($item), $response['data']);
    }

    public function featured(array $params): GarchiItemAPIResponse {
        $response = $this->client->request('GET', "/items/featured", ['query' => $params]);
        return new GarchiItemAPIResponse($response);
    }

    public function get(array $params): GarchiItem {
        $response = $this->client->request('GET', "/item/{$params['item']}", ['query' => $params]);
        return new GarchiItem($response['data'][0]);
    }

    public function getAll(array $params): GarchiItemAPIResponse {
        $response = $this->client->request('GET', "/items", ['query' => $params]);
        return new GarchiItemAPIResponse($response);
    }

    public function filter(array $params): array {
        $response = $this->client->request('POST', "/items/filter", [
            'json' => $params['body'],
            'query' => $params['query']
        ]);
        return array_map(fn($item) => new GarchiItem($item), $response['data']);
    }

    public function filterByMeta(array $params): array {
        $response = $this->client->request('POST', "/items/filter/bymeta", [
            'json' => $params['body'],
            'query' => $params['query']
        ]);
        return array_map(fn($item) => new GarchiItem($item), $response['data']);
    }

    public function getByIds(array $params): GarchiItemAPIResponse {
        $response = $this->client->request('POST', "/items/byids", [
            'json' => $params['body'],
            'query' => $params['query']
        ]);
        return new GarchiItemAPIResponse($response);
    }
}
