<?php
namespace App\Controller;
use App\Entity\Bird;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Observation;
use App\Form\ObservationType;
/**
 * Class ObservationController
 * @package App\Controller
 * @Route("interface/", name="nao_interface_")
 */
class ObservationController extends Controller
{
    /**
     * List of observations by pages
     * @Route("observations/{page}", requirements={"page" = "\d+"}, name="observations")
     * @Template("interface/observations.html.twig")
     * @param Request $request
     * @param $page
     * @return array
     */
    public function indexAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository(Observation::class)->findObservationsPublished($page);
        $nbObservations = $em->getRepository(Observation::class)->findAllObservationsCountByStatut();
        $nbPages = ceil($nbObservations / 10);


        if($page != 1 && $page > $nbPages)
        {
            throw new NotFoundHttpException("La page que vous essayez d'atteindre n'existe pas");
        }
        $pagination = [
              'page' => $page,
              'nbPages' => $nbPages
        ];
        return array(
            'observations' => $observations,
            'pagination' => $pagination,
        );
    }
    /**
     * @Route("observation/ajouter", name="obs_ajouter")
     * @Template("interface/observation/ajouter.html.twig")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
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
            return $this->redirectToRoute("nao_interface_observations", ['page' => 1]);
        }
        return array(
            'form' => $form->createView(),
        );
    }
    /**
     * @Route("observation/{id}/afficher", name="obs_afficher")
     * @Template("interface/observation/ajouter.html.twig")
     * @param Request $request
     * @param $id
     * @return array
     */
    public function afficherAction(Request $request,$id)
    {
//        dump($id);die;
//        return array(
//            'observation' => $observation
//        );
    }
//    /**
//     * @Route("observation", name="observation")
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
    /**
     * @param Request $request
     * @param String $name
     * @return Response
     */
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
     * @Route("observation/carte", name="carte")
     * @Template("interface/observation/carte.html.twig")
     * @param Request $request
     */
    public function carteAction(Request $request)
    {
    }

        /**
     * @Route("observation/test", name="test")
     * @Template("interface/observation/test.html.twig")
     * @param Request $request
     */
    public function testAction(Request $request)
    {
    }
      
    /**
     * @Route("map-search", name="map_search")
     * @param Request $request
     * @return JsonResponse
     */
    public function searchBirdMap(Request $request)
    {
        $birdNomVern = $request->get('nomVern');
//        $birdNomVern = 'blablabla';
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository(Observation::class)->findBirdWithObservation($birdNomVern);
        return new JsonResponse($observations);
    }
}