<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
