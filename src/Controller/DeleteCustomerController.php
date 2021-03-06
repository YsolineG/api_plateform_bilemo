<?php

namespace App\Controller;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DeleteCustomerController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
    $this->security = $security;
    }

    public function __invoke(Customer $data, EntityManagerInterface $entityManager): JsonResponse
    {
        $userId = $this->security->getUser()->getId();

        if($userId === $data->getUser()->getId()) {
            $entityManager->remove($data);
            $entityManager->flush();

            return $this->json(null, Response::HTTP_NO_CONTENT);
        }

        return $this->json('Acces interdit', Response::HTTP_FORBIDDEN);
    }
}