<?php
/**
 * @package   F8\CategoryCleanup\Cron
 * @author    Ntabethemba Ntshoza
 * @date      30-03-2023
 * @copyright Copyright © 2023 MRP Group IT
 */

namespace F8\CategoryCleanup\Cron;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Cleanup
 * @package F8\CategoryCleanup\Cron
 */
class Cleanup
{
    /**
     * @var CollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * CleanUp constructor
     *
     * @param CollectionFactory $categoryCollectionFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        CollectionFactory $categoryCollectionFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Execute the clean up
     *
     * @return void
     */
    public function execute()
    {
        $deleteDisabledCategories = $this->scopeConfig->getValue(
            'categorycleanup/general/enabled',
            ScopeInterface::SCOPE_STORE
        );

        if ($deleteDisabledCategories) {
            $categoryCollection = $this->categoryCollectionFactory->create();
            $categoryCollection->addAttributeToFilter('is_active', 0);
            $categoryCollection->walk('delete');
        }
    }
}
