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
 * Widget Builder Interface.
 *
 * @author Kerem APAYDIN <kerem@apaydin.me>
 */
interface WidgetBuilderInterface
{
    /**
     * Build Widgets.
     *
     * @param $widgets
     * @param string $widgetGroup
     * @param array  $widgetId
     *
     * @return ItemInterface[]|null
     */
    public function build($widgets, string $widgetGroup = '', array $widgetId = []);
}
