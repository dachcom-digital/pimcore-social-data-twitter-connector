<?php

namespace SocialData\Connector\Twitter\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('social_data_twitter_connector');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
