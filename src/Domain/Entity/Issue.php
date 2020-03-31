<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\Entity;


use Kojirock5260\GithubMentionToSlack\Domain\Service\Notifier;
use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\BodyIssue;
use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\RepositoryName;
use Kojirock5260\GithubMentionToSlack\Domain\ValueObject\SubjectIssue;

class Issue
{
    /**
     * @var RepositoryName
     */
    private $repositoryName;

    /**
     * @var SubjectIssue
     */
    private $subjectWithIssue;

    /**
     * @var BodyIssue
     */
    private $bodyWithIssue;

    /**
     * @var Mentions
     */
    private $mentions;

    /**
     * Issue constructor.
     * @param RepositoryName $repositoryName
     * @param SubjectIssue $subjectWithIssue
     * @param BodyIssue $bodyWithIssue
     * @param Mentions $mentions
     */
    public function __construct(RepositoryName $repositoryName, SubjectIssue $subjectWithIssue, BodyIssue $bodyWithIssue, Mentions $mentions)
    {
        $this->repositoryName   = $repositoryName;
        $this->subjectWithIssue = $subjectWithIssue;
        $this->bodyWithIssue    = $bodyWithIssue;
        $this->mentions         = $mentions;
    }

    /**
     * @param Notifier $notifier
     */
    public function notify(Notifier $notifier):void
    {
        $notifier->notify($this->subject(), $this->body());
    }

    /**
     * @return string
     */
    private function subject():string
    {
        return "{$this->repositoryName->toLabel()}\n{$this->subjectWithIssue}";
    }

    /**
     * @return string
     */
    private function body():string
    {
        return $this->mentions->replace($this->bodyWithIssue->toBody());
    }
}