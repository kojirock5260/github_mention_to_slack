<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\ValueObject;


use InvalidArgumentException;

class Action
{
    private const OPENED    = 'opened';
    private const CLOSED    = 'closed';
    private const CREATED   = 'created';
    private const SUBMITTED = 'submitted';

    /**
     * @var string
     */
    private $value;

    /**
     * Action constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!in_array($value, [
            self::OPENED,
            self::CLOSED,
            self::CREATED,
            self::SUBMITTED
        ], true)) {
            throw new InvalidArgumentException("invalid action => {$value}");
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isOpened():bool
    {
        return $this->value === self::OPENED;
    }

    /**
     * @return bool
     */
    public function isClosed():bool
    {
        return $this->value === self::CLOSED;
    }

    /**
     * @return bool
     */
    public function isCreated():bool
    {
        return $this->value === self::CREATED;
    }

    /**
     * @return bool
     */
    public function isSubmitted():bool
    {
        return $this->value === self::SUBMITTED;
    }
}