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

namespace SocialData\Connector\Twitter\Model;

use SocialData\Connector\Twitter\Form\Admin\Type\TwitterFeedType;
use SocialDataBundle\Connector\ConnectorFeedConfigurationInterface;

class FeedConfiguration implements ConnectorFeedConfigurationInterface
{
    protected ?string $userId = null;
    protected ?int $count = null;
    protected bool $ignoreReplies = true;
    protected bool $ignoreRetweets = true;

    public static function getFormClass(): string
    {
        return TwitterFeedType::class;
    }

    public function setUserId(?string $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setCount(?int $count): void
    {
        $this->count = $count;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setIgnoreReplies(bool $ignoreReplies): void
    {
        $this->ignoreReplies = $ignoreReplies;
    }

    public function getIgnoreReplies(): bool
    {
        return $this->ignoreReplies;
    }

    public function setIgnoreRetweets(bool $ignoreRetweets): void
    {
        $this->ignoreRetweets = $ignoreRetweets;
    }

    public function getIgnoreRetweets(): bool
    {
        return $this->ignoreRetweets;
    }
}
