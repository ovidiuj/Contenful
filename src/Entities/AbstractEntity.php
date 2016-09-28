<?php

namespace Entities;
use Interfaces\EntityInterface;
use Silex\Application;

/**
 * Class AbstractEntity
 * @package Entities
 */
abstract class AbstractEntity implements EntityInterface
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
     * AbstractEntity constructor.
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
        $res = $this->app['twig']->render($this->contentTypeId . '.twig', $this->toArray());
        file_put_contents(OUTPUT_PATH . $outputFileName, $res);
    }

    /**
     * @return mixed
     */
    abstract public function toArray();

    /**
     * @param $entity
     * @return mixed
     */
    abstract public function setProprieties($entity);
    
}