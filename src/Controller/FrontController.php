<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Services\MailerManager;
use App\Services\MainManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    /**
     * @Route("/", name="nao_home")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/association", name="nao_association")
     * @param MainManager $mainManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function association(MainManager $mainManager)
    {
        $observations = $mainManager->getAllCountObservations();
        $birds = $mainManager->getAllCountBirds();

        return $this->render('front/association.html.twig',[
               'observations' => $observations,
                'birds' => $birds
        ]);
    }

    /**
     * @Route("/mentions-legales", name="nao_mentions")
     */
    public function mentions()
    {
        return $this->render('front/mentions.html.twig');
    }

    /**
     * @Route("/conditions-generales", name="nao_conditions")
     */
    public function conditions()
    {
        return $this->render('front/conditions.html.twig');
    }

    /**
     * @Route("/foire-aux-questions", name="nao_faq")
     */
    public function faq()
    {
        return $this->render('front/faq.html.twig');
    }

    /**
     * @Route("/contact", name="nao_contact")
     * @param Request $request
     * @param MailerManager $mailerManager
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function contact(Request $request, MailerManager $mailerManager)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mailerManager->contactSend($form->getData());
            $this->addFlash('success', 'Votre message a bien été envoyé. Vous recevrez une réponse sous un délai de 24 heures.');
        }
        return $this->render('front/contact.html.twig', [
            'contact' => $form->createView(),
        ]);
    }
}
