<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Ramazan APAYDIN <apaydin541@gmail.com>
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
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
class WidgetExtension extends AbstractExtension
{
    public function __construct(
        private RenderInterface $engine,
        private WidgetBuilderInterface $widgetBuilder,
        private WidgetInterface $widgets)
    {
    }

    /**
     * Twig Functions.
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('pd_widget_render', [$this, 'renderWidget'], ['is_safe' => ['html']]),
            new TwigFunction('pd_widget_get', [$this, 'getWidget']),
        ];
    }

    /**
     * Render Widget Group|Item.
     */
    public function renderWidget(string $widgetGroup = '', array $widgetId = []): string
    {
        return $this->engine->render($this->widgetBuilder->build($this->widgets->getWidgets(), $widgetGroup, $widgetId, true));
    }

    /**
     * Get Widgets.
     *
     * @return ItemInterface[]
     */
    public function getWidget(string $widgetGroup = '', array $widgetId = []): array
    {
        return $this->widgetBuilder->build($this->widgets->getWidgets(), $widgetGroup, $widgetId, false);
    }
}
