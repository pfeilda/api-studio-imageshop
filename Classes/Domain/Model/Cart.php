<?php
/**
 * All Files are owned by API-Studio. It is forbidden to use,
 * distrubute or anything else without permission of the
 * owner. CEO Daniel Pfeil <dp@api-studio.de>
 * Copyright (c) 2015-2017.
 */

namespace Apistudio\Imageshop\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

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
     * @var boolean
     */
    protected $ispaid = null;
    /**
     * @var boolean
     */
    protected $acceptagb = null;
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $fe_user = null;
    /**
     * @var int
     */
    protected $paymentmethod = 0;

    public function __construct()
    {;
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
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
        return $this->fe_user;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $fe_user
     */
    public function setFeUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $fe_user)
    {
        $this->fe_user = $fe_user;
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
}