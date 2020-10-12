<?php

namespace SocialData\Connector\Twitter\Model;

use SocialDataBundle\Connector\ConnectorFeedConfigurationInterface;
use SocialData\Connector\Twitter\Form\Admin\Type\TwitterFeedType;

class FeedConfiguration implements ConnectorFeedConfigurationInterface
{
    /**
     * @var string|null
     */
    protected $screenName;

    /**
     * @var int|null
     */
    protected $count;

    /**
     * @var bool
     */
    protected $ignoreReplies = true;

    /**
     * @var bool
     */
    protected $ignoreRetweets = true;

    /**
     * {@inheritdoc}
     */
    public static function getFormClass()
    {
        return TwitterFeedType::class;
    }

    /**
     * @param string|null $screenName
     */
    public function setScreenName(?string $screenName)
    {
        $this->screenName = $screenName;
    }

    /**
     * @return string|null
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * @param int|null $count
     */
    public function setCount(?int $count)
    {
        $this->count = $count;
    }

    /**
     * @return int|null
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param $ignoreReplies
     */
    public function setIgnoreReplies($ignoreReplies) {
        $this->ignoreReplies = $ignoreReplies;
    }

    /**
     * @return bool
     */
    public function getIgnoreReplies() {
        return $this->ignoreReplies;
    }

    /**
     * @param $ignoreRetweets
     */
    public function setIgnoreRetweets($ignoreRetweets) {
        $this->ignoreRetweets = $ignoreRetweets;
    }

    /**
     * @return bool
     */
    public function getIgnoreRetweets() {
        return $this->ignoreRetweets;
    }
}
