<?php
declare(strict_types=1);

namespace App\Bids\Service;
use App\Bids\Model\Bid;
use App\Bids\Repository\BidRepositoryInterface;

class BidService implements BidServiceInterface
{
    private $repository;

    public function __construct(BidRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
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
                           string $information = null): Bid
    {
        $bid = new Bid($lastname, $firstName, $email, $age, $phone, $employ);

        $bid->setInformation($information);

        $bid->setMiddleName($middleName);

        $this->repository->save($bid);       

        return $bid;
    }

    /**
     * call
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function call(int $id): Bid
    {
        $bid = $this->repository->one($id);
        //Меняем статус заявки
        $bid->call();

        $this->repository->update($bid);

        return $bid;
    }
    /**
     * accept
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function accept(int $id): Bid
    {
        $bid = $this->repository->one($id);
        //Меняем статус заявки
        $bid->accept();

        $this->repository->update($bid);

        return $bid;
    }

    /**
     * reject
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function reject(int $id): Bid
    {
        $bid = $this->repository->one($id);
        //Меняем статус заявки
        $bid->reject();

        $this->repository->update($bid);

        return $bid;
    }

    /**
     * postponed
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function postponed(int $id): Bid
    {
        $bid = $this->repository->one($id);
        //Меняем статус заявки
        $bid->postponed();

        $this->repository->update($bid);

        return $bid;
    }

    /**
     * confirm
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function confirm(int $id): Bid
    {
        $bid = $this->repository->one($id);
        //Меняем статус заявки
        $bid->confirm();

        $this->repository->update($bid);

        return $bid;
    }
}
