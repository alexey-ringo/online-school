<?php
declare(strict_types=1);

namespace App\Bids\Repository;

use App\Bids\Model\Bid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BidRepository extends ServiceEntityRepository implements BidRepositoryInterface
{
    //for store, delete and update into db table
    private $manager;
    
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)    
    {
        $this->manager = $manager;
        parent::__construct($registry, Bid::class);
    }
        
    
    /**
     * @inheritdoc
     * @param array $criteria
     * @param array|null $orderBy
     * @param int $limit
     * @param null $offset
     * @return Bid[]
     */
    public function all(array $criteria = [], array $orderBy = null, $limit = 10, $offset = null): array
    {
        if($orderBy == null){
            $orderBy['id'] = 'DESC';
        }

        /** @var Bid[] $bids */
        $bids = parent::findBy($criteria, $orderBy, $limit, $offset);

        return $bids;
    }


    /**
     * Get one
     *
     * @param  int $id
     * @return Bid
     */
    public function one(int $id): Bid
    {
        /**
         * @var Bid $bid
         */
        $bid = parent::findOneBy(['id' => $id]);

        if($bid == null) {
            throw new NotFoundHttpException("Заявка {$id} не найдена");
        }

        return $bid;
    }


    /**
     * create new Bid
     *
     * @param  Bid $bid
     * @return Bid 
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
     * update exist Bid
     *
     * @param  Bid $bid
     * @return Bid
     */
    public function update(Bid $bid): Bid
    {
        $this->manager->flush();

        return $bid;
    }
}
