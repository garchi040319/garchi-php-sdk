<?php

namespace GarchiCMS\Contracts;

/**
 * Represents pagination link structure.
 */
class PaginationLinks {
    public string $first;
    public string $last;
    public ?string $prev;
    public ?string $next;

    public function __construct(array $data) {
        $this->first = $data['first'] ?? '';
        $this->last = $data['last'] ?? '';
        $this->prev = $data['prev'] ?? null;
        $this->next = $data['next'] ?? null;
    }
}
