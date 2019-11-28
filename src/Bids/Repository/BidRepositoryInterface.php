<?php
declare(strict_types=1);

namespace App\Bids\Repository;

interface BidRepositoryInterface
{
    /**
     * Get all
     *
     * @return Bid[]
     */
    public function all(): array;

    /**
     * Get one
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function one(int $id): Bid;


    /**
     * save
     *
     * @param  Bid $bid
     *
     * @return Bid
     */
    public function save(Bid $bid): Bid;

    /**
     * update
     *
     * @param  Bid $bid
     *
     * @return Bid
     */
    public function update(Bid $bid): Bid;
}