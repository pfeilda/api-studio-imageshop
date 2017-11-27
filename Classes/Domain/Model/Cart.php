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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class Cart
 * @package Apistudio\Imageshop\Domain\Model
 */
class Cart extends AbstractEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Apistudio\Imageshop\Domain\Model\Product>
     */
    protected $products = null;
    /**
     * @var \DateTime
     */
    protected $paymentdate = null;
    /**
     * @var string
     */
    protected $paymentid = null;
    /**
     * @var int
     */
    protected $paymentstate = 0;
    /**
     * @var boolean
     */
    protected $ispaid = null;
    /**
     * @var boolean
     */
    protected $acceptagb = null;
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @inject
     */
    protected $feUser;
    /**
     * @var int
     */
    protected $paymentmethod = 0;

    public function __construct()
    {
        $this->setProducts(new ObjectStorage());
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
     * @return \DateTime
     */
    public function getPaymentdate(): \DateTime
    {
        return $this->paymentdate;
    }

    /**
     * @param \DateTime $paymentdate
     */
    public function setPaymentdate(\DateTime $paymentdate)
    {
        $this->paymentdate = $paymentdate;
    }

    /**
     * @return bool
     */
    public function isIspaid(): bool
    {
        return $this->ispaid;
    }

    /**
     * @param bool $ispaid
     */
    public function setIspaid(bool $ispaid)
    {
        $this->ispaid = $ispaid;
    }
    /**
     * @return bool
     */
    public function isAcceptagb(): bool
    {
        return $this->acceptagb;
    }

    /**
     * @param bool $ispaid
     */
    public function setAcceptagb(bool $acceptagb)
    {
        $this->acceptagb = $acceptagb;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    public function getFeUser(): \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
    {
        return $this->feUser;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
     */
    public function setFeUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser)
    {
        $this->feUser = $feUser;
    }

    /**
     * @return int
     */
    public function getPaymentmethod(): int
    {
        return $this->paymentmethod;
    }

    /**
     * @param int $paymentmethod
     */
    public function setPaymentmethod(int $paymentmethod)
    {
        $this->paymentmethod = $paymentmethod;
    }

    /**
     * @return string
     */
    public function getPaymentid(): string
    {
        return $this->paymentid;
    }

    /**
     * @param string $paymentid
     */
    public function setPaymentid(string $paymentid)
    {
        $this->paymentid = $paymentid;
    }

    /**
     * @return int
     */
    public function getPaymentstate(): int
    {
        return $this->paymentstate;
    }

    /**
     * @param int $paymentstate
     */
    public function setPaymentstate(int $paymentstate)
    {
        $this->paymentstate = $paymentstate;
    }

    /**
     * check if wether payed with paypal or manual
     * @return bool
     */
    public function isCleared(){
        if($this->getPaymentmethod() == 2 && $this->isIspaid()){
            return true;
        } else if($this->getPaymentmethod() == 1 && $this->getPaymentstate() == 2){
            return true;
        } else{
            return false;
        }
    }
}