<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Ramazan APAYDIN <apaydin541@gmail.com>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Controller;

use Pd\WidgetBundle\Entity\WidgetUser;
use Pd\WidgetBundle\Repository\WidgetUserRepository;
use Pd\WidgetBundle\Widget\WidgetInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Widget Actions.
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
class WidgetController extends AbstractController
{
    public function __construct(
        private WidgetUserRepository $widgetUserRepo,
        private CacheInterface $cache
    )
    {
    }

    /**
     * Change Widget Status.
     */
    public function status(Request $request, WidgetInterface $widget, string $widgetId, bool $status = true): RedirectResponse
    {
        // Build Widget
        $widgets = $widget->getWidgets();

        if (isset($widgets[$widgetId])) {
            // Get User Widgets
            $widgetConfig = $this->widgetUserRepo->findOneBy(['owner' => $this->getUser()]) ?? (new WidgetUser())->setOwner($this->getUser());

            // Add Config Parameters
            $widgetConfig->addWidgetConfig($widgetId, ['status' => $status]);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($widgetConfig);
            $em->flush();
        }

        // Response
        return $this->redirect($request->headers->get('referer', $this->generateUrl($this->getParameter('pd_widget.return_route'))));
    }

    /**
     * Change Widget Configuration.
     */
    public function configs(Request $request, WidgetInterface $widget, string $widgetId): RedirectResponse
    {
        // Build Widget
        $widgets = $widget->getWidgets();

        if (isset($widgets[$widgetId])) {
            // Get User Widgets
            $widgetConfig = $this->widgetUserRepo->findOneBy(['owner' => $this->getUser()]) ?? (new WidgetUser())->setOwner($this->getUser());

            // Add or Remove Config Parameters
            if ($request->get('remove')) {
                $widgetConfig->removeWidgetConfig($widgetId, $widgets[$widgetId]->getConfigProcess($request) ?? []);
            } else {
                $widgetConfig->addWidgetConfig($widgetId, $widgets[$widgetId]->getConfigProcess($request) ?? []);
            }

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($widgetConfig);
            $em->flush();

            // Flush Widget Cache
            $this->cache->delete($widgetId . $this->getUser()->getId());
        }

        // Response
        return $this->redirect($request->headers->get('referer', $this->generateUrl($this->getParameter('pd_widget.return_route'))));
    }

    /**
     * Change Widget Order.
     */
    public function order(WidgetInterface $widget, string $widgetId, int $order): JsonResponse
    {
        // Build Widget
        $widgets = $widget->getWidgets();

        if (isset($widgets[$widgetId])) {
            // Get User Widgets
            $widgetConfig = $this->widgetUserRepo->findOneBy(['owner' => $this->getUser()]) ?? (new WidgetUser())->setOwner($this->getUser());

            // Add Config Parameters
            $widgetConfig->addWidgetConfig($widgetId, ['order' => $order]);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($widgetConfig);
            $em->flush();
        }

        // Response
        return $this->json([
            'result' => 'success',
        ]);
    }
}
