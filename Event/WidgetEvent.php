<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Kerem APAYDIN <kerem@apaydin.me>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Event;

use Pd\WidgetBundle\Widget\WidgetInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Widget Events.
 *
 * @author Kerem APAYDIN <kerem@apaydin.me>
 */
class WidgetEvent extends Event
{
    public const WIDGET_START = 'widget.start';

    /**
     * @var WidgetInterface
     */
    private $widget;

    /**
     * WidgetEvent constructor.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    public function getWidgetContainer(): WidgetInterface
    {
        return $this->widget;
    }
}
