<?php declare(strict_types=1);

namespace Redir\app\services;

use Redir\app\dto\Redirect;
use Redir\app\repository\RedirectRepository;

class RedirectProvider
{
    private RedirectRepository $repository;

    /**
     * RedirectProvider constructor.
     * @param RedirectRepository $repository
     */
    public function __construct(RedirectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $uri
     * @return Redirect|null
     */
    public function findRedirectByUri(string $uri): ?Redirect
    {
        return $this->repository->findRedirectByUri($uri);
    }

    public function recordHit(Redirect $redirect): void
    {
        $this->repository->recordHit($redirect);
    }
}
