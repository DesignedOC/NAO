<?php
namespace App\Controller;

use App\Entity\Application;
use App\Entity\Observation;
use App\Entity\Player;
use App\Entity\Tournament;
use App\Entity\User;
use App\Form\NaturalistType;
use App\Form\SettingsFormType;
use App\Services\BadgeManager;
use App\Services\MailerManager;
use App\Services\MainManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InterfaceController extends Controller
{
    /**
     * @Route("/interface/", name="nao_interface")
     */
    public function index()
    {
        return $this->render('interface/index.html.twig');
    }
    /**
     * @Route("/interface/memory", name="nao_interface_memory")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function memory()
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
     * @Route("/interface/parametres", name="nao_interface_parametres")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function settings(Request $request)
    {
        $userId = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)->findOneBy(['id'=>$userId->getId()]);

        $form = $this->createForm(SettingsFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Vous avez mis à jour vos paramètres de compte.');
        }

        return $this->render('interface/parametres.html.twig',[
             'settings' => $form->createView(),
        ]);
    }

    /**
     * @Route("/interface/classement", name="nao_interface_classement")
     * @param Request $request
     * @param MainManager $mainManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function classement(Request $request, MainManager $mainManager)
    {

        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $lastTn = $em->getRepository(Tournament::class)->findLastTournament();
        $players = $em->getRepository(Player::class)->findTopTenByTournament($lastTn);

        return $this->render('interface/classement.html.twig', [
            'lastTn' => $lastTn,
            'players' => $players
        ]);
    }

    /**
     * @Route("/interface/recherche", name="nao_interface_search")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $q = $request->get('q');

        $results = $em->getRepository(User::class)->findUserBySearch($q);

        return $this->render('interface/search.html.twig', [
            'results' => $results,
            'q' => $q
        ]);
    }

    /**
     * @Route("/interface/candidatures/{page}", requirements={"page" = "\d+"}, name="nao_interface_candidatures")
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function candidatures($page)
    {
        $this->denyAccessUnlessGranted('ROLE_NATURALIST', null, 'Vous ne pouvez pas accéder à cette page');

        $em = $this->getDoctrine()->getManager();
        $applications = $em->getRepository(Application::class)->findToPublishByStatut($page);
        $nbApplications = $em->getRepository(Application::class)->findAppCountByStatut();

        $nbPages = ceil($nbApplications / 10);
        
        if($page != 1 && $page > $nbPages)
        {
            throw new NotFoundHttpException("La page que vous essayez d'atteindre n'existe pas");
        }

        $pagination = [
            'page' => $page,
            'nbPages' => $nbPages
        ];

        return $this->render('interface/candidatures.html.twig', [
            'applications' => $applications,
            'pagination' => $pagination
        ]); 
    }


    /**
     * @Route("/interface/validations/{page}", requirements={"page" = "\d+"}, name="nao_interface_validations")
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function validations($page)
    {

        $this->denyAccessUnlessGranted('ROLE_NATURALIST', null, 'Vous ne pouvez pas accéder à cette page');

        $em = $this->getDoctrine()->getManager();
        $observations = $em->getRepository(Observation::class)->findObservByStatut($page);
        $nbObs = $em->getRepository(Observation::class)->findObservCountByStatut();

        $nbPages = ceil($nbObs / 10);

        if($page != 1 && $page > $nbPages)
        {
            throw new NotFoundHttpException("La page que vous essayez d'atteindre n'existe pas");
        }

        $pagination = [
            'page' => $page,
            'nbPages' => $nbPages
        ];

        return $this->render('interface/validations.html.twig', [
            'observations' => $observations,
            'pagination' => $pagination
        ]);
    }

    /**
     * Change statut role of users by application
     * @Route("/interface/candidature/edit/{username}/{id}/{statut}", requirements={"id" = "\d+", "statut" = "\d+"}, name="nao_interface_app_edit")
     * @param $username
     * @param $id
     * @param $statut
     * @param MailerManager $mailerManger
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function candidateStatut($username, $id, $statut, MailerManager $mailerManger)
    {
        /** @var User $user */
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['username' => $username]);
        $application = $em->getRepository(Application::class)->find($id);

        if(!$application || !$user)
        {
            throw new NotFoundHttpException("Impossible de trouver la candidature ou l'utilisateur");
        }

        if($statut != 1 AND $statut != 2) {
            throw new NotFoundHttpException("La page que vous essayez d'atteindre n'existe pas");
        }

        if($statut == 1)
        {
            $application->setStatut(0);
            $em->persist($application);
            $em->flush();
            $this->addFlash('info', 'Vous avez refusé la candidature pour cet utilisateur');
            $mailerManger->declinedAppSend($application, $user);
        }

        if($statut == 2)
        {
            $application->setStatut(2);
            $user->addRole('ROLE_NATURALIST');
            $em->persist($application);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Vous avez accepté la candidature pour cet utilisateur');
            $mailerManger->acceptedAppSend($application, $user);
        }

        return $this->redirectToRoute('nao_interface_candidatures', ['page' => 1]);

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