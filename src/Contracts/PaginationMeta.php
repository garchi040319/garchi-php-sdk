<?php

namespace GarchiCMS\Contracts;

/**
 * Represents pagination metadata.
 */
class PaginationMeta {
    public int $current_page;
    public int $from;
    public int $last_page;
    public array $links;
    public string $path;
    public int $per_page;
    public int $to;
    public int $total;

    public function __construct(array $data) {
        $this->current_page = $data['current_page'] ?? 1;
        $this->from = $data['from'] ?? 0;
        $this->last_page = $data['last_page'] ?? 1;
        $this->links = $data['links'] ?? [];
        $this->path = $data['path'] ?? '';
        $this->per_page = $data['per_page'] ?? 0;
        $this->to = $data['to'] ?? 0;
        $this->total = $data['total'] ?? 0;
    }
}
