<?php

namespace ApiStudio\Imageshop\Domain\Model;


use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Collection
 * @package ApiStudio\Imageshop\Domain\Model
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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ApiStudio\Imageshop\Domain\Model\Product>
     */
    protected $products;

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
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @param \ApiStudio\Imageshop\Domain\Model\Product $product
     */
    public function addProduct($product)
    {
        $this->products->attach($product);
    }

    /**
     * @param \ApiStudio\Imageshop\Domain\Model\Product $product
     */
    public function removeProduct($product)
    {
        $this->products->detach($product);
    }
}