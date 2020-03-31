<?php

declare(strict_types=1);

namespace Kojirock5260\GithubMentionToSlack\Test\Github;

use Kojirock5260\GithubMentionToSlack\Github\GithubWebhookParameter;
use PHPUnit\Framework\TestCase;

class GithubWebhookParameterTest extends TestCase
{
    /**
     * @test
     */
    public function getRepositoryName(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertSame('repository_name', $parameter->getRepositoryName());
    }

    /**
     * @test
     */
    public function getRepositoryLabel(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertSame('【repository_name】', $parameter->getRepositoryLabel());
    }

    /**
     * @test
     */
    public function isIssue(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertFalse($parameter->isIssue());
    }

    /**
     * @test
     */
    public function isReview(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertTrue($parameter->isReview());
    }

    /**
     * @test
     */
    public function isMerged(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertTrue($parameter->isMerged());
    }

    /**
     * @test
     */
    public function getIssueTitle(): void
    {
        $parameter = new GithubWebhookParameter($this->getIssueJson());
        $this->assertSame('xxxxxxxxxxxx', $parameter->getIssueTitle());
    }

    /**
     * @test
     */
    public function getComment(): void
    {
        $parameter = new GithubWebhookParameter($this->getIssueJson());
        $this->assertSame('xxxxxxxxxxxxxxxxxxxxxxxx', $parameter->getComment());
    }

    /**
     * @test
     */
    public function getIssueUrl(): void
    {
        $parameter = new GithubWebhookParameter($this->getIssueJson());
        $this->assertSame('https://github.com/pull/1', $parameter->getIssueUrl());
    }

    /**
     * @test
     */
    public function getPullRequestTitle(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertSame('pull request 1', $parameter->getPullRequestTitle());
    }

    /**
     * @test
     */
    public function getPullRequestBody(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertSame('xxxxxxxxxxxxxxxxxxxxx', $parameter->getPullRequestBody());
    }

    /**
     * @test
     */
    public function getPullRequestUrl(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertSame('https://github.com/xxxxxx/pull/1', $parameter->getPullRequestUrl());
    }

    /**
     * @test
     */
    public function getPullRequestUserName(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertSame('kojirock5260', $parameter->getPullRequestUserName());
    }

    /**
     * @test
     */
    public function getReviewBody(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertSame('ＬＧＴＭ', $parameter->getReviewBody());
    }

    /**
     * @test
     */
    public function getAction(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertSame('submitted', $parameter->getAction());
    }

    /**
     * @test
     */
    public function isOpenedAction(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertFalse($parameter->isOpenedAction());
    }

    /**
     * @test
     */
    public function isCreatedAction(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertFalse($parameter->isCreatedAction());
    }

    /**
     * @test
     */
    public function isClosedAction(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertFalse($parameter->isClosedAction());
    }

    /**
     * @test
     */
    public function isSubmittedAction(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertTrue($parameter->isSubmittedAction());
    }

    /**
     * @test
     */
    public function isPullRequestApprove(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertTrue($parameter->isPullRequestApprove());
    }

    /**
     * @test
     */
    public function isPullRequestReject(): void
    {
        $parameter = new GithubWebhookParameter($this->getJson());
        $this->assertFalse($parameter->isPullRequestReject());
    }

    /**
     * @return string
     */
    private function getJson(): string
    {
        return <<<'JSON'
{
  "action": "submitted",
  "review": {
    "body": "ＬＧＴＭ",
    "state": "approved"
  },
  "pull_request": {
    "html_url": "https://github.com/xxxxxx/pull/1",
    "title": "pull request 1",
    "user": {
      "login": "kojirock5260"
    },
    "body": "xxxxxxxxxxxxxxxxxxxxx",
    "merged": true
  },
  "repository": {
    "name": "repository_name"
  }
}
JSON;
    }

    /**
     * @return string
     */
    private function getIssueJson(): string
    {
        return <<<'JSON'
{
  "action": "created",
  "issue": {
    "html_url": "https://github.com/pull/1",
    "title": "xxxxxxxxxxxx"
  },
  "comment": {
    "body": "xxxxxxxxxxxxxxxxxxxxxxxx"
  }
}
JSON;
    }
}
