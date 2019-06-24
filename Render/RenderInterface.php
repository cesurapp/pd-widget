<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Kerem APAYDIN <kerem@apaydin.me>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Render;

/**
 * WidgetRender Interface.
 *
 * @author  Ramazan Apaydın <iletisim@ramazanapaydin.com>
 */
interface RenderInterface
{
    /**
     * @param $widgets array|false
     *
     * @return string
     */
    public function render($widgets): string;
}
