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

    /**
     * @var WidgetInterface
     */
    private $widget;

    /**
     * WidgetEvent constructor.
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
