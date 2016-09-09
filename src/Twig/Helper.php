<?php

namespace Twig;


use Services\ApiRequestService;
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
        $request = new ApiRequestService($app['c.api']['assetApiUrl'], ['space' => $app['space'], 'token' => $app['token'], 'asset_id' => $input] );
        $request->performRequest();
        $asset = json_decode($request->getResponse());

        if(!empty($asset)) {
            return $asset->fields->file->url;
        }

        return null;
    }

    /**
     * @param Application $app
     * @param $input
     * @return array
     */
    public static function getEntry(Application $app, $input) {
        $entryArr = [];
        $request = new ApiRequestService($app['c.api']['entryApiUrl'], ['space' => $app['space'], 'token' => $app['token'], 'entry_id' => $input]);
        $request->performRequest();
        $entry = json_decode($request->getResponse());

        if(!empty($entry)) {
            $entryArr['sys']['id'] = $entry->sys->id;
            $entryArr['name'] = $entry->fields->name;
            return $entryArr;
        }

        return $entryArr;
    }
}