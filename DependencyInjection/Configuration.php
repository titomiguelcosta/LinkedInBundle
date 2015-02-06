<?php

namespace Zorbus\LinkedInBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zorbus_linked_in');

        $rootNode
            ->children()
            ->scalarNode('key')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('secret')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('scope')->defaultValue('r_basicprofile')->end()
            ->end();

        return $treeBuilder;
    }
}
