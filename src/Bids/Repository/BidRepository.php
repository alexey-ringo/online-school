<?php
declare(strict_types=1);

namespace App\Bids\Repository;

use App\Bids\Model\Bid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\Common\Persistence\ObjectManager;

class BidRepository extends ServiceEntityRepository implements BidRepositoryInterface
{
    //store, delete and update into db table
    private $manager;
    
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)    
    {
        $this->manager = $manager;
        parent::__construct($registry, Bid::class);
    }
        
    
    /**
     * Get all
     *
     * @return Bid[]
     */
    public function all(): array
    {
        $bids = parent::findAll();

        return $bids;
    }

    /**
     * Get one
     *
     * @param  int $id
     *
     * @return Bid
     */
    public function one(int $id): Bid
    {
        /**
         * @var Bid $bid
         */
        $bid = parent::findOneBy(['id' => $id]);

        if($bid == null) {
            throw new \RuntimeException("Заявка {$id} не найдена");
        }

        return $bid;
    }


    /**
     * save
     *
     * @param  Bid $bid
     *
     * @return Bid
     * 
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(Bid $bid): Bid
    {
        //фиксирует состояние $bid
        $this->manager->persist($bid);
        //сохраняет все объекты, зафиксированные с помощью persist()
        $this->manager->flush();

        //У $bid при врзвращении (т.е. - уже после сохранения) уже проставится id
        return $bid;
    }

    /**
     * update
     *
     * @param  Bid $bid
     *
     * @return Bid
     * 
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Bid $bid): Bid
    {
        $this->manager->flush();

        return $bid;
    }
}
