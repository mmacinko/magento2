<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Catalog\Test\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\Catalog\Test\Fixture\Category;
use Magento\Catalog\Test\Page\Category\CatalogCategoryView;
use Magento\Cms\Test\Page\CmsIndex;

/**
 * Check visibility of category in navigation menu.
 */
class AssertCategoryInNavigationMenu extends AbstractConstraint
{
    /**
     * Assert visibility of category in navigation menu.
     *
     * @param Category $category
     * @param CatalogCategoryView $catalogCategoryView
     * @param CmsIndex $cmsIndex
     * @return void
     */
    public function processAssert(
        Category $category,
        CatalogCategoryView $catalogCategoryView,
        CmsIndex $cmsIndex
    ) {
        $cmsIndex->open();
        if (($category->getIncludeInMenu() == 'Yes') && ($category->getIsActive() == 'Yes')) {
            \PHPUnit_Framework_Assert::assertTrue(
                $catalogCategoryView->getTopmenu()->isCategoryVisible($category->getName()),
                'Expected that ' . $category->getName() . ' is visible in navigation menu, but it is not.'
            );
        } else {
            \PHPUnit_Framework_Assert::assertFalse(
                $catalogCategoryView->getTopmenu()->isCategoryVisible($category->getName()),
                'Expected that ' . $category->getName() . ' is not visible in navigation menu, but it is.'
            );
        }
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return "All category's visibility in navigation menu are true";
    }
}
