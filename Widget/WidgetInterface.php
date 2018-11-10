<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 *
 * @license     LICENSE
 * @author      Kerem APAYDIN <kerem@apaydin.me>
 *
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Widget;

use Pd\WidgetBundle\Builder\ItemInterface;

/**
 * Widget Interface.
 *
 * @author Kerem APAYDIN <kerem@apaydin.me>
 */
interface WidgetInterface
{
    /**
     * Get Items to Widget Storage.
     *
     * @return ItemInterface[]|array
     */
    public function getWidgets();

    /**
     * Add Item to Widget Storage.
     *
     * @param ItemInterface $item
     *
     * @return WidgetInterface
     */
    public function addWidget(ItemInterface $item);

    /**
     * Remove Item to Widget Storage.
     *
     * @param string $widgetId
     *
     * @return WidgetInterface
     */
    public function removeWidget(string $widgetId);

    /**
     * Clear Current User Widget Cache.
     *
     * @return mixed
     */
    public function clearWidgetCache();
}
