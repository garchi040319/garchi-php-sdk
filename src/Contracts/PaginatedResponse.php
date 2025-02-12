<?php

namespace GarchiCMS\Contracts;

use GarchiCMS\Contracts\PaginationLinks;
use GarchiCMS\Contracts\PaginationMeta;

/**
 * Represents a paginated response.
 *
 * @template T
 */
class PaginatedResponse {
    /** @var array<T> */
    public array $data;
    public PaginationLinks $links;
    public PaginationMeta $meta;

    /**
     * PaginatedResponse constructor.
     * 
     * @param array $response API response data.
     * @param string $itemClass The class name of the item type (e.g., GarchiItem).
     */
    public function __construct(array $response, string $itemClass) {
        $this->data = array_map(fn($item) => new $itemClass($item), $response['data'] ?? []);
        $this->links = new PaginationLinks($response['links'] ?? []);
        $this->meta = new PaginationMeta($response['meta'] ?? []);
    }
}
