<?php
/**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\PrestaShop\Core\Domain\Address\Command;

use PrestaShop\PrestaShop\Core\Domain\Address\Exception\InvalidAddressRequiredFieldsException;
use PrestaShop\PrestaShop\Core\Domain\Address\ValueObject\RequiredFields;

/**
 * Sets required fields for new address when adding
 */
class SetRequiredFieldsForAddressCommand
{
    /**
     * @var string[]
     */
    private $requiredFields;

    /**
     * @param string[] $requiredFields
     *
     * @throws InvalidAddressRequiredFieldsException
     */
    public function __construct(array $requiredFields)
    {
        $this->assertContainsOnlyAllowedFields($requiredFields);

        $this->requiredFields = $requiredFields;
    }

    /**
     * @return string[]
     */
    public function getRequiredFields()
    {
        return $this->requiredFields;
    }

    /**
     * Check that all provided fields are allowed.
     *
     * @param string[] $requiredFields
     *
     * @throws InvalidAddressRequiredFieldsException
     */
    private function assertContainsOnlyAllowedFields(array $requiredFields)
    {
        if (empty($requiredFields)) {
            return;
        }

        if (!empty(array_diff($requiredFields, RequiredFields::ALLOWED_REQUIRED_FIELDS))) {
            throw new InvalidAddressRequiredFieldsException(
                sprintf(
                    'Invalid address required fields provided. Allowed fields are: %s',
                    implode(',', RequiredFields::ALLOWED_REQUIRED_FIELDS)
                )
            );
        }
    }
}
