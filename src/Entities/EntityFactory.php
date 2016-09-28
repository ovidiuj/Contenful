<?php
namespace Entities;


use Interfaces\EntityFactoryInterface;
use Silex\Application;

/**
 * Class EntityFactory
 * @package Entities
 */
class EntityFactory implements EntityFactoryInterface
{

    /**
     * @var Human
     */
    private $entity;
    
    /**
     * EntityFactory constructor.
     * @param Application $app
     * @param $contentTypeId
     */
    public function __construct(Application $app, $contentTypeId)
    {
        switch ($contentTypeId) {
            case 'cat':
                $this->entity = new Cat($app);
                break;
            case '1t9IbcfdCk6m04uISSsaIK':
                $this->entity = new City($app);
                break;
            case 'dog':
                $this->entity = new Dog($app);
                break;
            case 'human':
                $this->entity = new Human($app);
                break;
        }
    }
    
    public function getEntity() {
        return $this->entity;
    }
}