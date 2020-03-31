<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\Factory;


use Kojirock5260\GithubMentionToSlack\Domain\Entity\Issue;
use Kojirock5260\GithubMentionToSlack\Domain\Entity\Mentions;
use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\Action;
use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\BodyIssue;
use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\Mention;
use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\RepositoryName;
use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\SubjectIssue;

class ReviewFactory
{
    /**
     * @var \DateTimeInterface
     */
    private $businessStartAt;

    /**
     * @var \DateTimeInterface
     */
    private $businessEndAt;

    /**
     * @var array
     */
    private $mentionList;

    /**
     * ReviewFactory constructor.
     * @param \DateTimeInterface $businessStartAt
     * @param \DateTimeInterface $businessEndAt
     * @param array $mentionList
     */
    public function __construct(\DateTimeInterface $businessStartAt, \DateTimeInterface $businessEndAt, array $mentionList)
    {
        $this->businessStartAt = $businessStartAt;
        $this->businessEndAt   = $businessEndAt;
        $this->mentionList     = $mentionList;
    }

    /**
     * @param array $request
     * @return Issue
     */
    public function fromRequest(array $request):Issue
    {
        $action           = new Action($request['action']);
        $repositoryName   = new RepositoryName($request['repository']['name']);
        $subjectWithIssue = new SubjectIssue($action);
        $bodyWithIssue    = new BodyIssue(
            $request['issue']['title'],
            $request['issue']['html_url'],
            isset($this->params['comment']['body']) ?? ''
        );

        $mentions = new Mentions(array_map(static function(string $githubMention, string $slackMention) {
            return new Mention($githubMention, $slackMention);
        }, array_values($this->mentionList), array_keys($this->mentionList)), $this->businessStartAt, $this->businessEndAt);

        return new Issue($repositoryName, $subjectWithIssue, $bodyWithIssue, $mentions);
    }
}