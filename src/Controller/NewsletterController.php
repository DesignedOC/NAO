<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\NewsletterRepository;
use App\Services\NewsletterService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\SerializerInterface;
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
    public function index(Request $request,EntityManagerInterface $entityManager, NewsletterService $newsletterService, ValidatorInterface $validator): Response
    {
        $success = false;
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($newsletter);
            $newsletterService->newsletterSend($newsletter);
            $entityManager->flush();
            $success = true;
        }

        return $this->render('newsletter\newsletter.html.twig', array(
            'form' => $form->createView(),
            'success' => $success
        ));
    }

    /**
     * @Route("admin/exportEmail", name="exportEmail")
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param NewsletterRepository $newsletterRepository
     * @return Response
     */
    public function ExportEmail(Request $request, SerializerInterface $serializer, NewsletterRepository $newsletterRepository)
    {

        $emails = $newsletterRepository->getAllEmails();
        $csv = $serializer->serialize($emails, 'csv', [CsvEncoder::DELIMITER_KEY => ";"]);
        $response = new Response($csv);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="nao_emails.csv"');

        return $response;
    }

}

