<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Ramazan APAYDIN <apaydin541@gmail.com>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Event;

use Pd\WidgetBundle\Widget\WidgetInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Widget Events.
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
class WidgetEvent extends Event
{
    public const WIDGET_START = 'widget.start';

    public function __construct(
        private WidgetInterface $widget)
    {
    }

    public function getWidgetContainer(): WidgetInterface
    {
        return $this->widget;
    }
}
