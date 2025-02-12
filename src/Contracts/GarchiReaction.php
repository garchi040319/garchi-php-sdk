<?php

namespace GarchiCMS\Contracts;

/**
 * Represents a Reaction to a GarchiCMS Item.
 */
class GarchiReaction {
    public string $reaction_id;
    public string $reaction;
    public string $user_identifier;
    public string $created_at;
    public string $updated_at;

    public function __construct(array $data) {
        $this->reaction_id = $data['reaction_id'] ?? '';
        $this->reaction = $data['reaction'] ?? '';
        $this->user_identifier = $data['user_identifier'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
    }
}
