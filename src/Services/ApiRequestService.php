<?php

namespace Services;

/**
 * Class ApiRequestService
 * @package Services
 */
class ApiRequestService
{
    /**
     * @var string
     */
    protected $requestUrl;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var string
     */
    protected $response;

    /**
     * ApiRequestService constructor.
     * @param $url
     * @param array $params
     */
    public function __construct($url, $params = [])
    {
        $replace = [];
        $replace[] = isset($params['space']) ? $params['space'] : null;
        $replace[] = isset($params['token']) ? $params['token'] : null;
        $replace[] = isset($params['asset_id']) ? $params['asset_id'] : null;
        $replace[] = isset($params['entry_id']) ? $params['entry_id'] : null;
        $this->requestUrl = str_replace(['{space}', '{token}', '{asset_id}', '{entry_id}'], $replace, $url);
    }

    /**
     * 
     */
    public function performRequest() {
        try {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->requestUrl);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            $this->response = curl_exec($ch);

            curl_close($ch);
        }
        catch (\Exception $e) {
            $this->errors['message'] = $e->getMessage();
            $this->errors['code'] = $e->getCode();
        }

    }

    /**
     * @return string
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }
}