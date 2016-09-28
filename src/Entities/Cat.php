<?php

namespace Entries;
use Silex\Application;

/**
 * Class Cat
 * @package Entities
 */
class Cat extends AbstractEntry
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
     * @var array
     */
    public $lives = [];

    /**
     * @var string
     */
    public $bestFriend;

    /**
     * Cat constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->contentTypeId = 'cat';
    }

    /**
     * @param $entry
     */
    public function setProprieties($entry) {
        $this->id = $entry->sys->id;
        $this->name = $entry->fields->name;
        $this->likes = $entry->fields->likes;
        $this->image = isset($entry->fields->image->sys->id) ? $entry->fields->image->sys->id : null;
        $this->lives = $entry->fields->lives;
        $this->bestFriend = isset($entry->fields->bestFriend->sys->id) ? $entry->fields->bestFriend->sys->id : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $entryArr = [];
        $entryArr['entry']['name'] = $this->name;
        $entryArr['entry']['likes'] = $this->likes;
        $entryArr['entry']['image'] = $this->image;
        $entryArr['entry']['lives'] = $this->lives;
        $entryArr['entry']['bestFriend'] = $this->bestFriend;
        
        return $entryArr;
    }
}