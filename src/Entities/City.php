<?php

namespace Entities;
use Silex\Application;

/**
 * Class ity
 * @package Entities
 */
class City extends AbstractEntity
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $center = [];

    /**
     * City constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->contentTypeId = '1t9IbcfdCk6m04uISSsaIK';
    }

    /**
     * @param $entry
     */
    public function setProprieties($entry) {
        $this->id = $entry->sys->id;
        $this->name = $entry->fields->name;
        $this->center['lat'] = $entry->fields->center->lat;
        $this->center['lon'] = $entry->fields->center->lon;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $entryArr = [];
        $entryArr['entry']['name'] = $this->name;
        $entryArr['entry']['center']['lat'] = isset($this->center['lat']) ? $this->center['lat'] : null;
        $entryArr['entry']['center']['lon'] = isset($this->center['lon']) ? $this->center['lon'] : null;

        return $entryArr;
    }
}