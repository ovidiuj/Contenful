<?php

namespace Entities;

/**
 * Interface EntryInterface
 * @package Entities
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