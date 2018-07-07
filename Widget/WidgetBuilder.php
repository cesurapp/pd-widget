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

namespace Pd\WidgetBundle\Widget;

use Doctrine\ORM\EntityManagerInterface;
use Pd\WidgetBundle\Builder\ItemInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class WidgetBuilder implements WidgetBuilderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * User Widget Configuration.
     *
     * @var array
     */
    private $widgetConfig = [];

    /**
     * WidgetBuilder constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param TokenStorageInterface  $tokenStorage
     */
    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Build Widgets.
     *
     * @param $widgets ItemInterface[]
     * @param string $widgetGroup
     * @param array  $widgetId
     *
     * @return ItemInterface[]
     */
    public function build($widgets, string $widgetGroup = '', array $widgetId = [])
    {
        // Without Widgets
        if (!$widgets) {
            return $widgets;
        }

        // Load User Widget Configuration
        $this->loadUserConfig();

        // Output Widgets
        $outputWidget = [];

        // Custom Items
        if ($widgetId) {
            foreach ($widgetId as $id) {
                if (isset($widgets[$id])) {
                    // Activate
                    $widgets[$id]->setActive($this->widgetConfig[$widget->getId()]['status'] ?? false);

                    // Set Widget Config
                    $widgets[$id]->setConfig($this->widgetConfig[$widget->getId()] ?? []);

                    $outputWidget[] = $widgets[$id];
                }
            }

            return $outputWidget;
        }

        foreach ($widgets as $widget) {
            if ('' !== $widgetGroup && $widget->getGroup() !== $widgetGroup) {
                continue;
            }

            // Set Custom Order
            if (isset($this->widgetConfig[$widget->getId()]['order'])) {
                $widget->setOrder($this->widgetConfig[$widget->getId()]['order']);
            }

            // Order
            if (null !== $widget->getOrder()) {
                while (isset($outputWidget[$widget->getOrder()])) {
                    $widget->setOrder($widget->getOrder() + 1);
                }

                $outputWidget[$widget->getOrder()] = $widget;
            } else {
                $outputWidget[] = $widget;
            }

            // Activate
            $widget->setActive($this->widgetConfig[$widget->getId()]['status'] ?? false);

            // Set Widget Config
            $widget->setConfig($this->widgetConfig[$widget->getId()] ?? []);
        }

        // Sort
        ksort($outputWidget);

        return $outputWidget;
    }

    /**
     * Load User Widget Configuration.
     */
    private function loadUserConfig()
    {
        if (!$this->widgetConfig) {
            $this->widgetConfig = $this->entityManager
                ->getRepository('PdWidgetBundle:WidgetUser')
                ->findOneBy([
                    'owner' => $this->tokenStorage->getToken()->getUser(),
                ]);

            if (null !== $this->widgetConfig) {
                $this->widgetConfig = $this->widgetConfig->getConfig();
            }
        }
    }
}
