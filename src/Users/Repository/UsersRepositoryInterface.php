<?php
declare(strict_types=1);

namespace App\Users\Repository;

use App\Users\Model\User;

/**
 * Interface UsersRepositoryInterface
 * @package App\Users\Repository
 */
interface UsersRepositoryInterface
{
    /**
     * all
     *
     * @param  array $criteria
     * @param  array|null $order
     * @param  int|null $limit
     * @param  int|null $offset
     *
     * @return array
     */
    public function all(array $criteria = [], array $order = null, int $limit = null, int $offset = null): array;
    
    /**
     * one
     *
     * @param  int $id
     *
     * @return User
     */
    public function one(int $id): User;

    /**
     * save
     *
     * @param  User $user
     *
     * @return User
     */
    public function save(User $user): User;

    /**
     * update
     *
     * @param  User $user
     *
     * @return User
     */
    public function update(User $user): User;

}
