<?php

namespace Apistudio\Imageshop\Domain\Model;


use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Collection
 * @package Apistudio\Imageshop\Domain\Model
 */
class Collection extends AbstractEntity
{
    /**
     * @var string
     */
    protected $name = "";
    /**
     * @var string
     */
    protected $location;
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Apistudio\Imageshop\Domain\Model\Product>
     */
    protected $products;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $previewimage;

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
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Apistudio\Imageshop\Domain\Model\Product>
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Apistudio\Imageshop\Domain\Model\Product> $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @param \Apistudio\Imageshop\Domain\Model\Product $product
     */
    public function addProduct($product)
    {
        $this->products->attach($product);
    }

    /**
     * @param \Apistudio\Imageshop\Domain\Model\Product $product
     */
    public function removeProduct($product)
    {
        $this->products->detach($product);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getPreviewimage()
    {
        return $this->previewimage;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $previewimage
     */
    public function setPreviewimage($previewimage)
    {
        $this->previewimage = $previewimage;
    }
}