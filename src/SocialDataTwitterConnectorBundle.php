<?php

namespace SocialData\Connector\Twitter;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;

class SocialDataTwitterConnectorBundle extends AbstractPimcoreBundle
{
    use PackageVersionTrait;

    public const PACKAGE_NAME = 'dachcom-digital/social-data-twitter-connector';

    /**
     * {@inheritdoc}
     */
    protected function getComposerPackageName(): string
    {
        return self::PACKAGE_NAME;
    }

    /**
     * @return array
     */
    public function getCssPaths()
    {
        return [
            '/bundles/socialdatatwitterconnector/css/admin.css'
        ];
    }

    /**
     * @return string[]
     */
    public function getJsPaths()
    {
        return [
            '/bundles/socialdatatwitterconnector/js/connector/twitter-connector.js',
            '/bundles/socialdatatwitterconnector/js/feed/twitter-feed.js',
        ];
    }
}
