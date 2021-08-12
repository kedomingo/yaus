<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use RuntimeException;

class UserService
{
    private UserRepository $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string      $email
     * @param string      $password
     * @param string|null $name
     *
     * @return User
     * @throws RuntimeException
     */
    public function create(string $email, string $password, ?string $name): User
    {
        $name = $name ?? '';
        $password = $password ?? sha1(uniqid('', true));

        return $this->repository->create($email, $password, $name);
    }
}
