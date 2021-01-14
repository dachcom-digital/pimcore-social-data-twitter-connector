<?php

namespace SocialData\Connector\Twitter\Model;

use SocialData\Connector\Twitter\Form\Admin\Type\TwitterEngineType;
use SocialDataBundle\Connector\ConnectorEngineConfigurationInterface;

class EngineConfiguration implements ConnectorEngineConfigurationInterface
{
    /**
     * @var string*
     *
     * @internal
     */
    protected $apiKey;

    /**
     * @var string
     *
     * @internal
     */
    protected $apiSecretKey;

    /**
     * @var string
     *
     * @internal
     */
    protected $accessToken;

    /**
     * @var string
     *
     * @internal
     */
    protected $accessTokenSecret;

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiSecretKey
     */
    public function setApiSecretKey($apiSecretKey)
    {
        $this->apiSecretKey = $apiSecretKey;
    }

    /**
     * @return string
     */
    public function getApiSecretKey()
    {
        return $this->apiSecretKey;
    }

    /**
     * {@inheritdoc}
     */
    public static function getFormClass()
    {
        return TwitterEngineType::class;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessTokenSecret
     */
    public function setAccessTokenSecret($accessTokenSecret)
    {
        $this->accessTokenSecret = $accessTokenSecret;
    }

    /**
     * @return string
     */
    public function getAccessTokenSecret()
    {
        return $this->accessTokenSecret;
    }
}
