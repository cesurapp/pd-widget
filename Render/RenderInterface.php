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
     * @return mixed
     */
    public function render($widgets);
}
