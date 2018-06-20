<?php

namespace App\Controller;

use App\Entity\Bird;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BirdController extends Controller
{
    /**
     * @Route("/bird", name="bird")
     */
    public function index()
    {
        return $this->render('bird/index.html.twig', [
            'controller_name' => 'BirdController',
        ]);
    }

    /**
     * Autocomplete pour le lbnom
     * @Route("/bird/lb-nom/autocomplete", name="bird_lbnom_autocomplete")
     * @param Request $request
     * @return JsonResponse
     */
    public function autocompleteLbNom(Request $request)
    {
        $lbNoms = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();
        $birds = $em->getRepository(Bird::class)->findBirdByLbNom($term);

        foreach ($birds as $bird) {
            $lbNoms[] = $bird->getLbNom();
        }
        return new JsonResponse($lbNoms);
    }

    /**
     * Autocomplete pour le nomVern
     * @Route("/bird/lb-nom/autocomplete", name="bird_nomvern_autocomplete")
     * @param Request $request
     * @return JsonResponse
     */
    public function autocompleteNomVern(Request $request)
    {
        $nomVerns = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();
        $birds = $em->getRepository(Bird::class)->findBirdByNomVern($term);

        foreach ($birds as $bird) {
            $nomVerns[] = $bird->getLbNom();
        }
        return new JsonResponse($nomVerns);
    }
}