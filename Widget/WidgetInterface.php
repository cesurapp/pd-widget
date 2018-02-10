<?php

/**
 * This file is part of the pdAdmin pdWidget package.
 *
 * @package     pdWidget
 *
 * @author      Ramazan APAYDIN <iletisim@ramazanapaydin.com>
 * @copyright   Copyright (c) 2018 Ramazan APAYDIN
 * @license     LICENSE
 *
 * @link        https://github.com/rmznpydn/pd-widget
 */

namespace Pd\WidgetBundle\Widget;

use Pd\WidgetBundle\Builder\ItemInterface;

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
}
