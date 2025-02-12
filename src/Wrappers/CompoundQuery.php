<?php

namespace GarchiCMS\Wrappers;

use GarchiCMS\APIClient;
use GarchiCMS\Contracts\GarchiCategory;
use GarchiCMS\Contracts\PaginatedResponse;
use GarchiCMS\Contracts\GarchiReview;
use GarchiCMS\Contracts\GarchiItemAPIResponse;


/**
 * Wrapper for Compound Query API endpoints.
 */
class CompoundQuery {
    protected APIClient $client;

    public function __construct(APIClient $client) {
        $this->client = $client;
    }

    /**
     * Perform a compound query on items, categories, or reviews.
     *
     * @param array $body Query body parameters.
     * @param array $params Query parameters.
     * @return GarchiItemAPIResponse|PaginatedResponse<GarchiReview | GarchiCategory>   
     * @throws \Exception
     */
    public function query(array $body, array $params): GarchiItemAPIResponse|PaginatedResponse {
        $response = $this->client->request('POST', "/compound_query", [
            'json'  => $body,
            'query' => $params
        ]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }
        print_r($response);
        // Determine the response type dynamically

        return match (true) {
            $body['dataset'] == 'items' => new GarchiItemAPIResponse($response),
            $body['dataset'] == 'categories' => new PaginatedResponse($response, GarchiCategory::class),
            $body['dataset'] == 'reviews' => new PaginatedResponse($response, GarchiReview::class),
            default => throw new \Exception("Invalid API Response: Could not determine response type.")
        };
    }
}
