<?php

namespace Services;


use Entities\EntityFactory;
use Entries\City;
use Entries\Cat;
use Entries\Dog;
use Entries\Human;
use Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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
     * @var Client
     */
    private $httpClient;

    /**
     * ContentfulService constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->config = $this->app['c.api'];
        $this->httpClient = new Client();
       
    }

    /**
     * @throws \Exception
     */
    protected function getEntries() {
        try {
            $requestUrl = str_replace(['{space}', '{token}'], [$this->app['space'], $this->app['token']], $this->config['entriesApiUrl']);
            $res = $this->httpClient->request('GET', $requestUrl);
            return json_decode($res->getBody());
        } catch (ClientException $e) {
            return new ApiException($e->getMessage());
        } catch (\Exception $e) {
            return new ApiException($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function run() {
        $entries = $this->getEntries();
        if(!empty($entries) && isset($entries->items)) {
            foreach ($entries->items as $key => $entry) {
                if($entry->sys->locale == 'en-US') {
                    $factory = new EntityFactory($this->app, $entry->sys->contentType->sys->id);
                    $entity = $factory->getEntity();
                    $entity->setProprieties($entry);
                    $entity->renderTemplate();
                }
            }
        }
        return true;
    }
}