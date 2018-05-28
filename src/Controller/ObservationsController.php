<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Observations;
use App\Form\ObservationsType;


class ObservationsController extends Controller
{
    /**
     * @Route("/observations", name="observations")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $observation = new Observations();
        $form = $this->createForm(ObservationsType::class, $observation);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($observation);
            $em->flush();
        }

        return $this->render('observations/index.html.twig', [
           'form' => $form->createView(),
        ]);
    }
}
