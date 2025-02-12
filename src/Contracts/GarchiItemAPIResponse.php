<?php

namespace GarchiCMS\Contracts;

use GarchiCMS\Contracts\GarchiItem;
use GarchiCMS\Contracts\PaginationLinks;
use GarchiCMS\Contracts\PaginationMeta;

/**
 * Represents a paginated response for GarchiItems.
 */
class GarchiItemAPIResponse {
    /** @var GarchiItem[] */
    public array $data;
    public PaginationLinks $links;
    public PaginationMeta $meta;

    public function __construct(array $response) {
        $this->data = array_map(fn($item) => new GarchiItem($item), $response['data'] ?? []);
        $this->links = new PaginationLinks($response['links'] ?? []);
        $this->meta = new PaginationMeta($response['meta'] ?? []);
    }
}
