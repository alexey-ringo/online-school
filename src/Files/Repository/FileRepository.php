<?php
declare(strict_types=1);

namespace App\Files\Repository;


use App\Files\Model\File;
use App\Files\Service\FileServiceInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileRepository extends ServiceEntityRepository implements FileRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * FileRepository constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $manager
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, File::class);
        $this->manager = $manager;
    }

    public function save(File $file): File
    {
        $this->manager->persist($file);
        $this->manager->flush();

        return $file;
    }

    public function oneByHash(string $hash): File
    {
        /** @var File|null $file */
        $file =  parent::findOneBy(['hash' => $hash]);
        if($file === null) {
            throw new NotFoundHttpException('Файл не найден!');
        }

        return $file;
    }

    public function remove(int $id): bool
    {
        /** @var File|null $file */
        $file = parent::find($id);
        if($file) {
            throw new NotFoundHttpException('Файл не найден!');
        }
        $this->manager->remove($file);

        return true;

    }
}