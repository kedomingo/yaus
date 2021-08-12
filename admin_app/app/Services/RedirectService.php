<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidRedirectException;
use App\Models\Redirect;
use App\Repositories\RedirectRepository;
use Illuminate\Database\Eloquent\Collection;

class RedirectService
{
    private const CACHE_LIFETIME = 'PT10M';

    private RedirectRepository $repository;

    /**
     * RedirectService constructor.
     * @param RedirectRepository $repository
     */
    public function __construct(RedirectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getRedirects(): Collection
    {
        return $this->repository->getRedirects();
    }

    public function findRedirectById(int $id): ?Redirect
    {
        return $this->repository->findRedirectById($id);
    }

    /**
     * @param string $uri
     * @param string $destination
     * @param bool   $isActive
     *
     * @return Redirect
     * @throws InvalidRedirectException
     */
    public function createRedirect(string $uri, string $destination, bool $isActive): Redirect
    {
        $uri = '/' . ltrim($uri, '/');
        if ($uri === '/admin') {
            throw new InvalidRedirectException('Short URL "admin" cannot be used');
        }

        $existing = $this->repository->findRedirectByUri($uri);
        if ($existing !== null) {
            throw new InvalidRedirectException("Short URL $uri already exists");
        }

        return $this->repository->createRedirect($uri, $destination, $isActive);
    }

    /**
     * @param int    $id
     * @param string $uri
     * @param string $destination
     * @param bool   $isActive
     *
     * @return Redirect|null
     */
    public function updateRedirect(int $id, string $uri, string $destination, bool $isActive): ?Redirect
    {
        $uri = '/' . ltrim($uri, '/');
        
        return $this->repository->updateRedirect($id, $uri, $destination, $isActive);
    }
}
