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

use Pd\WidgetBundle\Builder\ItemInterface;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class WidgetRender.
 *
 * @author  Ramazan Apaydın <iletisim@ramazanapaydin.com>
 */
class TwigRender implements RenderInterface
{
    /**
     * @var \Twig_Environment
     */
    private $engine;

    /**
     * @var string
     */
    private $baseTemplate;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * WidgetRender constructor.
     *
     * @param \Twig_Environment $engine
     * @param string $baseTemplate
     */
    public function __construct(\Twig_Environment $engine, CacheItemPoolInterface $cache, string $baseTemplate)
    {
        $this->engine = $engine;
        $this->cache = $cache;
        $this->baseTemplate = $baseTemplate;
    }

    /**
     * Render Widgets.
     *
     * @param $widgets ItemInterface[]
     * @param bool $base
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string
     */
    public function render($widgets, bool $base = true)
    {
        if (!$widgets) {
            return false;
        }

        // Output Storage
        $output = '';

        foreach ($widgets as $widget) {
            if ($widget->isActive())
                $output .= $this->getOutput($widget);
        }

        // Render Base
        if ($base) {
            $output = $this->engine->render($this->baseTemplate, ['widgets' => $output]);
        }

        return $output;
    }

    public function getOutput(ItemInterface $item)
    {
        if ($item->getCacheTime()) {
            // Get Cache Item
            $cache = $this->cache->getItem($item->getId());

            // Set Cache Expires
            $cache->expiresAfter($item->getCacheTime());

            // Save
            if (false === $cache->isHit()) {
                $cache->set($item->getTemplate() ? $this->engine->render($item->getTemplate(), ['widget' => $item]) : $item->getContent());
                $this->cache->save($cache);
            }

            return $cache->get();
        } else {
            return $item->getTemplate() ? $this->engine->render($item->getTemplate(), ['widget' => $item]) : $item->getContent();
        }
    }
}
