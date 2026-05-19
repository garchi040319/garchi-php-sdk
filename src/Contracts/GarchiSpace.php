<?php

namespace GarchiCMS\Contracts;

/**
 * Represents a Space in GarchiCMS.
 */
class GarchiSpace {
    public string $uid;
    public string $name;
    public ?string $logo_url;
    public ?int $number_of_items;
    public ?string $agent_description;

    public function __construct(array $data) {
        $this->uid = $data['uid'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->logo_url = $data['logo_url'] ?? '';
        $this->number_of_items = $data['number_of_items'] ?? 0;
        $this->agent_description = $data['agent_description'] ?? '';
    }
}
