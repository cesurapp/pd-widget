<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Ramazan APAYDIN <apaydin541@gmail.com>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Widget;

use Pd\WidgetBundle\Builder\ItemInterface;

/**
 * Widget Interface.
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
interface WidgetInterface
{
    /**
     * Get Items to Widget Storage.
     *
     * @return ItemInterface[]|array
     */
    public function getWidgets($checkRole = true);

    /**
     * Add Item to Widget Storage.
     *
     * @return WidgetInterface
     */
    public function addWidget(ItemInterface $item);

    /**
     * Remove Item to Widget Storage.
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
