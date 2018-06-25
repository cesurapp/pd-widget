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

namespace Pd\WidgetBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class PdWidgetExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        // Load Services
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        // Load Configuration
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Set Parameter
        $container->setParameter('pd_widget.return_route', $config['return_route']);

        // Set Configuration
        $container
            ->getDefinition('pd_widget.render')
            ->setArgument('$baseTemplate', $config['base_template']);
    }
}
