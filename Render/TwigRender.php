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

use Pd\WidgetBundle\Builder\ItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

/**
 * Widget Twig Render.
 *
 * @author Kerem APAYDIN <kerem@apaydin.me>
 */
class TwigRender implements RenderInterface
{
    /**
     * @var Environment
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * WidgetRender constructor.
     *
     * @param Environment            $engine
     * @param CacheItemPoolInterface $cache
     * @param TokenStorageInterface  $tokenStorage
     * @param string                 $baseTemplate
     */
    public function __construct(Environment $engine, CacheItemPoolInterface $cache, TokenStorageInterface $tokenStorage, string $baseTemplate)
    {
        $this->engine = $engine;
        $this->cache = $cache;
        $this->tokenStorage = $tokenStorage;
        $this->baseTemplate = $baseTemplate;
    }

    /**
     * Render Widgets.
     *
     * @param $widgets ItemInterface[]
     * @param bool $base
     *
     * @return string
     */
    public function render($widgets, bool $base = true): string
    {
        if (!$widgets) {
            return false;
        }

        // Output Storage
        $output = '';

        // Get User ID
        $userId = $this->tokenStorage->getToken()->getUser()->getId();

        foreach ($widgets as $widget) {
            if ($widget->isActive()) {
                $output .= $this->getOutput($widget, $userId);
            }
        }

        // Render Base
        if ($base) {
            try {
                $output = @$this->engine->render($this->baseTemplate, ['widgets' => $output]);
            } catch (\Exception $e) {
            }
        }

        return $output;
    }

    /**
     * Get Widget Output for Cache.
     *
     * @param ItemInterface $item
     * @param $userId
     *
     * @return mixed|string
     */
    public function getOutput(ItemInterface $item, $userId)
    {
        if ($item->getCacheTime()) {
            // Get Cache Item
            $cache = $this->cache->getItem($item->getId().$userId);

            // Set Cache Expires
            $cache->expiresAfter($item->getCacheTime());

            // Save
            if (false === $cache->isHit()) {
                $cache->set($item->getTemplate() ? $this->engine->render($item->getTemplate(), ['widget' => $item]) : $item->getContent());
                $this->cache->save($cache);
            }

            return $cache->get();
        }

        return $item->getTemplate() ? $this->engine->render($item->getTemplate(), ['widget' => $item]) : $item->getContent();
    }
}
