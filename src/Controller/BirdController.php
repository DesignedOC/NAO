<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\TaxrefBaseImport;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BirdController extends Controller
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route ("/taxrefBaseImport", name="taxrefBaseImport")
     * @param Request $request
     * @param TaxrefBaseImport $taxref
     * @return Response
     */
    public function taxrefBaseImport(Request $request, TaxrefBaseImport $taxref)
    {
        $datas = $taxref->reloadTaxref();
        return new Response($datas);
    }

}