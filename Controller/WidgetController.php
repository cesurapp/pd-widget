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

namespace Pd\WidgetBundle\Controller;

use Pd\WidgetBundle\Entity\WidgetUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WidgetController extends Controller
{
    /**
     * Change Widget Status.
     *
     * @param Request $request
     * @param string  $widgetId
     * @param bool    $status
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function status(Request $request, string $widgetId, bool $status = true)
    {
        // Build Widget
        $widgets = $this->get('pd_widget.core')->getWidgets();

        if (isset($widgets[$widgetId])) {
            // Get User Widgets
            $widgetConfig = $this->getDoctrine()
                    ->getRepository('PdWidgetBundle:WidgetUser')
                    ->findOneBy(['owner' => $this->getUser()]) ?? (new WidgetUser())->setOwner($this->getUser());

            $widgetConfig->addWidgetConfig($widgetId, [
                'status' => $status,
            ]);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($widgetConfig);
            $em->flush();
        }

        // Response
        $redirect = $request->headers->get('referer') ?? $this->generateUrl($this->getParameter('pd_widget.return_route'));

        return $this->redirect($redirect);
    }
}
