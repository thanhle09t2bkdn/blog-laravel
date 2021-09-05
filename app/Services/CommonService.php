<?php


namespace App\Services;


use App\Traits\ConsumeExternalService;

class CommonService
{
    use ConsumeExternalService;

    /**
     * The base uri to consume authors service
     * @var string
     */
    public $baseUri;

    public function __construct()
    {
    }


    public function post($data, $url)
    {
        return $this->performRequest('POST', $url, $data);
    }

    public function get($data, $url)
    {
        return $this->performRequest('GET', $url, [], $data);
    }


}
