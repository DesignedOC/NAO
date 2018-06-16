<?php

namespace App\Controller;

use App\Entity\Bird;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Observation;
use App\Form\ObservationType;


/**
 * Class ObservationController
 * @package App\Controller
 * @Route("/observation", name="observation_")
 */
class ObservationController extends Controller
{
    /**
     * Liste des observations
     * @Route("s", name="index")
     * @Template("observation/index.html.twig")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository(Observation::class)->findAll();
        return array(
            'observations' => $observations
        );
    }

    /**
     * @Route("/ajouter", name="ajouter")
     * @Template("observation/ajouter.html.twig")
     */
    public function newAction(Request $request)
    {
        $observation = new Observation();
        $form = $this->createForm(ObservationType::class, $observation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $currentUser = $this->getUser();
            if ($currentUser->hasRole('ROLE_NATURALIST')) {
                $observation->setStatut(2);
            }
            $observation->setUser($currentUser);
            $em->persist($observation);
            $em->flush();

            return $this->redirectToRoute("observation_index");
        }

        return array(
            'form' => $form->createView(),
        );
    }


//    /**
//     * @Route("/observation", name="observation")
//     * @param Request $request
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function index(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $observation = new Observation();
//        $form = $this->createForm(ObservationType::class, $observation);
//
//        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
//            $em->persist($observation);
//            $em->flush();
//        }
//
//        return $this->render('observation/observations.html.twig', [
//           'form' => $form->createView(),
//        ]);
//    }

    // creer une methode qui recoit un nom d'oiseau et qui va chercher en bdd l'oiseau en question
    // et le retourner au format json a l'appellant
    /**
     * @Route("/oiseau/{name}", name="oiseau")
     */


    // - recuperer le nom de l'oiseau ici $name
    public function findBirdAction(Request $request, String $name)
    {
        // - verifier que cet oiseau existe en bdd
        $em = $this->getDoctrine()->getManager();
        $observation = $this->getDoctrine()
            ->getRepository(Observation::class)
            ->findBylatitude($name);

        // - si l'oiseau n'existe pas on renvoit une reposonse not found
        if (!$observation) {
            throw $this->createNotFoundException(
                'rien trouvé pour '.$name
            );
            // - si l'oiseau existe
        } else {
            echo 'Votre oiseau est : ' . $name;
            dump($observation);
        }



        // on recuperer la lat et long

        // et on contacte mapbox avec la lat et long afin d'obtenir le tile

        // si on recoit le tile on renvoit le tile dans la reponse




        //retourner en format JSON
        return new Response($name);

    }
    /**
     * @Route("/carte", name="carte")
     */
    public function carteAction(Request $request)
    {
        //Appelle le repo, le repo appelle la table observation, prend un de ses objets , et qui va retourner
        //la position lattitude et longitude de cet objet
        return $this->render('carte.html');
    }
}
