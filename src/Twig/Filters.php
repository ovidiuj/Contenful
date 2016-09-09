<?php

namespace Twig;


use Silex\Application;

/**
 * Class Filters
 * @package Twig
 */
class Filters extends \Twig_Extension
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * Filters constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'filters';
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            'get_asset_url' => new \Twig_Filter_Method($this, 'get_asset_url'),
            'get_entry' => new \Twig_Filter_Method($this, 'get_entry')
        ];
    }

    /**
     * @param $input
     * @return null
     */
    public function get_asset_url($input)
    {
        return Helper::getAssetUrl($this->app, $input );
    }

    /**
     * @param $input
     * @return array
     */
    public function get_entry($input)
    {
        return Helper::getEntry($this->app, $input );
    }
}