<?php

namespace GarchiCMS\Contracts;

/**
 * Represents an Attribute of a GarchiCMS Item.
 */
class GarchiAttribute {
    public string $key;
    public string $value;
    public ?string $type;

    public function __construct(array $data) {
        $this->key = $data['key'] ?? '';
        $this->value = $data['value'] ?? '';
        $this->type = $data['type'] ?? null;
    }
}
