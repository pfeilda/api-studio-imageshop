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
     * @inject
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