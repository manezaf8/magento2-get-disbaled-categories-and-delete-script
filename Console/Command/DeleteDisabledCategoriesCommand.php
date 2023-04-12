<?php
/**
 * @package   F8\CategoryCleanup\Console\Command
 * @author    Ntabethemba Ntshoza
 * @date      30-03-2023
 * @copyright Copyright © 2023 MRP Group IT
 */

namespace F8\CategoryCleanup\Console\Command;

use F8\CategoryCleanup\Helper\Data;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\App\State;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeleteDisabledCategoriesCommand
 * @package F8\CategoryCleanup\Console\Command
 */
class DeleteDisabledCategoriesCommand extends Command

{
    /**
     * @var State
     */
    protected $state;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var CategoryFactory
     */
    protected $categoryFactory;

    /**
     * Delete Disabled categories constructor
     *
     * @param State $state
     * @param CategoryFactory $categoryFactory
     * @param Data $helper
     */
    public function __construct(
        State $state,
        CategoryFactory $categoryFactory,
        Data $helper
    ) {
        $this->state  = $state;
        $this->helper = $helper;
        $this->categoryFactory = $categoryFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('F8_CategoryCleanup:delete-disabled-categories');
        $this->setDescription('Delete disabled categories');

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode('adminhtml');

        $categories = $this->categoryFactory->create()->getCollection()
            ->addFieldToFilter('is_active', 0);
        $adminCategories = $this->helper->getCategoryIdsToDelete();
        $adminCategories = explode(',', $adminCategories);

        foreach ($categories as $category) {
            if (!$this->helper->isCategoryDisabled($category)) {
                continue;
            }

            if ($adminCategories != "") {
                foreach ($adminCategories as $adminCategory) {
                    $category->load($adminCategory);
                    // $category->delete(); //uncoment this line when you added the the category ids at the admin
                }
            }

            //$category->delete(); // Uncomment this part to delete
            var_dump($category->getId());
            $output->writeln("Deleted category with ID " . $category->getId());
        }

        return Cli::RETURN_SUCCESS;
    }
}
