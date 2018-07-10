<?php
namespace App\Services;

use App\Entity\Observation;
use App\Entity\Player;
use App\Entity\User;

class MailerManager {
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var \Twig_Environment
     */
    private $templating;
    /**
     * @Const Mail Musée du Louvre
     */
    private const mail = 'agence.projet.oc@gmail.com';
    /**
     * MailerManager constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * Send message to the top winner of the tournament
     * @param Player $player
     * @param $tournament
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendFirstWinnerOfTn(Player $player, $tournament)
    {
        $subject = 'Vous êtes le vainqueur du tournoi';
        $from = MailerManager::mail;
        $to = $player->getUser()->getEmail();
        $body = $this->templating->render('mails/tournament/firstwinner.html.twig', [
            'player' => $player, 'tournament' => $tournament
        ]);
        $this->send($subject, $from, $to, $body);
    }

    /**
     * Send message to second winner of the tournament
     * @param Player $player
     * @param $tournament
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendSecondWinnerOfTn(Player $player, $tournament)
    {
        $subject = 'Vous avez terminé second du tournoi';
        $from = MailerManager::mail;
        $to = $player->getUser()->getEmail();
        $body = $this->templating->render('mails/tournament/secondwinner.html.twig', [
            'player' => $player, 'tournament' => $tournament
        ]);
        $this->send($subject, $from, $to, $body);
    }

    /**
     * Send message to third winner of the tournament
     * @param Player $player
     * @param $tournament
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendThirdWinnerOfTn(Player $player, $tournament)
    {
        $subject = 'Vous avez terminé troisième du tournoi';
        $from = MailerManager::mail;
        $to = $player->getUser()->getEmail();
        $body = $this->templating->render('mails/tournament/thirdwinner.html.twig', [
            'player' => $player, 'tournament' => $tournament
        ]);
        $this->send($subject, $from, $to, $body);
    }

    /**
     * @param User $user
     * @param Observation $observation
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendConfirmObservation(User $user, $observation)
    {
        if($user->isObsEmail() == 1)
        {
            $subject = 'Validation de votre observation';
            $from = MailerManager::mail;
            $to = $user->getEmail();
            $body = $this->templating->render('mails/observation/validation.html.twig', [
                'user' => $user, 'observation' => $observation
            ]);
            $this->send($subject, $from, $to, $body);
        }
    }

    /**
     * @param User $user
     * @param $observation
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendDeclinedObservation(User $user, $observation)
    {
        if($user->isObsEmail() == 1)
        {
            $subject = 'Refus de votre observation';
            $from = MailerManager::mail;
            $to = $user->getEmail();
            $body = $this->templating->render('mails/observation/declined.html.twig', [
                'user' => $user, 'observation' => $observation
            ]);
            $this->send($subject, $from, $to, $body);
        }
    }

    /**
     * Send Contact from Contact Form
     *
     * @param array $data
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function contactSend(array $data)
    {
        $subject = 'Nos Amis les Oiseaux - Contact';
        $from = $data['email'];
        $to = MailerManager::mail;
        $body = $this->templating->render('mails/contact.html.twig', ['data' => $data]);
        $this->send($subject, $from, $to, $body);
    }

    /**
     * Send mail for [accepted] application to become naturalist
     * @param $application
     * @param User $user
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function acceptedAppSend($application, User $user)
    {
        $subject = 'NAO - Candidature acceptée';
        $from = MailerManager::mail;
        $to = $user->getEmail();
        $body = $this->templating->render('mails/application/accepted.html.twig', ['application' => $application, 'user' => $user]);
        $this->send($subject, $from, $to, $body);
    }

    /**
     * Send mail for [declined] application to become naturalist
     * @param $application
     * @param User $user
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function declinedAppSend($application, User $user)
    {
        $subject = 'NAO - Candidature refusée';
        $from = MailerManager::mail;
        $to = $user->getEmail();
        $body = $this->templating->render('mails/application/declined.html.twig', ['application' => $application, 'user' => $user]);
        $this->send($subject, $from, $to, $body);
    }

    /**
     * Function Send Mail
     * @param string $subject
     * @param string $from
     * @param string $to
     * @param string $body
     */
    private function send(string $subject, string $from, string $to, string $body)
    {
        /** @var \Swift_Mime_SimpleMessage $mail */
        $mail = $this->mailer->createMessage();
        $mail->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body)
            ->setContentType('text/html');
        $this->mailer->send($mail);
    }
}