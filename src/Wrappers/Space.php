<?php

namespace GarchiCMS\Wrappers;

use GarchiCMS\APIClient;
use GarchiCMS\Contracts\GarchiCategory;
use GarchiCMS\Contracts\GarchiSpace;
use GarchiCMS\Contracts\PaginatedResponse;
use GuzzleHttp\Psr7\MultipartStream;

/**
 * Wrapper for Space API endpoints.
 */
class Space {
    protected APIClient $client;

    public function __construct(APIClient $client) {
        $this->client = $client;
    }

    /**
     * Get categories of a space.
     *
     * @param string $space_uid
     * @return GarchiCategory[]
     */
    public function categories(string $space_uid): array {
        $response = $this->client->request('GET', "/space/{$space_uid}/categories");

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return array_map(fn($item) => new GarchiCategory($item), $response['data'] ?? []);
    }

    /**
     * Get all spaces with pagination.
     *
     * @param array $params PaginateQueryParams
     * @return PaginatedResponse<GarchiSpace>
     */
    public function getAll(array $params): PaginatedResponse {
        $response = $this->client->request('GET', "/spaces", ['query' => $params]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return new PaginatedResponse($response, GarchiSpace::class);
    }

    /**
     * Get a specific space by UID.
     *
     * @param string $space_uid
     * @return GarchiSpace
     */
    public function get(string $space_uid): GarchiSpace {
        $response = $this->client->request('GET', "/space/{$space_uid}");

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return new GarchiSpace($response['data']);
    }

    /**
     * Create a new space.
     *
     * @param array $params ['name' => string, 'logo' => string (file path)]
     * @return GarchiSpace
     */
    public function create(array $params): GarchiSpace {
        $multipart = [];
        $multipart[] = ['name' => 'name', 'contents' => $params['name']];

        if (!empty($params['logo'])) {
            $multipart[] = [
                'name'     => 'logo',
                'contents' => fopen($params['logo'], 'r'),
                'filename' => basename($params['logo'])
            ];
        }

        $response = $this->client->request('POST', "/space", ['multipart' => $multipart]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return new GarchiSpace($response['data']);
    }

    /**
     * Update an existing space.
     *
     * @param string $space_uid
     * @param array $params ['name' => string, 'logo' => string (file path)]
     * @return string
     */
    public function update(string $space_uid, array $params): string {
        $multipart = [];

        if (!empty($params['name'])) {
            $multipart[] = ['name' => 'name', 'contents' => $params['name']];
        }

        if (!empty($params['logo'])) {
            $multipart[] = [
                'name'     => 'logo',
                'contents' => fopen($params['logo'], 'r'),
                'filename' => basename($params['logo'])
            ];
        }

        $response = $this->client->request('POST', "/update/space/{$space_uid}", ['multipart' => $multipart]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return $response['data'];
    }

    /**
     * Delete a space.
     *
     * @param string $space_uid
     * @return string
     */
    public function delete(string $space_uid): string {
        $response = $this->client->request('DELETE', "/delete/space/{$space_uid}");

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return $response['data'];
    }
}
