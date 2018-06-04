<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Observation;
use App\Form\ObservationType;


class ObservationController extends Controller
{
    /**
     * @Route("/observation", name="observation")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $observation = new Observation();
        $form = $this->createForm(ObservationType::class, $observation);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($observation);
            $em->flush();
        }

        return $this->render('observation/index.html.twig', [
           'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/carte", name="carte")
     */
    public function carte(Request $request)
    {
        
        return $this->render('carte.html');
    }
}
