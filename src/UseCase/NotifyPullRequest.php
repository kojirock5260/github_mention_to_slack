<?php


namespace Kojirock5260\GithubMentionToSlack\UseCase;


use Kojirock5260\GithubMentionToSlack\Domain\Factory\IssueFactory;
use Kojirock5260\GithubMentionToSlack\Domain\Factory\PullRequestFactory;
use Kojirock5260\GithubMentionToSlack\Domain\Service\Notifier;

class NotifyPullRequest
{
    /**
     * @var PullRequestFactory
     */
    private $pullRequestFactory;

    /**
     * @var Notifier
     */
    private $notifier;

    /**
     * NotifyPullRequest constructor.
     * @param PullRequestFactory $issueFactory
     * @param Notifier $notifier
     */
    public function __construct(PullRequestFactory $pullRequestFactory, Notifier $notifier)
    {
        $this->pullRequestFactory = $pullRequestFactory;
        $this->notifier           = $notifier;
    }

    /**
     * @param array $request
     */
    public function __invoke(array $request):void
    {
        $issue = $this->pullRequestFactory->fromRequest($request);
        $issue->notify($this->notifier);
    }
}