<?php
declare(strict_types=1);

namespace App\Controller\API\Files;


use App\Files\Service\FileServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    /**
     * @var FileServiceInterface
     */
    private $fileService;

    /**
     * FileController constructor.
     * @param FileServiceInterface $fileService
     */
    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @Route("/", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        /** @var UploadedFile $file */
        $uploadedFile = $request->files->get('file');

        if($uploadedFile === null) {
            throw new \LogicException('Не передан файл');
        }

        $file = $this->fileService->upload($uploadedFile);


        return $this->json($file);
    }


    /**
     * @Route("/{hash}", methods={"GET"})
     * @param string $hash
     * @return BinaryFileResponse
     */
    public function preview(string $hash): BinaryFileResponse
    {
        $file = $this->fileService->getFile($hash);

        return $this->file($file->fullPath(), null, ResponseHeaderBag::DISPOSITION_INLINE);
    }


    /**
     * @Route("/{hash}/download", methods={"GET"})
     * @param string $hash
     * @return BinaryFileResponse
     */
    public function download(string $hash): BinaryFileResponse
    {
        $file = $this->fileService->getFile($hash);

        return $this->file($file->fullPath());
    }

}