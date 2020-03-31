<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\Service;


use Maknz\Slack\Message as SlackMessage;

class Notifier
{
    /**
     * @var SlackMessage
     */
    private $slackMessage;

    /**
     * Notifier constructor.
     * @param SlackMessage $slackMessage
     */
    public function __construct(SlackMessage $slackMessage)
    {
        $this->slackMessage = $slackMessage;
    }

    /**
     * @param string $subject
     * @param string $body
     */
    public function notify(string $subject, string $body): void
    {
        $this->slackMessage->attach([
            'color' => '#0000FF',
            'title' => $subject,
            'text'  => $body,
        ]);

        $this->slackMessage->send();
    }
}