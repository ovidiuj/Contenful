<?php

namespace Entities;
use Silex\Application;

/**
 * Class Cat
 * @package Entities
 */
class Human extends AbstractEntity
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $likes = [];

    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $description;

    /**
     * Human constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->contentTypeId = 'human';
    }

    /**
     * @param $entry
     */
    public function setProprieties($entry) {
        $this->id = $entry->sys->id;
        $this->name = $entry->fields->name;
        $this->image = isset($entry->fields->image->sys->id) ? $entry->fields->image->sys->id : null;
        $this->description = $entry->fields->description;
        $this->likes = $entry->fields->likes;
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
        $entryArr['entry']['likes'] = $this->likes;

        return $entryArr;
    }
}