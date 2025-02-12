<?php

namespace GarchiCMS;


use GarchiCMS\Wrappers\DataItem;
use GarchiCMS\Wrappers\Category;
use GarchiCMS\Wrappers\Space;
use GarchiCMS\Wrappers\Review;
use GarchiCMS\Wrappers\Reaction;
use GarchiCMS\Wrappers\CompoundQuery;
use GarchiCMS\Wrappers\Headless;

class GarchiCMS {
    public $dataItem;
    public $category;
    public $space;
    public $review;
    public $reaction;
    public $compoundQuery;
    public $headless;

    public function __construct(string $apiKey, array $headers = []) {
        
        $client = new APIClient($apiKey, $headers);

        $this->dataItem = new DataItem($client);
        $this->category = new Category($client);
        $this->space = new Space($client);
        $this->review = new Review($client);
        $this->reaction = new Reaction($client);
        $this->compoundQuery = new CompoundQuery($client);
        $this->headless = new Headless($client);
    }
}
