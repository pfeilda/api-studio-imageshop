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

namespace Apistudio\Imageshop\Utility;

use PayPal\Api\Payment;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

/**
 * Class PayPalUtility
 * @package Apistudio\Imageshop\Utility
 */
class PayPalUtility
{
    /**
     * @return ApiContext
     */
    public static function getApiContext(string $clientId, string $clientSecret):ApiContext{
        return new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );
    }

    /**
     * @param Payment $payment
     * @return int
     */
    public static function getStatusKey(Payment $payment):int{
        switch ($payment->getState()){
            case "created":
                return 1;
            case "approved":
                return 2;
            case "failed":
                return 3;
            default:
                return 0;
        }
    }
}