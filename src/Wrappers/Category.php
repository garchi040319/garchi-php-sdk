<?php

namespace GarchiCMS\Wrappers;

use GarchiCMS\APIClient;
use GarchiCMS\Contracts\GarchiCategory;

/**
 * Wrapper for Category API endpoints.
 */
class Category {
    protected APIClient $client;

    public function __construct(APIClient $client) {
        $this->client = $client;
    }

    /**
     * Create a new category.
     *
     * @param array $params Category creation parameters.
     * @return GarchiCategory
     */
    public function create(array $params): GarchiCategory {
        $response = $this->client->request('POST', "/category", ['json' => $params]);
        return new GarchiCategory($response['data']);
    }

    /**
     * Delete a category.
     *
     * @param array $params Deletion parameters (requires space_uid and category_id).
     * @return string
     */
    public function delete(array $params): string {
        $endpoint = "/delete/category/{$params['space_uid']}/{$params['category_id']}";
        $response = $this->client->request('POST', $endpoint);
        return $response['data'];
    }

    /**
     * Update a category.
     *
     * @param array $params Update parameters (requires category_id, space_uid, and category data).
     * @return string
     */
    public function update(array $params): string {
        $endpoint = "/update/category/{$params['category_id']}";
        $response = $this->client->request('POST', $endpoint, ['json' => [
            'space_uid' => $params['space_uid'],
            'category' => $params['category']
        ]]);
        return $response['data'];
    }

    /**
     * Get all categories.
     *
     * @return GarchiCategory[]
     */
    public function getAll(): array {
        $response = $this->client->request('GET', "/categories");
        return array_map(fn($item) => new GarchiCategory($item), $response['data']);
    }
}
