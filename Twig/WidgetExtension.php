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

namespace Pd\WidgetBundle\Twig;

use Pd\WidgetBundle\Builder\ItemInterface;
use Pd\WidgetBundle\Render\RenderInterface;
use Pd\WidgetBundle\Widget\WidgetBuilderInterface;
use Pd\WidgetBundle\Widget\WidgetInterface;

/**
 * Widget Twig Extension.
 *
 * @author  Ramazan Apaydın <iletisim@ramazanapaydin.com>
 */
class WidgetExtension extends \Twig_Extension
{
    /**
     * @var RenderInterface
     */
    private $engine;

    /**
     * @var WidgetBuilderInterface
     */
    private $widgetBuilder;

    /**
     * @var WidgetInterface
     */
    private $widgets;

    public function __construct(RenderInterface $engine, WidgetBuilderInterface $widgetBuilder, WidgetInterface $widgets)
    {
        $this->engine = $engine;
        $this->widgetBuilder = $widgetBuilder;
        $this->widgets = $widgets;
    }

    /**
     * Twig Functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('pd_widget_render', [$this, 'renderWidget'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('pd_widget_get', [$this, 'getWidget']),
        ];
    }

    /**
     * Render Widget Group|Item.
     *
     * @param string $widgetGroup
     * @param array  $widgetId
     *
     * @return string
     */
    public function renderWidget(string $widgetGroup = '', array $widgetId = [])
    {
        $widgets = $this->widgetBuilder->build($this->widgets->getWidgets(), $widgetGroup, $widgetId);

        return $this->engine->render($widgets);
    }

    /**
     * Get Widgets.
     *
     * @param string $widgetGroup
     * @param array  $widgetId
     *
     * @return ItemInterface[]
     */
    public function getWidget(string $widgetGroup = '', array $widgetId = [])
    {
        return $this->widgetBuilder->build($this->widgets->getWidgets(), $widgetGroup, $widgetId);
    }
}
