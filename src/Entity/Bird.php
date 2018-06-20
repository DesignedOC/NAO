<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="nao_bird")
 * @ORM\Entity(repositoryClass="App\Repository\BirdRepository")
 */
class Bird
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    /**
     * @ORM\Column(name="regne", type="string", length=255, nullable=true)
     */
    private $regne;
    /**
     * @ORM\Column(name="phylum", type="string", length=255, nullable=true)
     */
    private $phylum;
    /**
     * @ORM\Column(name="classe", type="string", length=255, nullable=true)
     */
    private $classe;
    /**
     * @ORM\Column(name="ordre", type="string", length=255, nullable=true)
     */
    private $ordre;
    /**
     * @ORM\Column(name="famille", type="string", length=255, nullable=true)
     */
    private $famille;
    /**
     * @ORM\Column(name="cd_nom", type="integer", nullable=true)
     */
    private $cdNom;
    /**
     * @ORM\Column(name="cd_taxsup", type="integer", nullable=true)
     */
    private $cdTaxsup;
    /**
     * @ORM\Column(name="cd_ref", type="integer", nullable=true)
     */
    private $cdRef;
    /**
     * @ORM\Column(name="rang", type="string", length=255, nullable=true)
     */
    private $rang;
    /**
     * @ORM\Column(name="lb_nom", type="string", length=255, nullable=true)
     */
    private $lbNom;
    /**
     * @ORM\Column(name="lb_auteur", type="string", length=255, nullable=true)
     */
    private $lbAuteur;
    /**
     * @ORM\Column(name="nom_complet", type="string", length=255, nullable=true)
     */
    private $nomComplet;
    /**
     * @ORM\Column(name="nom_valide", type="string", length=255, nullable=true)
     */
    private $nomValide;
    /**
     * @ORM\Column(name="nom_vern", type="string", length=255)
     */
    private $nomVern;
    /**
     * @ORM\Column(name="nom_vern_eng", type="string", length=255, nullable=true)
     */
    private $nomVernEng;
    /**
     * @ORM\Column(name="habitat", type="smallint", nullable=true)
     */
    private $habitat;
    /**
     * @ORM\Column(name="fr", type="string", length=1, nullable=true)
     */
    private $statutFR;
    /**
     * @ORM\Column(name="gf", type="string", length=1, nullable=true)
     */
    private $statutGF;
    /**
     * @ORM\Column(name="mar", type="string", length=1, nullable=true)
     */
    private $statutMAR;
    /**
     * @ORM\Column(name="gua", type="string", length=1, nullable=true)
     */
    private $statutGUA;
    /**
     * @ORM\Column(name="sm", type="string", length=1, nullable=true)
     */
    private $statutSM;
    /**
     * @ORM\Column(name="sb", type="string", length=1, nullable=true)
     */
    private $statutSB;
    /**
     * @ORM\Column(name="spm", type="string", length=1, nullable=true)
     */
    private $statutSPM;
    /**
     * @ORM\Column(name="may", type="string", length=1, nullable=true)
     */
    private $statutMAY;
    /**
     * @ORM\Column(name="epa", type="string", length=1, nullable=true)
     */
    private $statutEPA;
    /**
     * @ORM\Column(name="reu", type="string", length=1, nullable=true)
     */
    private $statutREU;
    /**
     * @ORM\Column(name="sa", type="string", length=1, nullable=true)
     */
    private $statutSA;
    /**
     * @ORM\Column(name="ta", type="string", length=1, nullable=true)
     */
    private $statutTA;
    /**
     * @ORM\Column(name="nc", type="string", length=1, nullable=true)
     */
    private $statutNC;
    /**
     * @ORM\Column(name="wf", type="string", length=1, nullable=true)
     */
    private $statutWF;
    /**
     * @ORM\Column(name="pf", type="string", length=1, nullable=true)
     */
    private $statutPF;
    /**
     * @ORM\Column(name="cli", type="string", length=1, nullable=true)
     */
    private $statutCLI;
    public function getId()
    {
        return $this->id;
    }
    public function setId(int $id) :self
    {
        $this->id =$id;
        return $this;
    }
    public function getRegne(): ?string
    {
        return $this->regne;
    }
public function setRegne(string $regne): self
{
    $this->regne = $regne;
    return $this;
}
public function getPhylum(): ?string
    {
        return $this->phylum;
    }
    public function setPhylum(string $phylum): self
{
    $this->phylum = $phylum;
    return $this;
}
    public function getClasse(): ?string
    {
        return $this->classe;
    }
    public function setClasse(string $classe): self
{
    $this->classe = $classe;
    return $this;
}
    public function getOrdre(): ?string
    {
        return $this->ordre;
    }
    public function setOrdre(string $ordre): self
{
    $this->ordre = $ordre;
    return $this;
}
    public function getFamille(): ?string
    {
        return $this->famille;
    }
    public function setFamille(string $famille): self
{
    $this->famille = $famille;
    return $this;
}
    public function getCdNom(): ?int
    {
        return $this->cdNom;
    }
    public function setCdNom(int $cdNom): self
{
    $this->cdNom = $cdNom;
    return $this;
}
    public function getCdTaxsup(): ?int
    {
        return $this->cdTaxsup;
    }
    public function setCdTaxsup(int $cdTaxsup): self
{
    $this->cdTaxsup = $cdTaxsup;
    return $this;
}
    public function getCdRef(): ?int
    {
        return $this->cdRef;
    }
    public function setCdRef(int $cdRef): self
{
    $this->cdRef = $cdRef;
    return $this;
}
    public function getRang(): ?string
    {
        return $this->rang;
    }
    public function setRang(string $rang): self
{
    $this->rang = $rang;
    return $this;
}
    public function getLbNom(): ?string
    {
        return $this->lbNom;
    }
    public function setLbNom(string $lbNom): self
{
    $this->lbNom = $lbNom;
    return $this;
}
    public function getLbAuteur(): ?string
    {
        return $this->lbAuteur;
    }
    public function setLbAuteur(string $lbAuteur): self
{
    $this->lbAuteur = $lbAuteur;
    return $this;
}
    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }
    public function setNomComplet(string $nomComplet): self
{
    $this->nomComplet = $nomComplet;
    return $this;
}
    public function getNomValide(): ?string
    {
        return $this->nomValide;
    }
    public function setNomValide(string $nomValide): self
{
    $this->nomValide = $nomValide;
    return $this;
}
    public function getNomVern(): ?string
    {
        return $this->nomVern;
    }
    public function setNomVern(string $nomVern): self
{
    $this->nomVern = $nomVern;
    return $this;
}
    public function getNomVernEng(): ?string
    {
        return $this->nomVernEng;
    }
    public function setNomVernEng(string $nomVernEng): self
{
    $this->nomVernEng = $nomVernEng;
    return $this;
}
    public function getHabitat(): ?int
    {
        return $this->habitat;
    }
    public function setHabitat(int $habitat): self
{
    $this->habitat = $habitat;
    return $this;
}
    public function getStatutFR(): ?string
    {
        return $this->statutFR;
    }
    public function setStatutFR(string $statutFR): self
{
    $this->statutFR = $statutFR;
    return $this;
}
    public function getStatutGF(): ?string
    {
        return $this->statutGF;
    }
    public function setStatutGF(string $statutGF): self
{
    $this->statutGF = $statutGF;
    return $this;
}
    public function getStatutMAR(): ?string
    {
        return $this->statutMAR;
    }
    public function setStatutMAR(string $statutMAR): self
{
    $this->statutMAR = $statutMAR;
    return $this;
}
    public function getStatutGUA(): ?string
    {
        return $this->statutGUA;
    }
    public function setStatutGUA(string $statutGUA): self
{
    $this->statutGUA = $statutGUA;
    return $this;
}
    public function getStatutSM(): ?string
    {
        return $this->statutSM;
    }
    public function setStatutSM(string $statutSM): self
{
    $this->statutSM = $statutSM;
    return $this;
}
    public function getStatutSB(): ?string
    {
        return $this->statutSB;
    }
    public function setStatutSB(string $statutSB): self
{
    $this->statutSB = $statutSB;
    return $this;
}
    public function getStatutSPM(): ?string
    {
        return $this->statutSPM;
    }
    public function setStatutSPM(string $statutSPM): self
{
    $this->statutSPM = $statutSPM;
    return $this;
}
    public function getStatutMAY(): ?string
    {
        return $this->statutMAY;
    }
    public function setStatutMAY(string $statutMAY): self
{
    $this->statutMAY = $statutMAY;
    return $this;
}
    public function getStatutEPA(): ?string
    {
        return $this->statutEPA;
    }
    public function setStatutEPA(string $statutEPA): self
{
    $this->statutEPA = $statutEPA;
    return $this;
}
    public function getStatutREU(): ?string
    {
        return $this->statutREU;
    }
    public function setStatutREU(string $statutREU): self
{
    $this->statutREU = $statutREU;
    return $this;
}
    public function getStatutSA(): ?string
    {
        return $this->statutSA;
    }
    public function setStatutSA(string $statutSA): self
{
    $this->statutSA = $statutSA;
    return $this;
}
    public function getStatutTA(): ?string
    {
        return $this->statutTA;
    }
    public function setStatutTA(string $statutTA): self
{
    $this->statutTA = $statutTA;
    return $this;
}
    public function getStatutNC(): ?string
    {
        return $this->statutNC;
    }
    public function setStatutNC(string $statutNC): self
{
    $this->statutNC = $statutNC;
    return $this;
}
    public function getStatutWF(): ?string
    {
        return $this->statutWF;
    }
    public function setStatutWF(string $statutWF): self
{
    $this->statutWF = $statutWF;
    return $this;
}
    public function getStatutPF(): ?string
    {
        return $this->statutPF;
    }
    public function setStatutPF(string $statutPF): self
{
    $this->statutPF = $statutPF;
    return $this;
}
    public function getStatutCLI(): ?string
    {
        return $this->statutCLI;
    }
    public function setStatutCLI(string $statutCLI): self
{
    $this->statutCLI = $statutCLI;
    return $this;
}
}