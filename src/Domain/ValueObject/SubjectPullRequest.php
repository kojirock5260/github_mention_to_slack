<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\ValueObject;


use DomainException;

class SubjectPullRequest
{
    private const CREATE  = '新たにPullRequestが作成されました。';
    private const COMMENT = 'PullRequestにコメントがつきました。';
    private const CLOSE   = "PullRequestがクローズされました。\nお疲れさまでした！";
    private const MERGED  = "PullRequestがマージされました！\nお疲れさまでした！";
    private const APPROVE = 'PullRequestが許可されました。';
    private const REJECT  = "PullRequestに修正依頼がきています！\n確認してください！";

    /**
     * @var string
     */
    private $value;

    /**
     * SubjectPullRequest constructor.
     * @param Action $action
     * @param bool $isMerged
     * @param ReviewState|null $reviewState
     */
    public function __construct(Action $action, bool $isMerged, ?ReviewState $reviewState)
    {
        if ($action->isOpened()) {
            $this->value = self::CREATE;
        } elseif ($action->isClosed()) {
            $this->value = $isMerged ? self::MERGED : self::CLOSE;
        } elseif ($action->isSubmitted() && $reviewState) {
            if ($reviewState->isApprove()) {
                $this->value = self::APPROVE;
            } elseif ($reviewState->isReject()) {
                $this->value = self::REJECT;
            } else {
                $this->value = self::COMMENT;
            }
        } else {
            throw new DomainException("invalid action => {$action}");
        }
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->value;
    }
}