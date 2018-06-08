<?php
namespace App\Services;

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
    private const mail = 'no-reply@nao.com';
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