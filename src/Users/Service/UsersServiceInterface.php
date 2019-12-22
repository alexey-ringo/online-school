<?php
declare(strict_types=1);

namespace App\Users\Service;

use App\Bids\Model\Bid;
use App\Users\Model\User;

/**
 * Interface UsersServiceInterface
 * @package App\Users\Service
 */
interface UsersServiceInterface
{
    /**
     * signup
     *
     * @param  string $email
     * @param  string $password
     *
     * @return User
     */
    public function signup(string $email, string $password): User;

    /**
     * create
     *
     * @param  string $email
     * @param  string $password
     * @param  array $prevs
     *
     * @return User
     */
    public function create(string $email, string $password, array $prevs): User;

    /**
     * createFromBid
     *
     * @param  Bid $bid
     *
     * @return User
     */
    //public function createFromBid(Bid $bid): User;

    /**
     * list
     *
     * @param  array $order
     * @param  int $limit
     * @param  int $offset
     *
     * @return User[]
     */
    public function list(array $order, int $limit, int $offset): array;

    /**
     * one
     *
     * @param  int $id
     *
     * @return User
     */
    public function one(int $id): User;

}
