<?php

/*
 * This source file is available under two different licenses:
 *   - GNU General Public License version 3 (GPLv3)
 *   - DACHCOM Commercial License (DCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) DACHCOM.DIGITAL AG (https://www.dachcom-digital.com)
 * @license    GPLv3 and DCL
 */

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
