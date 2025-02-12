<?php

namespace GarchiCMS\Contracts;

/**
 * Represents a GarchiCMS Asset.
 */
class GarchiAsset {
    public string $id;
    public string $path;
    public string $size;
    public string $type;

    /**
     * GarchiAsset constructor.
     *
     * @param array $data API response data.
     */
    public function __construct(array $data) {
        $this->id = $data['id'] ?? '';
        $this->path = $data['path'] ?? '';
        $this->size = $data['size'] ?? '';
        $this->type = $data['type'] ?? '';
    }
}
