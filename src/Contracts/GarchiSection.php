<?php
namespace GarchiCMS\Contracts;
/**
 * Represents a section in a GarchiCMS page.
 */

class GarchiSection {
    public string $id;
    public string $name;
    public ?string $description;
    public array $props; // Associative array of properties
    /** @var GarchiSection[] */
    public array $children;
    public int $order;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? null;
        $this->props = $data['props'] ?? [];
        $this->children = array_map(fn($section) => new GarchiSection($section), $data['children'] ?? []);
        $this->order = $data['order'] ?? 0;
    }
}
