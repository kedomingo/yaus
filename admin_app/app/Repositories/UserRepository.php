<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use DB;
use Hash;
use RuntimeException;

class UserRepository
{
    /**
     * @param string $email
     * @param string $password
     * @param string $name
     *
     * @return User
     * @throws RuntimeException
     */
    public function create(string $email, string $password, string $name): User
    {
        $existing = User::where('email', '=', $email)->first();
        if ($existing !== null) {
            throw new RuntimeException('User with email ' . $email . ' already exists');
        }

        $user = new User(
            [
                'email' => $email,
                'name' => $name,
                'password' => Hash::make($password)
            ]
        );
        $user->save();

        return $user;
    }
}
