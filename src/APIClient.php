<?php

namespace GarchiCMS;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class APIClient {
    protected $client;

    public function __construct($apiKey, $headers = []) {
        $this->client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey,
                ...$headers
            ]
        ]);
    }

    public function request($method, $uri, $options = []) {
        try {
            $url = "https://garchi.co.uk/api/v2" . $uri;
            $response = $this->client->request($method, $url, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
