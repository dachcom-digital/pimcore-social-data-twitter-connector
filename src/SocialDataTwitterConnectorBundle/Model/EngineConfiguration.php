<?php

namespace SocialData\Connector\Twitter\Model;

use SocialDataBundle\Connector\ConnectorEngineConfigurationInterface;
use SocialData\Connector\Twitter\Form\Admin\Type\TwitterEngineType;

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
     * @param $apiKey
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
     * @param $apiSecretKey
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
     * @param $accessToken
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
     * @param $accessTokenSecret
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
