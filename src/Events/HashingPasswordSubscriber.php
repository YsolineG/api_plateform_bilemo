<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HashingPasswordSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $hashingPassword;

    public function __construct(UserPasswordHasherInterface $hashingPassword)
    {
        $this->hashingPassword = $hashingPassword;
    }

    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            KernelEvents::VIEW => ['hashingPassword', EventPriorities::PRE_WRITE]
        ];
    }

    public function hashingPassword(ViewEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if($user instanceof User && $method === "POST") {
            $plaintextPassword = $user->getPassword();
            $hashedPassword = $this->hashingPassword->hashPassword($user, $plaintextPassword);
            $user->setPassword($hashedPassword);
        }
    }
}