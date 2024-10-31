<?php


declare(strict_types=1);

namespace App\Users\Infrastructure\Repository;

use App\Users\Domain\Model\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Find all users.
     *
     * @return Collection<int, User> Collection of User objects
     */
    public function findAll(): Collection
    {
        return User::all(); 
    }

    /**
     * Find a user by its ID.
     *
     * @param int $id The ID of the user
     * @return User|null The User object or null if not found
     */
    public function findById(int $id): ?User
    {
        return User::query()->find($id); 
    }

    /**
     * Create a new user.
     *
     * @param array<string, mixed> $data Associative array with the user data
     * @return User The created User object
     */
    public function create(array $data): User
    {
        return User::query()->create($data); 
    }

    /**
     * Update an existing user.
     *
     * @param User $user The user to update
     * @param array<string, mixed> $data Associative array with the updated user data
     * @return void
     */
    public function update(User $user, array $data): void
    {
        $user->update($data);
    }

    /**
     * Delete a user by its ID.
     *
     * @param int $id The ID of the user to delete
     * @return void
     */
    public function delete(int $id): void
    {
        $user = $this->findById($id);
        if ($user) {
            $user->delete();
        }
    }

    /**
     * Save a user.
     *
     * @param User $user The user to save
     * @return void
     */
    public function save(User $user): void
    {
        $user->save();
    }
}
