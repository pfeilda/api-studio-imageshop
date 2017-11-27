<?php
/**
 * Copyright notice
 *
 * (c)  2017-2017. Daniel Pfeil <dp@api-studio.de>, API Studio UG (haftungsbeschraenkt)
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */

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