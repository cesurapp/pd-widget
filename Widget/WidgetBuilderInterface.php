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
 * Widget Builder Interface.
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
interface WidgetBuilderInterface
{
    /**
     * Build Widgets.
     *
     * @param $widgets
     *
     * @param string $widgetGroup
     * @param array $widgetId
     * @param bool $render
     *
     * @return ItemInterface[]|null
     */
    public function build($widgets, string $widgetGroup = '', array $widgetId = [],  bool $render = false): ?array;
}
