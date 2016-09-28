<?php

namespace Entries;
use Silex\Application;

/**
 * Class AbstractEntry
 * @package Entities
 */
abstract class AbstractEntry implements EntryInterface
{

    /**
     * @var string
     */
    public $id;
    
    /**
     * @var string
     */
    public $contentTypeId;

    /**
     * @var Application
     */
    protected $app;
    
    /**
     * @param $contentTypeId
     * @param $entry
     */

    /**
     * AbstractEntry constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param $contentTypeId
     */
    public function renderTemplate() {
        $outputFileName = $this->id . '.html';
        print_r($this->toArray());
        $res = $this->app['twig']->render($this->contentTypeId . '.twig', $this->toArray());
        file_put_contents(OUTPUT_PATH . $outputFileName, $res);
    }

    /**
     * @return mixed
     */
    abstract public function toArray();

    /**
     * @param $entry
     * @return mixed
     */
    abstract public function setProprieties($entry);
    
}