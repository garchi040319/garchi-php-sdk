<?php

namespace GarchiCMS\Contracts;

/**
 * Represents a Review in GarchiCMS.
 */
class GarchiReview {
    public int $review_id;
    public string $review_body;
    public int $rating;
    public ?array $guest; // Keeping null structure as given in TypeScript
    public array $user;
    public int $item_id;
    public string $reviewed_at;
    /** @var GarchiReview[]|null */
    public ?array $replies;
    /** @var GarchiReaction[]|null */
    public ?array $reactions;

    public function __construct(array $data) {
        $this->review_id = $data['review_id'] ?? 0;
        $this->review_body = $data['review_body'] ?? '';
        $this->rating = $data['rating'] ?? 0;
        $this->guest = $data['guest'] ?? null;
        $this->user = $data['user'] ?? ['fname' => '', 'lname' => ''];
        $this->item_id = $data['item_id'] ?? 0;
        $this->reviewed_at = $data['reviewed_at'] ?? '';
        $this->replies = isset($data['replies']) ? array_map(fn($r) => new GarchiReview($r), $data['replies']) : null;
        $this->reactions = isset($data['reactions']) ? array_map(fn($r) => new GarchiReaction($r), $data['reactions']) : null;
    }
}
