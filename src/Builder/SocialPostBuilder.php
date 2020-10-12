<?php

namespace SocialData\Connector\Twitter\Builder;

use Carbon\Carbon;
use SocialData\Connector\Twitter\Model\FeedConfiguration;
use SocialDataBundle\Dto\BuildConfig;
use SocialData\Connector\Twitter\Model\EngineConfiguration;
use SocialData\Connector\Twitter\Client\TwitterClient;
use SocialDataBundle\Connector\SocialPostBuilderInterface;
use SocialDataBundle\Dto\FetchData;
use SocialDataBundle\Dto\FilterData;
use SocialDataBundle\Dto\TransformData;
use SocialDataBundle\Exception\BuildException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocialPostBuilder implements SocialPostBuilderInterface
{
    /**
     * @var TwitterClient
     */
    protected $twitterClient;

    /**
     * @param TwitterClient $twitterClient
     */
    public function __construct(TwitterClient $twitterClient)
    {
        $this->twitterClient = $twitterClient;
    }

    /**
     * {@inheritDoc}
     */
    public function configureFetch(BuildConfig $buildConfig, OptionsResolver $resolver): void
    {
        // nothing to configure so far.
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(FetchData $data): void
    {
        $options = $data->getOptions();
        $buildConfig = $data->getBuildConfig();

        $engineConfiguration = $buildConfig->getEngineConfiguration();
        $feedConfiguration = $buildConfig->getFeedConfiguration();

        if (!$engineConfiguration instanceof EngineConfiguration) {
            return;
        }

        if (!$feedConfiguration instanceof FeedConfiguration) {
            return;
        }

        $client = $this->twitterClient->getClient($engineConfiguration);

        if (empty($feedConfiguration->getScreenName())) {
            throw new BuildException('no valid screen name given.');
        }

        try {

            $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
            $count = empty($feedConfiguration->getCount()) ? 50 : $feedConfiguration->getCount();
            $getFields = sprintf('screen_name=%s&count=%d', $feedConfiguration->getScreenName(), $count);
            $requestMethod = 'GET';

            $userTimeline = $client
                ->setGetfield($getFields)
                ->buildOauth($url, $requestMethod)
                ->performRequest();

        } catch (\Throwable $e) {
            throw new BuildException(sprintf('twitter api error: %s [endpoint: %s]', $e->getMessage(), $url));
        }


        try {
            $items = json_decode($userTimeline, true);
        } catch (\Throwable $e) {
            throw new BuildException(sprintf('twitter decode response error: %s [endpoint: %s]', $e->getMessage(), $url));
        }

        if (count($items) === 0) {
            return;
        }

        $data->setFetchedEntities($items);
    }

    /**
     * {@inheritDoc}
     */
    public function configureFilter(BuildConfig $buildConfig, OptionsResolver $resolver): void
    {
        // nothing to configure so far.
    }

    /**
     * {@inheritDoc}
     */
    public function filter(FilterData $data): void
    {
        $options = $data->getOptions();
        $buildConfig = $data->getBuildConfig();

        $element = $data->getTransferredData();

        $feedConfiguration = $buildConfig->getFeedConfiguration();
        if (!$feedConfiguration instanceof FeedConfiguration) {
            return;
        }

        if (!is_array($element)) {
            return;
        }

        // @todo: check if feed has some filter (filter for hashtag for example)

        if ($feedConfiguration->getIgnoreReplies() === true) {
            if (isset($element['in_reply_to_status_id']) && $element['in_reply_to_status_id'] !== null) {
                return;
            }
        }

        if ($feedConfiguration->getIgnoreRetweets() === true) {
            if (isset($element['retweeted']) && $element['retweeted'] === true) {
                return;
            }
        }

        $data->setFilteredElement($element);
        $data->setFilteredId($element['id']);
    }

    /**
     * {@inheritDoc}
     */
    public function configureTransform(BuildConfig $buildConfig, OptionsResolver $resolver): void
    {
        // nothing to configure so far.
    }

    /**
     * {@inheritDoc}
     */
    public function transform(TransformData $data): void
    {
        $options = $data->getOptions();
        $buildConfig = $data->getBuildConfig();

        $element = $data->getTransferredData();
        $socialPost = $data->getSocialPostEntity();

        $feedConfiguration = $buildConfig->getFeedConfiguration();
        if (!$feedConfiguration instanceof FeedConfiguration) {
            return;
        }

        if (!is_array($element)) {
            return;
        }

        if (!empty($element['created_at'])) {
            $creationTime = Carbon::createFromTimeString($element['created_at']);
        } else {
            $creationTime = Carbon::now();
        }

        $mediaElement = null;
        if (isset($element['entities']) && isset($element['entities']['media']) && is_array($element['entities']['media']) && count($element['entities']['media']) > 0) {
            $mediaElement = $element['entities']['media'][0]['media_url'];
        }

        $socialPost->setSocialCreationDate($creationTime);
        $socialPost->setContent($element['text']);
        $socialPost->setUrl(sprintf('https://twitter.com/%s/status/%s', $feedConfiguration->getScreenName(), $element['id']));
        $socialPost->setPosterUrl($mediaElement);

        $data->setTransformedElement($socialPost);
    }
}
