# magento2-get-disbaled-categories-and-delete-script
Module to get all disabled categories and delete them you can also added the category IDs in the admin
- Go to admin `Stores -> configurations -> F8 Configs -> Category Cleanup` and add Category Ids under `Categories to delete`

- The script needs few adjustments before it works I don't want you do delete stuff you don't want to delete
- That's why there is a count 1st and a log file where you can see all the category ids and their count for any questions contact Maneza F8 `bmaneza@gmail.com`

# Use the magento command to delete disabled categories

- use this command `php bin/magento F8_CategoryCleanup:delete-disabled-categories` to delete the categoris also adjuct the script in `app/code/F8/CategoryCleanup/Console/Command/DeleteDisabledCategoriesCommand.php` line 91 don't uncomment line 98 if you not ready to delete yet in that admin config you can add enabled categories too.


# When you ready to delete the categories

- Remove the comments on in 37 of the `GetDisabledCategoriesAndDelete` file if you want to you can comment the logger lines 39, 40
- you can run this script by placing it in the root of your magento 2 project 
- In the terminal run `php GetDisabledCategoriesAndDelete.php` 

That's it you can support us by donating here https://manezaf8.co.za/product/donate/
