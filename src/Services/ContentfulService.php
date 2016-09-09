<?php

namespace Services;


use Silex\Application;

/**
 * Class ContentfulService
 * @package Services
 */
class ContentfulService
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @var mixed
     */
    private $config;

    /**
     * @var array
     */
    protected $entries;

    /**
     * @var array
     */
    protected $errors;

    /**
     * ContentfulService constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->config = $this->app['c.api'];
       
    }

    /**
     * @throws \Exception
     */
    protected function getEntries() {
        try {

            $request = new ApiRequestService($this->config['entriesApiUrl'], ['space' => $this->app['space'], 'token' => $this->app['token']]);
            $request->performRequest();
            $this->entries = json_decode($request->getResponse());
            $this->errors = $request->getErrors();
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function run() {
        $this->getEntries();
        if(!empty($this->entries)) {
            foreach ($this->entries->items as $key => $entry) {
                if($entry->sys->locale == 'en-US') {
                    switch ($entry->sys->contentType->sys->id) {
                        case 'cat':
                            $entryArr = $this->generateCatFields($entry);
                            $this->renderTemplate($entry->sys->contentType->sys->id, $entryArr);
                            break;
                        case '1t9IbcfdCk6m04uISSsaIK':
                            $entryArr = $this->generateCityFields($entry);
                            $this->renderTemplate($entry->sys->contentType->sys->id, $entryArr);
                            break;
                        case 'dog':
                            $entryArr = $this->generateDogFields($entry);
                            $this->renderTemplate($entry->sys->contentType->sys->id, $entryArr);
                            break;
                        case 'human':
                            $entryArr = $this->generateHumanFields($entry);
                            $this->renderTemplate($entry->sys->contentType->sys->id, $entryArr);
                            break;
                    }
                }

            }
        }
        return true;
    }

    /**
     * @param $entry
     * @return mixed
     */
    protected function generateCatFields($entry) {

        $entryArr['id'] = $entry->sys->id;
        $entryArr['entry']['name'] = $entry->fields->name;
        $entryArr['entry']['likes'] = $entry->fields->likes;
        $entryArr['entry']['image'] = isset($entry->fields->image->sys->id) ? $entry->fields->image->sys->id : null;
        $entryArr['entry']['lives'] = $entry->fields->lives;
        $entryArr['entry']['bestFriend'] = isset($entry->fields->bestFriend->sys->id) ? $entry->fields->bestFriend->sys->id : null;
        $entryArr['entry']['lives'] = $entry->fields->lives;

        return $entryArr;
    }

    /**
     * @param $entry
     * @return mixed
     */
    protected function generateCityFields($entry) {
        $entryArr['id'] = $entry->sys->id;
        $entryArr['entry']['name'] = $entry->fields->name;
        $entryArr['entry']['center']['lat'] = $entry->fields->center->lat;
        $entryArr['entry']['center']['lon'] = $entry->fields->center->lon;

        return $entryArr;
    }

    /**
     * @param $entry
     * @return mixed
     */
    protected function generateDogFields($entry) {
        $entryArr['id'] = $entry->sys->id;
        $entryArr['entry']['name'] = $entry->fields->name;
        $entryArr['entry']['image'] = $entry->fields->image->sys->id;
        $entryArr['entry']['description'] = $entry->fields->description;

        return $entryArr;
    }

    /**
     * @param $entry
     * @return mixed
     */
    protected function generateHumanFields($entry) {

        $entryArr['id'] = $entry->sys->id;
        $entryArr['entry']['name'] = $entry->fields->name;
        $entryArr['entry']['likes'] = $entry->fields->likes;
        $entryArr['entry']['image'] = isset($entry->fields->image->sys->id) ? $entry->fields->image->sys->id : null;
        $entryArr['entry']['description'] = $entry->fields->description;

        return $entryArr;
    }

    /**
     * @param $contentTypeId
     * @param $entry
     */
    protected function renderTemplate($contentTypeId, $entry) {
        $id = $entry['id'];
        unset($entry['id']);
        $outputFileName = $id . '.html';
        $res = $this->app['twig']->render($contentTypeId . '.twig', $entry);
        file_put_contents(OUTPUT_PATH . $outputFileName, $res);
    }
}