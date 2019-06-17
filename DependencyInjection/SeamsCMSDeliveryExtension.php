<?php

/*
 * This file is part of the SeamsCMSDeliveryBundle package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\DeliveryBundle\DependencyInjection;

use SeamsCMS\Delivery\Client;
use SeamsCMS\Delivery\ClientFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SeamsCMSDeliveryExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        foreach ($config['clients'] as $alias => $client) {
            $this->createClient($container, $alias, $client);
        }
    }

    public function createClient(ContainerBuilder $container, $clientAlias, $clientConfig)
    {
        $factoryDef = new Definition(ClientFactory::class);
        $factoryDef->setPublic(false);

        $clientDef = new Definition(ClientFactory::class);
        $clientDef->setPublic(false);
        $clientDef->setFactory(array($factoryDef, "build"));
        $clientDef->addTag('seams_cms_delivery.client', array('alias' => $clientAlias));

        $clientDef->addArgument($clientConfig['api_key']);
        $clientDef->addArgument($clientConfig['workspace']);
        if (isset($clientConfig['options'])) {
            $clientDef->addArgument($clientConfig['options']);
        }

        $container->setDefinition(sprintf('seams_cms_delivery.client.%s', $clientAlias), $clientDef);
    }

    public function getAlias()
    {
        return 'seams_cms_delivery';
    }
}
