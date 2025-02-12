<?php

namespace GarchiCMS\Wrappers;

use GarchiCMS\APIClient;
use GarchiCMS\Contracts\GarchiReview;
use GarchiCMS\Contracts\PaginatedResponse;

/**
 * Wrapper for Review API endpoints.
 */
class Review {
    protected APIClient $client;

    public function __construct(APIClient $client) {
        $this->client = $client;
    }

    /**
     * Create a new review.
     *
     * @param array $params Review creation parameters.
     * @return GarchiReview
     */
    public function create(array $params): GarchiReview {
        $response = $this->client->request('POST', "/reviews/item", ['json' => $params]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return new GarchiReview($response['data']);
    }

    /**
     * Update an existing review.
     *
     * @param array $params Review update parameters.
     * @return string
     */
    public function update(array $params): string {
        $response = $this->client->request('POST', "/reviews/edit", ['json' => $params]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return $response['message'];
    }

    /**
     * Delete a review.
     *
     * @param int $review_id Review ID to delete.
     * @return string
     */
    public function delete(int | string $review_id): string {
        $response = $this->client->request('POST', "/reviews/delete", [
            'json' => ['review_id' => $review_id]
        ]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return $response['message'];
    }

    /**
     * Get reviews for an item with pagination.
     *
     * @param int|string $item_id The ID of the item.
     * @param array $queryParams Pagination parameters.
     * @return PaginatedResponse<GarchiReview>
     */
    public function getByItem(int|string $item_id, array $queryParams): PaginatedResponse {
        $response = $this->client->request('GET', "/reviews/item/{$item_id}", ['query' => $queryParams]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return new PaginatedResponse($response, GarchiReview::class);
    }
}
