<?php


namespace Kojirock5260\GithubMentionToSlack\UseCase;


use Kojirock5260\GithubMentionToSlack\Domain\Factory\ReviewFactory;
use Kojirock5260\GithubMentionToSlack\Domain\Service\Notifier;

class NotifyReview
{
    /**
     * @var ReviewFactory
     */
    private $reviewFactory;

    /**
     * @var Notifier
     */
    private $notifier;

    /**
     * NotifyReview constructor.
     * @param ReviewFactory $reviewFactory
     * @param Notifier $notifier
     */
    public function __construct(ReviewFactory $reviewFactory, Notifier $notifier)
    {
        $this->reviewFactory = $reviewFactory;
        $this->notifier      = $notifier;
    }

    /**
     * @param array $request
     */
    public function __invoke(array $request):void
    {
        $issue = $this->reviewFactory->fromRequest($request);
        $issue->notify($this->notifier);
    }
}