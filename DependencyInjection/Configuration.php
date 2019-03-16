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

namespace Pd\WidgetBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('pd_widget');
        $rootNode = $treeBuilder->root('pd_widget');

        $rootNode
            ->children()
                ->scalarNode('base_template')->defaultValue('@PdWidget/widgetBase.html.twig')->end()
                ->scalarNode('return_route')->defaultValue('admin_dashboard')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
