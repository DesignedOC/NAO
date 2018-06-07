<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InterfaceController extends Controller
{
    /**
     * @Route("/interface/", name="interface")
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
        return $this->render('interface/memoryBird.html.twig');
    }
}
