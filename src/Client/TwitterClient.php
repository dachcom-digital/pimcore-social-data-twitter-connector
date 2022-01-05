<?php

namespace SocialData\Connector\Twitter\Client;

use Abraham\TwitterOAuth\TwitterOAuth;
use SocialData\Connector\Twitter\Model\EngineConfiguration;

class TwitterClient
{
    public function getClient(EngineConfiguration $configuration): TwitterOAuth
    {
        $connection = new TwitterOAuth(
            $configuration->getApiKey(),
            $configuration->getApiSecretKey(),
            $configuration->getAccessToken(),
            $configuration->getAccessTokenSecret()
        );

        $connection->setApiVersion('2');
        $connection->setDecodeJsonAsArray(true);

        return $connection;
    }
}
