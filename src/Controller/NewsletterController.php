<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Services\NewsletterService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NewsletterController extends Controller
{
    /**
     * @Route("/newsletter", name="newsletter")
     * @param Request $request
     * @param NewsletterService $newsletterService
     * @param ValidatorInterface $validator
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(Request $request, NewsletterService $newsletterService, ValidatorInterface $validator): Response
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->getData()->getEmail();
            $alreadySubscribe = $newsletterService->alreadySubscribe($email);
            if (!$alreadySubscribe) {
                $newsletterService->persist($newsletter);
                $newsletterService->newsletterSend($newsletter);
        }else{
                $errors = $validator->validate($newsletter);
                if(count($errors) > 0)
                {
                    $errorsString = (string) $errors;
                    return new Response($errorsString);
                }

                return new Response('L\adresse email est déjà inscrite à la newsletter');
            }

        return $this->redirectToRoute('nao_home');
        }

        return $this->render('newsletter\newsletter.html.twig', array('form' => $form->createView()));
      //  return $this->render('front\index.html.twig', array('form' => $form->createView()));
    //return $this->redirectToRoute('nao_home');
    }

}

