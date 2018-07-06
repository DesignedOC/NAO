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
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function indexAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository(Observation::class)->findObservationsPublished($page);
        $nbObservations = $em->getRepository(Observation::class)->findAllObservationsCountByStatut();
        $nbPages = ceil($nbObservations / 10);
        if($page > $nbPages)
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

    }

    /**
     * @Route("/oiseau/{name}", name="oiseau")
     * @param Request $request
     * @param String $name
     * @return Response
     */
    public function findBirdAction(Request $request, String $name)
    {
        $em = $this->getDoctrine()->getManager();
        $observation = $this->getDoctrine()
            ->getRepository(Observation::class)
            ->findBylatitude($name);
        if (!$observation) {
            throw $this->createNotFoundException(
                'rien trouvé pour '.$name
            );
        } else {
            echo 'Votre oiseau est : ' . $name;
            dump($observation);
        }
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
     * @Route("map-search", name="map_search")
     * @param Request $request
     * @return JsonResponse
     */
    public function searchBirdMap(Request $request)
    {
        $birdNomVern = $request->get('nomVern');
        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository(Observation::class)->findBirdWithObservation($birdNomVern);
        return new JsonResponse($observations);
    }
}