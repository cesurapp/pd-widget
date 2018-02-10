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

namespace Pd\WidgetBundle\Event;

use Pd\WidgetBundle\Widget\WidgetInterface;
use Symfony\Component\EventDispatcher\Event;

class WidgetEvent extends Event
{
    const WIDGET_START = 'widget.start';

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

    public function getWidgetContainer()
    {
        return $this->widget;
    }
}
