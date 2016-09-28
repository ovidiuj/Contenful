<?php

namespace Interfaces;

/**
 * Interface EntityInterface
 * @package Interfaces
 */
interface EntityInterface
{
    /**
     * @param $contentTypeId
     * @param $entry
     * @return mixed
     */
    public function renderTemplate();

    /**
     * @return mixed
     */
    public function toArray();

    /**
     * @param $entry
     * @return mixed
     */
    public function setProprieties($entry);
}