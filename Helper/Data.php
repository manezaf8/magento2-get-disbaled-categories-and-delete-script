<?php
/**
 * @package   F8\CategoryCleanup\Helper
 * @author    Ntabethemba Ntshoza
 * @date      30-03-2023
 * @copyright Copyright © 2023 MRP Group IT
 */

namespace F8\CategoryCleanup\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATXML_PATH_CATETORY_DELETEH_CATALOG = 'categorycleanup/categorycleanup_categories/category_ids';

    /**
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * Get category IDs to be deleted
     *
     * @param null $code
     * @param null $storeId
     * @return string|Array
     */
    public function getCategoryIdsToDelete($code = null, $storeId = null)
    {
        return $this->getConfigValue(
            self::XML_PATXML_PATH_CATETORY_DELETEH_CATALOG . $code, $storeId
        );
    }

    public function isCategoryDisabled($category)
    {
        return !$category->getIsActive();
    }
}
