<?php

declare(strict_types=1);

namespace Redir\app\dto;

use DateTimeImmutable;

class Redirect
{

    private ?int $id;
    private string $uri;
    private string $destination;
    private int $hits;

    /**
     * @var string|DateTimeImmutable
     */
    private $created;

    /**
     * @var string|DateTimeImmutable|null
     */
    private $updated;

    private function __construct()
    {
        $this->created = new DateTimeImmutable($this->created);
        $this->updated = $this->updated !== null ? new DateTimeImmutable($this->updated) : null;
        if (empty($this->hits)) {
            $this->hits = 0;
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @return int
     */
    public function getHits(): int
    {
        return $this->hits;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdated(): ?DateTimeImmutable
    {
        return $this->updated;
    }
}
