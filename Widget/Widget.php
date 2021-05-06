<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Ramazan APAYDIN <apaydin541@gmail.com>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Widget;

use Pd\WidgetBundle\Builder\ItemInterface;
use Pd\WidgetBundle\Event\WidgetEvent;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * Widget Main.
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
class Widget implements WidgetInterface
{
    /**
     * Widget Storage.
     *
     * @var array|ItemInterface[]
     */
    private array $widgets = [];
    private bool $checkRole;

    public function __construct(
        private AuthorizationCheckerInterface $security,
        private EventDispatcherInterface $eventDispatcher,
        private CacheItemPoolInterface $cache,
        private TokenStorageInterface $token)
    {
    }

    /**
     * Get Widgets.
     *
     * @return ItemInterface[]|null
     */
    public function getWidgets($checkRole = true): ?array
    {
        // Check Role
        $this->checkRole = $checkRole;

        // Dispatch Event
        if (!$this->widgets) {
            $this->eventDispatcher->dispatch(new WidgetEvent($this), WidgetEvent::WIDGET_START);
        }

        return $this->widgets;
    }

    /**
     * Add Widget
     */
    public function addWidget(ItemInterface $item): WidgetInterface
    {
        // Check Security
        if ($this->checkRole && $item->getRole()) {
            $decide = true;
            foreach ($item->getRole() as $role) {
                if (!$this->security->isGranted($role)) {
                    $decide = false;
                    break;
                }
            }

            if (!$decide) {
                return $this;
            }
        }

        // Add
        $this->widgets[$item->getId()] = $item;

        return $this;
    }

    /**
     * Remove Widget.
     */
    public function removeWidget(string $widgetId): WidgetInterface
    {
        if (isset($this->widgets[$widgetId])) {
            unset($this->widgets[$widgetId]);
        }

        return $this;
    }

    /**
     * Clear current user widget cache.
     */
    public function clearWidgetCache(): void
    {
        // Get Widgets
        $widgets = $this->getWidgets(false);
        $userId = $this->token->getToken()->getUser()->getId();

        // Clear Cache
        foreach ($widgets as $widget) {
            try {
                $this->cache->deleteItem($widget->getId() . $userId);
            } catch (InvalidArgumentException $e) {
            }
        }
    }
}
