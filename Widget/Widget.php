<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 *
 * @license     LICENSE
 * @author      Kerem APAYDIN <kerem@apaydin.me>
 *
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Widget;

use Pd\WidgetBundle\Builder\ItemInterface;
use Pd\WidgetBundle\Event\WidgetEvent;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Widget Main.
 *
 * @author Kerem APAYDIN <kerem@apaydin.me>
 */
class Widget implements WidgetInterface
{
    /**
     * Widget Storage.
     *
     * @var array|ItemInterface[]
     */
    private $widgets = [];

    /**
     * @var AuthorizationCheckerInterface
     */
    private $security;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var bool
     */
    private $checkRole;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var TokenStorageInterface
     */
    private $token;

    /**
     * @param AuthorizationCheckerInterface $security
     * @param EventDispatcherInterface      $eventDispatcher
     */
    public function __construct(AuthorizationCheckerInterface $security, EventDispatcherInterface $eventDispatcher, CacheItemPoolInterface $cache, TokenStorageInterface $token)
    {
        $this->security = $security;
        $this->eventDispatcher = $eventDispatcher;
        $this->cache = $cache;
        $this->token = $token;
    }

    /**
     * Get Widgets.
     *
     * @return array|ItemInterface[]
     */
    public function getWidgets($checkRole = true)
    {
        // Check Role
        $this->checkRole = $checkRole;

        // Dispatch Event
        if (!$this->widgets) {
            $this->eventDispatcher->dispatch(WidgetEvent::WIDGET_START, new WidgetEvent($this));
        }

        return $this->widgets;
    }

    /**
     * Add Widget.
     *
     * @param ItemInterface $item
     *
     * @return $this
     */
    public function addWidget(ItemInterface $item)
    {
        // Check Security
        if ($this->checkRole) {
            if ($item->getRole() && !$this->security->isGranted($item->getRole())) {
                return $this;
            }
        }

        // Add
        $this->widgets[$item->getId()] = $item;

        return $this;
    }

    /**
     * Remove Widget.
     *
     * @param string $widgetId
     *
     * @return $this
     */
    public function removeWidget(string $widgetId)
    {
        if (isset($this->widgets[$widgetId])) {
            unset($this->widgets[$widgetId]);
        }

        return $this;
    }

    /**
     * Clear current user widget cache.
     *
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function clearWidgetCache()
    {
        // Get Widgets
        $widgets = $this->getWidgets(false);
        $userId = $this->token->getToken()->getUser()->getId();

        // Clear Cache
        foreach ($widgets as $widget) {
            $this->cache->deleteItem($widget->getId().$userId);
        }
    }
}
