<?php

namespace GarchiCMS\Contracts;

/**
 * Represents a category in GarchiCMS.
 */
class GarchiCategory {
    public int $category_id;
    public string $name;
    public ?string $description;

    /**
     * GarchiCategory constructor.
     *
     * @param array $data
     */
    public function __construct(array $data) {
        $this->category_id = $data['category_id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? null;
    }
}
