<?php


namespace Kojirock5260\GithubMentionToSlack\UseCase;


use Kojirock5260\GithubMentionToSlack\Domain\Factory\IssueFactory;
use Kojirock5260\GithubMentionToSlack\Domain\Service\Notifier;

class NotifyIssue
{
    /**
     * @var IssueFactory
     */
    private $issueFactory;

    /**
     * @var Notifier
     */
    private $notifier;

    /**
     * NotifyIssue constructor.
     * @param IssueFactory $issueFactory
     * @param Notifier $notifier
     */
    public function __construct(IssueFactory $issueFactory, Notifier $notifier)
    {
        $this->issueFactory = $issueFactory;
        $this->notifier     = $notifier;
    }

    /**
     * @param array $request
     */
    public function __invoke(array $request):void
    {
        $issue = $this->issueFactory->fromRequest($request);
        $issue->notify($this->notifier);
    }
}