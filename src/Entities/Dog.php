<?php

namespace Entities;
use Silex\Application;

/**
 * Class Dog
 * @package Entities
 */
class Dog extends AbstractEntity
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $image;
    
    /**
     * @var string
     */
    public $description;

    /**
     * Dog constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->contentTypeId = 'dog';
    }

    /**
     * @param $entry
     */
    public function setProprieties($entry) {
        $this->id = $entry->sys->id;
        $this->name = $entry->fields->name;
        $this->image = isset($entry->fields->image->sys->id) ? $entry->fields->image->sys->id : null;
        $this->description = $entry->fields->description;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $entryArr = [];
        $entryArr['entry']['name'] = $this->name;
        $entryArr['entry']['image'] = $this->image;
        $entryArr['entry']['description'] = $this->description;

        return $entryArr;
    }
}