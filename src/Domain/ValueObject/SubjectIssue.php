<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\ValueObject;


use DomainException;

class SubjectIssue
{
    private const CREATE  = '新たにIssueが作成されました。';
    private const COMMENT = 'コメントが追加されました。';
    private const CLOSE   = "Issueがクローズされました。\nお疲れさまでした！";

    /**
     * @var string
     */
    private $value;

    /**
     * SubjectIssue constructor.
     * @param Action $action
     * @throws DomainException
     */
    public function __construct(Action $action)
    {
        if ($action->isOpened()) {
            $this->value = self::CREATE;
        } elseif ($action->isClosed()) {
            $this->value = self::CLOSE;
        } elseif ($action->isCreated()) {
            $this->value = self::COMMENT;
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