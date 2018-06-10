<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Observation;
use App\Form\ObservationType;
use App\Repository;


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
        $user = $this->getUser();
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $observation->setUser($user);
            $em->persist($observation);
            $em->flush();
            //return $this->redirectToRoute('carte');         
        }
        return $this->render('observation/index.html.twig', [
           'form' => $form->createView(),
        ]);
    }



    // creer une methode qui recoit un nom d'oiseau et qui va chercher en bdd l'oiseau en question
    // et le retourner au format json a l'appellant

    /**
     * @Route("/oiseau/{name}", name="oiseau")
     */	
	 
    public function findBirdAction(Request $request)
     {
        // - recuperer le nom de l'oiseau		
		$nameBird = $request->get('name');	
		// - verfier que cet oiseau existe en bdd
		$em = $this->getDoctrine()->getManager(); 
		$observation = $this->getDoctrine()
        ->getRepository(Observation::class)
        ->findBylatitude(22222);
		
		// - si l'oiseau n'existe pas on renvoit une reposonse not found
		
		if (!$observation) {
        throw $this->createNotFoundException(
            'rien trouvé pour '.$nameBird
        );
    }
		// - si l'oiseau existe 
		      // on recuperer la lat et long 
			  
			  
			  // et on contacte mapbox avec la lat et long afin d'obtenir le tile
			  
			  // si on recoit le tile on renvoit le tile dans la reponse
		
		
		
		
        //retourner en format JSON
		 return new Response($nameBird);
        
    }




    /**
     * @Route("/carte", name="carte")
     */
    public function carte(Request $request)
    {
        //Appelle le repo, le repo appelle la table observation, prend un de ses objets , et qui va retourner
        //la position lattitude et longitude de cet objet
        return $this->render('carte.html');
    }
}
