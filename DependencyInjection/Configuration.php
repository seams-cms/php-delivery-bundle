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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder $builder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $rootNode = $builder->root('seamscms_delivery');
        $rootNode->children()
            ->arrayNode('clients')
                ->isRequired()
                ->requiresAtLeastOneElement()
                ->arrayPrototype()
                    ->children()
                        ->scalarNode('api_key')
                            ->isRequired()
                        ->end()
                        ->scalarNode('workspace')
                            ->isRequired()
                        ->end()
                        ->arrayNode('options')
                            ->scalarPrototype()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $builder;
    }
}
