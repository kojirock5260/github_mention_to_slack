<?php


namespace Kojirock5260\GithubMentionToSlack\Domain\ValueObject;


class RepositoryName
{
    /**
     * @var string
     */
    private $value;

    /**
     * RepositoryName constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function toLabel():string
    {
        return "[{$this->value}]";
    }
}