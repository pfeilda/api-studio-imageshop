<?php

namespace Apistudio\Imageshop\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Product
 * @package Apistudio\Imageshop\Domain\Model
 */
class Product extends AbstractEntity
{
    /**
     * @var double
     */
    protected $price = 0.0;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $media;

    /**
     * @var string
     */
    protected $name = "";

    /**
     * @var \Apistudio\Imageshop\Domain\Model\Collection
     */
    protected $collection;

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \Apistudio\Imageshop\Domain\Model\Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param \Apistudio\Imageshop\Domain\Model\Collection $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }
}