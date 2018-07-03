<?php

namespace App\Controller;

use App\Entity\Bird;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\TaxrefBaseImport;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BirdController extends Controller
{
    protected $em;

    /**
     * BirdController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


 
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
     * @Route("/bird/nom-vern/autocomplete", name="bird_nomvern_autocomplete")
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
            $nomVerns[] = $bird->getNomVern();
        }
        return new JsonResponse($nomVerns);
    }

        /**
     * @Route ("admin/taxrefBaseImport", name="taxrefBaseImport")
     * @param Request $request
     * @param TaxrefBaseImport $taxref
     * @return Response
    */
     public function taxrefBaseImport(Request $request, TaxrefBaseImport $taxref)
    
     {
        $taxref->reloadTaxref();
        $this->addFlash('success','import ok');
        return $this->redirectToRoute('admin',['entity'=>'Bird', 'action'=> 'list']);
        return $this->render('bird/index.html.twig', [
            'controller_name' => 'BirdController',
        ]);
     }
}
