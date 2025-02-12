<?php

namespace GarchiCMS\Contracts;

/**
 * Represents metadata for a GarchiCMS item.
 */
class GarchiItemMeta {
    public ?int $id;
    public string $key;
    public string $value;
    public string $type;

    /**
     * GarchiItemMeta constructor.
     *
     * @param array $data
     */
    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->key = $data['key'] ?? '';
        $this->value = $data['value'] ?? '';
        $this->type = $data['type'] ?? '';
    }
}
