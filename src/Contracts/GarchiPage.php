<?php
namespace GarchiCMS\Contracts;

use GarchiCMS\Contracts\GarchiSection;

/**
 * Represents a GarchiCMS page.
 */
class GarchiPage {
    public string $id;
    public string $title;
    public string $slug;
    public string $description;
    public string $image;
    /** @var GarchiSection[] */
    public array $sections;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? '';
        $this->title = $data['title'] ?? '';
        $this->slug = $data['slug'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->sections = array_map(fn($section) => new GarchiSection($section), $data['sections'] ?? []);
    }
}
