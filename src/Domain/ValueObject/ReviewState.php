<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\ValueObject;


class ReviewState
{
    private const APPROVE = 'approved';
    private const REJECT  = 'changes_requested';

    /**
     * ReviewState constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isApprove():bool
    {
        return $this->value === self::APPROVE;
    }

    /**
     * @return bool
     */
    public function isReject():bool
    {
        return $this->value === self::REJECT;
    }
}