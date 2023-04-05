<?php
/**
 * Script to get all disabled categories and delete them
 * @package   root script
 * @author    Maneza F8
 * @date      05-04-2023
 * @copyright Copyright © 2023 F8
 */

use Magento\Framework\App\Bootstrap;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

require __DIR__ . '/app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();

$categoryCollectionFactory = $objectManager->get(CollectionFactory::class);
$categoryCollect = $objectManager->get(Category::class);

// Righting a log file for testing 
$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/LoggedData.log');
$logger = new \Zend_Log();
$logger->addWriter($writer);

// Get category collection filter only disabled categories
$categoryCollection = $categoryCollectionFactory->create();
$categoryCollection->addAttributeToSelect('*')
                   ->addAttributeToFilter('is_active', 0);
$count = 1;

foreach ($categoryCollection as $category) {
     $count++;
     $categoryIds = $category->getId();

     $categoryCollect->load($category->getId());
     // $categoryCollect->delete(); //Enable this line when you ready to delete
     $logger->info(print_r($category->getId(), true));
     $logger->info(print_r($count, true));
}

