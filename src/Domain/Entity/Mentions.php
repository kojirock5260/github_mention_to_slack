<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\Entity;


use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\Mention;

class Mentions
{
    /**
     * @var Mention[]
     */
    private $mentions;

    /**
     * @var \DateTimeInterface
     */
    private $businessStartAt;

    /**
     * @var \DateTimeInterface
     */
    private $businessEndAt;

    /**
     * Mentions constructor.
     * @param Mention[] $mentions
     * @param \DateTimeInterface $businessStartAt
     * @param \DateTimeInterface $businessEndAt
     */
    public function __construct(array $mentions, \DateTimeInterface $businessStartAt, \DateTimeInterface $businessEndAt)
    {
        $this->mentions        = $mentions;
        $this->businessStartAt = $businessStartAt;
        $this->businessEndAt   = $businessEndAt;
    }

    /**
     * @return string
     */
    public function replace(string $body): string
    {
        if (!$this->isAvailableTime()) {
            return $body;
        }

        return str_replace($this->githubMentions(), $this->slackMentions(), $body);
    }

    /**
     * @return array
     */
    private function githubMentions(): array
    {
        return array_map(static function (Mention $mention) {
            return '@' . $mention->githubMention();
        }, array_keys($this->mentions));
    }

    /**
     * @return array
     */
    private function slackMentions(): array
    {
        return array_map(static function (Mention $mention) {
            return $mention->slackMention();
        }, array_keys($this->mentions));
    }

    /**
     * @return bool
     */
    private function isAvailableTime(): bool
    {
        $currentTime = \Carbon\CarbonImmutable::now();
        return $currentTime->between($this->businessStartAt, $this->businessEndAt);
    }
}