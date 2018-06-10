<?php
namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/interface/memory_bird", name="nao_interface_memory")
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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function naturaliste(Request $request)
    {
        if($this->isGranted('ROLE_NATURALIST')){
            return $this->redirectToRoute('nao_interface');
        }
        $user = $this->getUser();
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
        ]);
    }
    /**
     * @Route("/interface/carte", name="nao_interface_carte")
     */
    public function carte()
    {
        return $this->render('interface/carte.html.twig', [
            'controller_name' => 'InterfaceController',
        ]);
    }
}