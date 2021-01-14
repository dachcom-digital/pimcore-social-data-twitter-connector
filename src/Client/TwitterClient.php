<?php

namespace SocialData\Connector\Twitter\Client;

use SocialData\Connector\Twitter\Model\EngineConfiguration;
use TwitterAPIExchange;

class TwitterClient
{
    /**
     * @param EngineConfiguration $configuration
     *
     * @return TwitterAPIExchange
     */
    public function getClient(EngineConfiguration $configuration)
    {
        return new TwitterAPIExchange([
            'consumer_key'              => $configuration->getApiKey(),
            'consumer_secret'           => $configuration->getApiSecretKey(),
            'oauth_access_token'        => $configuration->getAccessToken(),
            'oauth_access_token_secret' => $configuration->getAccessTokenSecret()
        ]);
    }
}
