<?php

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Users\Domain\Model\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Find all users.
     *
     * @return Collection<int, User> Collection of User objects
     */
    public function findAll(): Collection;

    /**
     * Create a new user.
     *
     * @param array<string, mixed> $data Associative array with the user data (e.g. ['name' => 'User Name', 'email' => jdoe@example.com])
     * @return User The created User object
     */
    public function create(array $data): User;

    /**
     * Update an existing user.
     *
     * @param User $user The user to update
     * @param array<string, mixed> $data Associative array with the updated user data
     * @return void
     */
    public function update(User $user, array $data): void;

    public function delete(int $id): void;

    public function findById(int $id): ?User;

    public function save(User $user): void;
}
