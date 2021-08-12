<?php

declare(strict_types=1);

namespace Redir\app\persistence;

use PDO;
use Redir\app\dto\Redirect;

class RedirectDao
{
    private PDO $pdo;

    /**
     * RedirectDao constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findRedirectByUri(string $uri, $activeOnly = true): ?Redirect
    {
        $sql = 'SELECT id, uri, destination, hits, created, updated FROM redirects WHERE uri=:uri';
        if ($activeOnly) {
            $sql .= ' AND is_active=1';
        }
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue('uri', $uri);

        $statement->execute();

        $result = $statement->fetchObject(Redirect::class);

        return empty($result) ? null : $result;
    }

    public function recordHit(int $redirectId): void
    {
        $sql = 'UPDATE redirects SET hits = hits + 1 WHERE id=:id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue('id', $redirectId);

        $statement->execute();
    }
}
