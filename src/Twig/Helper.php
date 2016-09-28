<?php

namespace Twig;


use Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Silex\Application;

/**
 * Class Helper
 * @package Twig
 */
class Helper
{
    /**
     * @param Application $app
     * @param $input
     * @return null
     */
    public static function getAssetUrl(Application $app, $input) {
        
        try {
            $requestUrl = str_replace(['{space}', '{token}', '{asset_id}'], [$app['space'], $app['token'], $input], $app['c.api']['assetApiUrl']);
            $httpClient = new Client();
            $res = $httpClient->request('GET', $requestUrl);
            $asset = json_decode($res->getBody());
            
            if(!empty($asset)) {
                return $asset->fields->file->url;
            }
        } catch (ClientException $e) {
            return new ApiException($e->getMessage());
        } catch (\Exception $e) {
            return new ApiException($e->getMessage());
        }
        return null;
    }

    /**
     * @param Application $app
     * @param $input
     * @return array
     */
    public static function getEntry(Application $app, $input) {
        try {
            $entryArr = [];
            $requestUrl = str_replace(['{space}', '{token}', '{entry_id}'], [$app['space'], $app['token'], $input], $app['c.api']['entryApiUrl']);
            $httpClient = new Client();
            $res = $httpClient->request('GET', $requestUrl);
            $entry = json_decode($res->getBody());

            if (!empty($entry)) {
                $entryArr['sys']['id'] = $entry->sys->id;
                $entryArr['name'] = $entry->fields->name;
                return $entryArr;
            }
        } catch (ClientException $e) {
            return new ApiException($e->getMessage());
        } catch (\Exception $e) {
            return new ApiException($e->getMessage());
        }
        return $entryArr;
            
    }
}