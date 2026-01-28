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

    /**
     * Add a page to a space.
     *
     * @param array $params ['space_uid' => string, 'title' => string, 'path' => string, 'description' => string]
     * @return array
     * @throws \Exception
     */
    public function addPage(array $params): array {
        $payload = [
            'title' => $params['title'],
            'path' => $params['path'],
            'description' => $params['description'],
        ];

        $response = $this->client->request('POST', "/space/{$params['space_uid']}/create_page", [
            'json' => $payload
        ]);

        if (isset($response['error'])) {
            throw new \Exception($response['error']);
        }

        return $response['data'];
    }

    /**
     * Add a blank section to a page.
     *
     * @param array $params ['page_id' => string, 'section_template_id' => string, 'parent_id' => string|null]
     * @return array
     * @throws \Exception
     */
    public function addBlankSectionToPage(array $params): array {
        $payload = [
            'section_template_id' => $params['section_template_id'],
            'page_id' => $params['page_id'],
        ];

        if (!empty($params['parent_id'])) {
            $payload['parent_id'] = $params['parent_id'];
        }

        $response = $this->client->request('POST', "/page/add_blank_section", [
            'json' => $payload
        ]);

        if (isset($response['error'])) {
            throw new \Exception($response['error']);
        }

        return $response['data'];
    }

    
}
