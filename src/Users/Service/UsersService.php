<?php
declare(strict_types=1);

namespace App\Users\Service;

use App\Bids\Model\Bid;
use App\Users\Model\User;
use App\Users\Repository\UsersRepositoryInterface;

class UsersService implements UsersServiceInterface
{
    /** @var UserRepositoryInterface */
    private $repository;

    public function __construct(UsersRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * signup
     *
     * @param  string $email
     * @param  string $password
     *
     * @return User
     */
    public function signup(string $email, string $password): User
    {
        $user = User::signup($email, $password);

        $this->repository->save($user);

        return $user;
    }

    /**
     * create
     *
     * @param  string $email
     * @param  string $password
     * @param  array $prevs
     *
     * @return User
     */
    public function create(string $email, string $password, array $prevs): User
    {
        $user = User::createFromAdmin($email, $password, $prevs);

        $this->repository->save($user); //ToDo - verify email unique!

        return $user;
    }

    /**
     * createFromBid
     *
     * @param  Bid $bid
     *
     * @return User
     */
    //public function createFromBid(Bid $bid): User
    //{
    //
    //}

    /**
     * list
     *
     * @param  array $order
     * @param  int $limit
     * @param  int $offset
     *
     * @return User[]
     */
    public function list(array $order, int $limit, int $offset): array
    {
        return $this->repository->all([], $order, $limit, $offset);
    }

    /**
     * one
     *
     * @param  int $id
     *
     * @return User
     */
    public function one(int $id): User
    {
        return $this->repository->one($id);
    }
}
