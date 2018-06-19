<?php

namespace App\EventSubscriber;

use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RedirectSuccessSubscriber implements EventSubscriberInterface
{

    private $router;

    /**
     * RedirectSuccessSubscriber constructor.
     * @param UrlGeneratorInterface $router
     */
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param FormEvent $event
     */
    public function onFosUserProfileEditSuccess(FormEvent $event)
    {
        $url = $this->router->generate('fos_user_profile_edit');

        $event->setResponse(new RedirectResponse($url));
    }

    /**
     * @param FormEvent $event
     */
    public function onChangePasswordSuccess(FormEvent $event)
    {
        $url = $this->router->generate('fos_user_change_password');

        $event->setResponse(new RedirectResponse($url));
    }

    /**
     * @param FormEvent $event
     */
    public function onResetPasswordSuccess(FormEvent $event)
    {
        $url = $this->router->generate('nao_interface');

        $event->setResponse(new RedirectResponse($url));
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'fos_user.profile.edit.success' => 'onFosUserProfileEditSuccess',
            'fos_user.change_password.edit.success' => 'onChangePasswordSuccess',
            'fos_user.resetting.reset.success' => 'onResetPasswordSuccess',
        ];
    }
}
