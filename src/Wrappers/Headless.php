<?php

namespace GarchiCMS\Wrappers;

use GarchiCMS\APIClient;
use GarchiCMS\Contracts\GarchiAsset;
use GarchiCMS\Contracts\GarchiPage;

/**
 * Wrapper for Headless API endpoints.
 */
class Headless {
    protected APIClient $client;

    public function __construct(APIClient $client) {
        $this->client = $client;
    }

    /**
     * Get an asset from a space.
     *
     * @param string $file_name The name of the file.
     * @param string $space_uid The UID of the space.
     * @return GarchiAsset
     * @throws \Exception
     */
    public function getAsset(string $file_name, string $space_uid): GarchiAsset {
        $response = $this->client->request('GET', "/space/assets/{$file_name}", [
            'query' => ['space_uid' => $space_uid]
        ]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return new GarchiAsset($response);
    }

    /**
     * Get a page from the headless CMS.
     *
     * @param array $params GetPageParams.
     * @return GarchiPage
     * @throws \Exception
     */
    public function getPage(array $params): GarchiPage {
        $response = $this->client->request('POST', "/page", ['json' => $params]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return new GarchiPage($response);
    }

    /**
     * Create or update section templates.
     *
     * @param array $params CreateOrUpdateSectionTemplateParams.
     * @return string
     * @throws \Exception
     */
    public function createOrUpdateSectionTemplates(array $params): string {
        $response = $this->client->request('POST', "/section_template", ['json' => $params]);

        if (isset($response['error'])) {
            throw new \Exception("API Error: " . $response['error']);
        }

        return $response;
    }
}
