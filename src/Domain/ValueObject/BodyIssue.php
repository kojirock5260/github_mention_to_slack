<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\ValueObject;


class BodyIssue
{
    /**
     * @var string
     */
    private $issueTitle;

    /**
     * @var string
     */
    private $issueUrl;

    /**
     * @var string
     */
    private $issueComment;

    /**
     * BodyIssue constructor.
     * @param string $issueTitle
     * @param string $issueUrl
     * @param string $issueComment
     */
    public function __construct(string $issueTitle, string $issueUrl, string $issueComment)
    {
        $this->issueTitle   = $issueTitle;
        $this->issueUrl     = $issueUrl;
        $this->issueComment = $issueComment;
    }

    /**
     * @return string
     */
    public function toBody():string
    {
        $body = "タイトル: {$this->issueTitle}\nURL: {$this->issueUrl}";
        if ($this->issueComment === '') {
            return $body;
        }

        return "{$body}\n\nコメント: {$this->issueComment}";
    }
}