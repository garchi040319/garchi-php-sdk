<?php

namespace GarchiCMS\Wrappers;

use GarchiCMS\APIClient;
use GarchiCMS\Contracts\GarchiReaction;

/**
 * Wrapper for Reaction API endpoints.
 */
class Reaction
{
    protected APIClient $client;

    public function __construct(APIClient $client)
    {
        $this->client = $client;
    }

    /**
     * Manage reactions for an item.
     *
     * @param array $params Reaction creation parameters.
     * @return GarchiReaction
     */
    public function manage(array $params): GarchiReaction | string
    {
        $response = $this->client->request('POST', "/manage-reaction", ['json' => $params]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }
        if (isset($response['message'])) {
            return $response['message'];
        }
        return new GarchiReaction($response['data']);
    }
}
