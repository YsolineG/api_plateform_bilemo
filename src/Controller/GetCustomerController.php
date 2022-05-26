<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Security\Core\Security;

#[AsController]
class GetCustomerController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function __invoke(Customer $data): Customer|Response
    {
       $userId = $this->security->getUser()->getId();

       if($userId === $data->getUser()->getId()) {
           return $data;
       }

       return $this->json(['message' => 'Accès interdit'], Response::HTTP_FORBIDDEN);
    }
}