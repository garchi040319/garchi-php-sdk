<?php


namespace GarchiCMS\Contracts;

use GarchiCMS\Contracts\GarchiCategory;
use GarchiCMS\Contracts\GarchiItemMeta;
use GarchiCMS\Contracts\GarchiAttribute;
use GarchiCMS\Contracts\GarchiSpace;
use GarchiCMS\Contracts\GarchiReaction;

/**
 * Represents a GarchiCMS Item.
 */
class GarchiItem {
    public int $item_id;
    public string $slug;
    public ?string $sku;
    public string $name;
    public ?int $stock;
    /** @var GarchiCategory[] */
    public array $categories;
    public ?float $price;
    public ?string $external_link;
    public ?float $scratched_price;
    public ?string $one_liner;
    public ?string $description;
    public ?string $delivery_type;
    public ?string $main_image;
    /** @var string[] */
    public array $other_images;
    /** @var GarchiAttribute[] */
    public array $attributes;
    public ?GarchiSpace $space;  // GarchiSpace object
    public ?float $avg_rating;
    public ?string $scheduled_for;
    /** @var GarchiItemMeta[] */
    public array $item_meta;
    /** @var GarchiReaction[] */
    public array $reactions;
    public ?string $created;
    public ?string $updated;

    public function __construct(array $data) {
        $this->item_id = $data['item_id'] ?? 0;
        $this->slug = $data['slug'] ?? '';
        $this->sku = $data['sku'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->stock = $data['stock'] ?? null;
        $this->categories = $data['categories'] ?? [];
        $this->price = $data['price'] ?? null;
        $this->external_link = $data['external_link'] ?? null;
        $this->scratched_price = $data['scratched_price'] ?? null;
        $this->one_liner = $data['one_liner'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->delivery_type = $data['delivery_type'] ?? null;
        $this->main_image = $data['main_image'] ?? null;
        $this->other_images = $data['other_images'] ?? [];
        $this->attributes = isset($data['attributes']) ? array_map(fn($attr) => new GarchiAttribute($attr), $data['attributes']) : [];

        // Convert space to GarchiSpace object if provided
        $this->space = isset($data['space']) && is_array($data['space']) ? new GarchiSpace($data['space']) : null;

        $this->avg_rating = $data['avg_rating'] ?? null;
        $this->scheduled_for = $data['scheduled_for'] ?? null;
        $this->item_meta = isset($data['item_meta']) ? array_map(fn($meta) => new GarchiItemMeta($meta), $data['item_meta']) : [];
        $this->reactions = isset($data['reactions']) ? array_map(fn($reaction) => new GarchiReaction($reaction), $data['reactions']) : [];
        $this->created = $data['created'] ?? null;
        $this->updated = $data['updated'] ?? null;
    }
}