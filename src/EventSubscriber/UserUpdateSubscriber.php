<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserUpdateSubscriber implements EventSubscriberInterface
{

    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    /**
     * @param BeforeEntityPersistedEvent|BeforeEntityUpdatedEvent $event
     */
    public function onBeforeEntityPersistedEvent($event)
    {
        $user = $event->getEntityInstance();

        if (!$user instanceof User){
            return;
        }

        if (!empty($user->getPlainPassword())){
            $pwd = $this->encoder->hashPassword($user, $user->getPlainPassword());
            $user->setPassword($pwd);
        }
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => 'onBeforeEntityPersistedEvent',
            BeforeEntityUpdatedEvent::class => 'onBeforeEntityPersistedEvent',
        ];
    }
}
