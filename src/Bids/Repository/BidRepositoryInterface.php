<?php
declare(strict_types=1);

namespace App\Bids\Repository;

use App\Bids\Model\Bid;

interface BidRepositoryInterface
{
    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return Bid[]
     */
    public function all(array $criteria = [], array $orderBy = null, $limit = null, $offset = null): array;

    /**
     * Get one
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function one(int $id): Bid;


    /**
     * Create new Bid
     *
     * @param  Bid $bid
     *
     * @return Bid
     */
    public function save(Bid $bid): Bid;

    /**
     * update exist Bid
     *
     * @param  Bid $bid
     *
     * @return Bid
     */
    public function update(Bid $bid): Bid;
}