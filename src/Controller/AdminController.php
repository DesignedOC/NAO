<?php
namespace App\Controller;

use App\Entity\Player;
use App\Entity\Tournament;
use App\Services\MailerManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    /**
     * @var MailerManager
     */
    private $mailer;

    /**
     * AdminController constructor.
     * @param MailerManager $mailerManager
     */
    public function __construct(MailerManager $mailerManager)
    {
        $this->mailer = $mailerManager;
    }

    /**
     * Close the tournament and send email to winners
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function fermerAction()
    {
        $id = $this->request->query->get('id');
        $tournament = $this->em->getRepository(Tournament::class)->findOneBy(['id' => $id]);

        $firstWinner = $this->em->getRepository(Player::class)->findTopOneOfTn($tournament);
        $secondWinner = $this->em->getRepository(Player::class)->findTopSecondOfTn($tournament);
        $thirdWinner = $this->em->getRepository(Player::class)->findTopThirdOfTn($tournament);

        if($tournament->getActive() == 1)
        {
            $tournament->setEndDate(new \DateTime('NOW'));
            $tournament->setActive(0);
            if($tournament->getPlayers())
            {
                if($firstWinner)
                {
                    $this->mailer->sendFirstWinnerOfTn($firstWinner, $tournament);
                }
                if($secondWinner)
                {
                    $this->mailer->sendSecondWinnerOfTn($secondWinner, $tournament);
                }
                if($thirdWinner)
                {
                    $this->mailer->sendThirdWinnerOfTn($thirdWinner, $tournament);
                }
            }
        }
        $this->em->flush();

        // redirect to the 'list' view of the given entity
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => $this->request->query->get('entity'),
        ));

    }


    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function persistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }
    public function updateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

}