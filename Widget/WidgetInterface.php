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
     * @param bool $checkRole
     *
     * @return ItemInterface[]|null
     */
    public function getWidgets($checkRole = true): ?array;

    /**
     * Add Item to Widget Storage.
     *
     * @param ItemInterface $item
     *
     * @return WidgetInterface
     */
    public function addWidget(ItemInterface $item): self;

    /**
     * Remove Item to Widget Storage.
     *
     * @param string $widgetId
     *
     * @return WidgetInterface
     */
    public function removeWidget(string $widgetId): self;

    /**
     * Clear Current User Widget Cache.
     */
    public function clearWidgetCache(): void;
}
