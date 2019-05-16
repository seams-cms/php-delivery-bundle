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
        $clientDef = new Definition(Client::class);
        $clientDef->setPublic(false);
        $clientDef->addTag('seams_cms_delivery.client', array('alias' => $clientAlias));

        $clientDef->addArgument($clientConfig['api_key']);
        $clientDef->addArgument($clientConfig['workspace']);

        $container->setDefinition(sprintf('seams_cms_delivery.client.%s', $clientAlias), $clientDef);
    }

    public function getAlias()
    {
        return 'seams_cms_delivery';
    }
}
