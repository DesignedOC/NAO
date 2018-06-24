<?php
namespace App\Controller;

use App\Entity\Application;
use App\Entity\User;
use App\Form\NaturalistType;
use App\Services\BadgeManager;
use App\Services\MainManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InterfaceController extends Controller
{
    /**
     * @Route("/interface/", name="nao_interface")
     */
    public function index()
    {
        return $this->render('interface/index.html.twig', [
            'controller_name' => 'InterfaceController',
        ]);
    }
    /**
     * @Route("/interface/memory", name="nao_interface_memory")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function memory(Request $request)
    {
        return $this->render('interface/memory.html.twig');
    }

    /**
     * @Route("/interface/devenir-naturaliste", name="nao_interface_naturalist")
     * @param Request $request
     * @param MainManager $mainManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function naturaliste(Request $request, MainManager $mainManager)
    {
        if($this->isGranted('ROLE_NATURALIST')){
            return $this->redirectToRoute('nao_interface');
        }

        $user = $this->getUser();

        $appStatut = $mainManager->getApplicationByStatut($user);

        $application = new Application();
        $form = $this->createForm(NaturalistType::class, $application);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $application->setUser($user);
            $this->getDoctrine()->getManager()->persist($application);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre candidature est bien prise en compte. Veuillez patienter pour obtenir une réponse.');
        }
        return $this->render('interface/naturaliste.html.twig', [
            'application' => $form->createView(),
            'appStatut' => $appStatut
        ]);
    }

    /**
     * @Route("/interface/candidatures", name="nao_interface_candidatures")
     * @param MainManager $mainManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function candidatures(MainManager $mainManager)
    {
        $candidatures = $mainManager->getAllApplications();

        return $this->render('interface/candidatures.html.twig', [
            'controller_name' => 'InterfaceController',
        ]); 
    }

//    /**
//     * @Route("/interface/candidatures/", name="nao_interface_candidatures")
//     * @param MainManager $mainManager
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function candidatures(MainManager $mainManager)
//    {
//        $candidatures = $mainManager->getAllApplications();
//
//        return $this->render('interface/candidatures.html.twig', [
//            'controller_name' => 'InterfaceController',
//        ]);
//    }


    /**
     * @Route("/interface/carte", name="nao_interface_carte")
     */
    public function carte()
    {
        return $this->render('interface/carte.html.twig', [
            'controller_name' => 'InterfaceController',
        ]);
    }

    /**
     * @Route("/interface/user/{username}", name="nao_interface_profile")
     * @param string $username
     * @param BadgeManager $badgeManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profile(string $username, BadgeManager $badgeManager)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $username]);

        /** @var User $user */
        $badges = $badgeManager->getBadgesOfUser($user);

        if(!$user) {
            throw $this->createNotFoundException('Aucun utilisateur trouvé avec le nom '. $username);
        }

        return $this->render('interface/profile.html.twig', [
            'user' => $user,
            'badges' => $badges
        ]);
    }

}