<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\ValueObject;


class Mention
{
    /**
     * @var string
     */
    private $githubMention;

    /**
     * @var string
     */
    private $slackMention;

    /**
     * Mention constructor.
     * @param string $githubMention
     * @param string $slackMention
     */
    public function __construct(string $githubMention, string $slackMention)
    {
        $this->githubMention = $githubMention;
        $this->slackMention  = $slackMention;
    }

    /**
     * @return string
     */
    public function githubMention():string
    {
        return $this->githubMention;
    }

    /**
     * @return string
     */
    public function slackMention():string
    {
        return $this->slackMention;
    }
}