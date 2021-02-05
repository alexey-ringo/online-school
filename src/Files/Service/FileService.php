<?php
declare(strict_types=1);

namespace App\Files\Service;


use App\Files\Model\File;
;

use App\Files\Repository\FileRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

class FileService implements FileServiceInterface
{
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var FileRepositoryInterface
     */
    private $repository;

    /**
     * FileService constructor.
     * @param Filesystem $filesystem
     * @param KernelInterface $kernel
     */
    public function __construct(Filesystem $filesystem, KernelInterface $kernel, FileRepositoryInterface $repository)
    {
        $this->filesystem = $filesystem;
        $this->kernel = $kernel;
        $this->repository = $repository;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return File
     * @throws \Exception
     */
    public function upload(UploadedFile $uploadedFile): File
    {
        $dir = (new \DateTime())->format("Y/m/d");
        $uploadDir = $this->kernel->getProjectDir() . "/var/uploads" . $dir;
        $fileName = $this->generateFileName($uploadedFile);

        $loadedFile = $uploadedFile->move($uploadDir, $fileName);

        $file = new File($loadedFile);

        $this->repository->save($file);

        return $file;
    }

    /**
     * @param string $hash
     * @return File
     */
    public function getFile(string $hash): File
    {
        $file = $this->repository->oneByHash($hash);

        return $file;
    }

    private function generateFileName(UploadedFile $file): string
    {
        $hash = base64_encode(hash("sha256", uniqid()));
        $fileName = $hash . "." . $file->getClientOriginalExtension();

        return $fileName;
    }
}