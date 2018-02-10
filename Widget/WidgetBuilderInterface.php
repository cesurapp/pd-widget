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
