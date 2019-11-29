<?php
declare(strict_types=1);

namespace App\Bids\Service;

use App\Bids\Model\Bid;

interface BidServiceInterface
{
    /**
     * create
     *
     * @param  string $lastname
     * @param  string $firstName
     * @param  string $email
     * @param  int $age
     * @param  string $phone
     * @param  string $employ
     * @param  string|null $middleName
     * @param  string|null $information
     *
     * @return Bid
     */    
    public function create(string $lastname, string $firstName, 
                           string $email, int $age, string $phone, 
                           string $employ, string $middleName = null,
                           string $information = null): Bid;

    /**
     * call
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function call(int $id): Bid;

    /**
     * accept
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function accept(int $id): Bid;

    /**
     * reject
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function reject(int $id): Bid;

    /**
     * postponed
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function postponed(int $id): Bid;

    /**
     * confirm
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function confirm(int $id): Bid;


}