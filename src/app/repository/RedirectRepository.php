<?php

declare(strict_types=1);

namespace Redir\app\repository;

use Redir\app\dto\Redirect;
use Redir\app\persistence\RedirectDao;

class RedirectRepository
{

    private RedirectDao $dao;

    /**
     * RedirectRepository constructor.
     *
     * @param RedirectDao $dao
     */
    public function __construct(RedirectDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * @param  string $uri
     * @return Redirect|null
     */
    public function findRedirectByUri(string $uri): ?Redirect
    {
        return $this->dao->findRedirectByUri($uri);
    }

    public function recordHit(Redirect $redirect): void
    {
        $this->dao->recordHit($redirect->getId());
    }
}
