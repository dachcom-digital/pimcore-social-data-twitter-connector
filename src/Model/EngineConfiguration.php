<?php

namespace SocialData\Connector\Twitter\Model;

use SocialData\Connector\Twitter\Form\Admin\Type\TwitterEngineType;
use SocialDataBundle\Connector\ConnectorEngineConfigurationInterface;

class EngineConfiguration implements ConnectorEngineConfigurationInterface
{
    /**
     * @internal
     */
    protected ?string $apiKey = null;

    /**
     * @internal
     */
    protected ?string $apiSecretKey = null;

    /**
     * @internal
     */
    protected ?string $accessToken = null;

    /**
     * @internal
     */
    protected ?string $accessTokenSecret = null;

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiSecretKey(string $apiSecretKey)
    {
        $this->apiSecretKey = $apiSecretKey;
    }

    public function getApiSecretKey(): ?string
    {
        return $this->apiSecretKey;
    }

    public static function getFormClass(): string
    {
        return TwitterEngineType::class;
    }

    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessTokenSecret(string $accessTokenSecret)
    {
        $this->accessTokenSecret = $accessTokenSecret;
    }

    public function getAccessTokenSecret(): ?string
    {
        return $this->accessTokenSecret;
    }
}
