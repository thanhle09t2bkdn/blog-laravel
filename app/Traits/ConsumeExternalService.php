<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeExternalService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $queryParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $queryParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri'  =>  $this->baseUri,
        ]);

        if(isset($this->secret))
        {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUrl, [
            'form_params' => $formParams,
            'query' => $queryParams,
            'headers'     => $headers,
        ]);
        return $response->getBody()->getContents();
    }
}
