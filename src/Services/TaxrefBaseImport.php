<?php
namespace App\Services;
use App\Entity\Bird;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
class TaxrefBaseImport
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em= $em;
    }
    public function taxrefImport()
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder($delimiter = ';', $enclosure = '"')]);
        $BirdRepository = $this->em->getRepository('App:Bird');
        $nb = $BirdRepository->countnb();
        dump($nb);
        $csvFile = __DIR__ .'/../../public/' . 'TAXREF.csv';
        $csvContents = file_get_contents($csvFile);
        $csvConverted = mb_convert_encoding($csvContents, "UTF-8", "Windows-1252");
        $datas = $serializer->decode($csvConverted, 'csv');
        foreach ($datas as $data)
        {
            $Bird = new Bird();
            $Bird->setId($data['HABITAT']);
            $Bird->setRegne($data['REGNE']);
            $Bird->setPhylum($data['PHYLUM']);
            $Bird->setClasse($data['CLASSE']);
            $Bird->setOrdre($data['ORDRE']);
            $Bird->setFamille($data['FAMILLE']);
            $Bird->setCdNom($data['CD_NOM']);
            $Bird->setCdTaxsup($data['CD_TAXSUP']);
            $Bird->setCdRef($data['CD_REF']);
            $Bird->setRang($data['RANG']);
            $Bird->setLbNom($data['LB_NOM']);
            $Bird->setLbAuteur($data['LB_AUTEUR']);
            $Bird->setNomComplet($data['NOM_COMPLET']);
            $Bird->setNomValide($data['NOM_VALIDE']);
            $Bird->setNomVern($data['NOM_VERN']);
            $Bird->setNomVernEng($data['NOM_VERN_ENG']);
            $Bird->setHabitat($data['HABITAT']);
            $Bird->setStatutFR($data['FR']);
            $Bird->setStatutGF($data['GF']);
            $Bird->setStatutMAR($data['MAR']);
            $Bird->setStatutGUA($data['GUA']);
            $Bird->setStatutSM($data['SM']);
            $Bird->setStatutSB($data['SB']);
            $Bird->setStatutSPM($data['SPM']);
            $Bird->setStatutMAY($data['MAY']);
            $Bird->setStatutEPA($data['EPA']);
            $Bird->setStatutREU($data['REU']);
            $Bird->setStatutSA($data['SA']);
            $Bird->setStatutTA($data['TA']);
            $Bird->setStatutNC($data['NC']);
            $Bird->setStatutWF($data['WF']);
            $Bird->setStatutPF($data['PF']);
            $Bird->setStatutCLI($data['CLI']);
            $this->em->persist($Bird);
        }
        $this->em->flush();
        return " Le fichier a été correctement importé en Base de données";
    }
}