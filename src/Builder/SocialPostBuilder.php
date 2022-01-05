<?php

namespace SocialData\Connector\Twitter\Builder;

use Carbon\Carbon;
use SocialData\Connector\Twitter\Client\TwitterClient;
use SocialData\Connector\Twitter\Model\EngineConfiguration;
use SocialData\Connector\Twitter\Model\FeedConfiguration;
use SocialDataBundle\Connector\SocialPostBuilderInterface;
use SocialDataBundle\Dto\BuildConfig;
use SocialDataBundle\Dto\FetchData;
use SocialDataBundle\Dto\FilterData;
use SocialDataBundle\Dto\TransformData;
use SocialDataBundle\Exception\BuildException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocialPostBuilder implements SocialPostBuilderInterface
{
    protected TwitterClient $twitterClient;

    public function __construct(TwitterClient $twitterClient)
    {
        $this->twitterClient = $twitterClient;
    }

    public function configureFetch(BuildConfig $buildConfig, OptionsResolver $resolver): void
    {
        // nothing to configure so far.
    }

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

        if (empty($feedConfiguration->getUserId())) {
            throw new BuildException('no valid user id given.');
        }

        $client = $this->twitterClient->getClient($engineConfiguration);
        $endpoint = sprintf('users/%s/tweets', $feedConfiguration->getUserId());

        $excludes = [];
        if ($feedConfiguration->getIgnoreRetweets() === true) {
            $excludes[] = 'retweets';
        }

        if ($feedConfiguration->getIgnoreReplies() === true) {
            $excludes[] = 'replies';
        }

        $count = empty($feedConfiguration->getCount()) ? 50 : $feedConfiguration->getCount();
        $count = $count < 5 ? 5 : $count;

        try {
            $userTimelineItems = $client->get(
                $endpoint,
                [
                    'max_results'  => $count,
                    'exclude'      => implode(',', $excludes),
                    'tweet.fields' => 'created_at,attachments',
                    'media.fields' => 'url,preview_image_url',
                    'expansions'   => 'author_id,in_reply_to_user_id,attachments.media_keys',
                ]
            );
        } catch (\Throwable $e) {
            throw new BuildException(sprintf('twitter api error: %s [endpoint: %s]', $e->getMessage(), $endpoint));
        }

        if (isset($userTimelineItems['errors'])) {

            $errorMessage = implode(', ', array_map(static function ($error) {
                return $error['message'] ?? '';
            }, $userTimelineItems['errors']));

            throw new BuildException(sprintf('twitter api error: %s [endpoint: %s]', $errorMessage, $endpoint));
        }

        if (!isset($userTimelineItems['data']) || !is_array($userTimelineItems['data'])) {
            return;
        }

        if (count($userTimelineItems['data']) === 0) {
            return;
        }

        $items = [];
        foreach ($userTimelineItems['data'] as $dataItem) {
            $items[] = $this->transformApiItem($dataItem, $userTimelineItems);
        }

        $data->setFetchedEntities($items);
    }

    public function configureFilter(BuildConfig $buildConfig, OptionsResolver $resolver): void
    {
        // nothing to configure so far.
    }

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

        $data->setFilteredElement($element);
        $data->setFilteredId($element['id']);
    }

    public function configureTransform(BuildConfig $buildConfig, OptionsResolver $resolver): void
    {
        // nothing to configure so far.
    }

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
        if (count($element['attachment_includes']) > 0) {
            $mediaElement = $element['attachment_includes'][0]['url'];
        }

        $socialPost->setSocialCreationDate($creationTime);
        $socialPost->setContent($element['text']);
        $socialPost->setUrl(sprintf('https://twitter.com/%s/status/%s', $feedConfiguration->getUserId(), $element['id']));
        $socialPost->setPosterUrl($mediaElement);

        $data->setTransformedElement($socialPost);
    }

    protected function transformApiItem(array $dataItem, array $apiData)
    {
        $attachmentData = [];
        $hasAttachmentIncludes = isset($apiData['includes']['media']) && is_array($apiData['includes']['media']);

        if ($hasAttachmentIncludes === true && isset($dataItem['attachments']['media_keys']) && is_array($dataItem['attachments']['media_keys'])) {
            foreach ($dataItem['attachments']['media_keys'] as $mediaKey) {
                $attachmentData = array_values(array_filter($apiData['includes']['media'], static function ($mediaInclude) use ($mediaKey) {
                    return $mediaInclude['media_key'] === $mediaKey && $mediaInclude['type'] === 'photo';
                }));
            }
        }

        $dataItem['attachment_includes'] = $attachmentData;

        return $dataItem;
    }
}
