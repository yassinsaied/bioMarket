<?php

namespace App\Events;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EncoderPasswordSubscriber implements EventSubscriberInterface
{
    private $encodPass;

    public function __construct(UserPasswordEncoderInterface $UserPasswordEncoderInterface)
    {
        $this->encodPass = $UserPasswordEncoderInterface;
    }

    public static function getSubscribedEvents()
    {
        return [

            KernelEvents::VIEW => ['onEncoderPassword', EventPriorities::PRE_WRITE]

        ];
    }


    public function onEncoderPassword(ViewEvent $event)
    {
        $user = $event->getControllerResult();
        dump($user);
        $method = $event->getRequest()->getMethod();
        if ($user instanceof User && $method === "POST") {

            $passwordCrypted =
                $this->encodPass->encodePassword($user, $user->getPassword());
            $user->setPassword($passwordCrypted);
        }
    }
}
