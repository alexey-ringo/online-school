<?php
declare(strict_tipes=1);

namespace App\Controller\API\Users;

use App\Users\Service\UsersServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UsersController
 * @package App\Contriller\API\Users
 */
class UsersController extends AbstractController
{
    private $usersService;

    public function __construct(UsersServiceInterface $usersService)    
    {
        $this->usersService = $usersService;
    }

    /**
     * @Route("/signup", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function signup(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->usersService->signup(
            $data['email'],
            $data['password']
        );

        return $this->json($user);
    }
}
