<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Kerem APAYDIN <kerem@apaydin.me>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Twig;

use Pd\WidgetBundle\Builder\ItemInterface;
use Pd\WidgetBundle\Render\RenderInterface;
use Pd\WidgetBundle\Widget\WidgetBuilderInterface;
use Pd\WidgetBundle\Widget\WidgetInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Widget Twig Extension.
 *
 * @author Kerem APAYDIN <kerem@apaydin.me>
 */
class WidgetExtension extends AbstractExtension
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
            new TwigFunction('pd_widget_render', [$this, 'renderWidget'], ['is_safe' => ['html']]),
            new TwigFunction('pd_widget_get', [$this, 'getWidget']),
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
    public function renderWidget(string $widgetGroup = '', array $widgetId = []): string
    {
        $widgets = $this->widgetBuilder->build($this->widgets->getWidgets(), $widgetGroup, $widgetId, true);

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
    public function getWidget(string $widgetGroup = '', array $widgetId = []): array
    {
        return $this->widgetBuilder->build($this->widgets->getWidgets(), $widgetGroup, $widgetId, false);
    }
}
