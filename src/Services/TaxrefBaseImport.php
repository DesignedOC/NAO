<?php
namespace App\Services;
use App\Entity\Bird;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class TaxrefBaseImport extends Controller
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em= $em;
    }
    public function taxrefImport()
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder($delimiter = ';')]);
        $csvContents = file_get_contents('TAXREF.csv');
        // Je demande l'encodage en utf-8 et windows-1252  permet d'éviter les caractères spéciaux dans les espaces
        $csvEncodage = mb_convert_encoding($csvContents, "UTF-8","Windows-1252");
        $datas = $serializer->decode($csvEncodage, 'csv');

        foreach($datas as $data)
        {
            $bird = new Bird();
            $bird->setRegne($data['REGNE']);
            $bird->setPhylum($data['PHYLUM']);
            $bird->setClasse($data['CLASSE']);
            $bird->setOrdre($data['ORDRE']);
            $bird->setFamille($data['FAMILLE']);
            $bird->setCdNom($data['CD_NOM']);
            $bird->setCdTaxsup($data['CD_TAXSUP']);
            $bird->setCdRef($data['CD_REF']);
            $bird->setRang($data['RANG']);
            $bird->setLbNom($data['LB_NOM']);
            $bird->setLbAuteur($data['LB_AUTEUR']);
            $bird->setNomComplet($data['NOM_COMPLET']);
            $bird->setNomValide($data['NOM_VALIDE']);
            $bird->setNomVern($data['NOM_VERN']);
            $bird->setNomVernEng($data['NOM_VERN_ENG']);
            $bird->setHabitat($data['HABITAT']);
            $bird->setStatutFR($data['FR']);
            $bird->setStatutGF($data['GF']);
            $bird->setStatutMAR($data['MAR']);
            $bird->setStatutGUA($data['GUA']);
            $bird->setStatutSM($data['SM']);
            $bird->setStatutSB($data['SB']);
            $bird->setStatutSPM($data['SPM']);
            $bird->setStatutMAY($data['MAY']);
            $bird->setStatutEPA($data['EPA']);
            $bird->setStatutREU($data['REU']);
            $bird->setStatutSA($data['SA']);
            $bird->setStatutTA($data['TA']);
            $bird->setStatutNC($data['NC']);
            $bird->setStatutWF($data['WF']);
            $bird->setStatutPF($data['PF']);
            $bird->setStatutCLI($data['CLI']);
            $this->em->persist($bird);
        }
        $this->em->flush();
    }



    public function taxrefUpdate()
    {

        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder($delimiter = ';')]);
        $csvContents = file_get_contents('TAXREF.csv');
        // Je demande l'encodage en utf-8 et windows-1252  permet d'éviter les caractères spéciaux dans les espaces
        $csvEncodage = mb_convert_encoding($csvContents, "UTF-8","Windows-1252");
        $datas = $serializer->decode($csvEncodage, 'csv');


            foreach($datas as $data)
            {
                    $bird->setRegne($data['REGNE']);
                    $bird->setPhylum($data['PHYLUM']);
                    $bird->setClasse($data['CLASSE']);
                    $bird->setOrdre($data['ORDRE']);
                    $bird->setFamille($data['FAMILLE']);
                    //   $bird->setCdNom($data['CD_NOM']);
                    $bird->setCdTaxsup($data['CD_TAXSUP']);
                    $bird->setCdRef($data['CD_REF']);
                    $bird->setRang($data['RANG']);
                    $bird->setLbNom($data['LB_NOM']);
                    $bird->setLbAuteur($data['LB_AUTEUR']);
                    $bird->setNomComplet($data['NOM_COMPLET']);
                    $bird->setNomValide($data['NOM_VALIDE']);
                    $bird->setNomVern($data['NOM_VERN']);
                    $bird->setNomVernEng($data['NOM_VERN_ENG']);
                    $bird->setHabitat($data['HABITAT']);
                    $bird->setStatutFR($data['FR']);
                    $bird->setStatutGF($data['GF']);
                    $bird->setStatutMAR($data['MAR']);
                    $bird->setStatutGUA($data['GUA']);
                    $bird->setStatutSM($data['SM']);
                    $bird->setStatutSB($data['SB']);
                    $bird->setStatutSPM($data['SPM']);
                    $bird->setStatutMAY($data['MAY']);
                    $bird->setStatutEPA($data['EPA']);
                    $bird->setStatutREU($data['REU']);
                    $bird->setStatutSA($data['SA']);
                    $bird->setStatutTA($data['TA']);
                    $bird->setStatutNC($data['NC']);
                    $bird->setStatutWF($data['WF']);
                    $bird->setStatutPF($data['PF']);
                    $bird->setStatutCLI($data['CLI']);
                    $this->em->persist($bird);
                }
            $this->em->flush();
            }
}