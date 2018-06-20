<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table(name="nao_taxref")
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="App\Repository\TaxrefRepository")
 */
class Taxref
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="taxref", fileNameProperty="taxref")
     * @var File
     * @ORM\Column(type="string", length=255)
     */
    private $taxrefFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $taxref;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;


    public function __construct()
    {
        $this->updateAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTaxrefFile()
    {
        return $this->taxrefFile;
    }

    public function setTaxrefFile(File $taxref = null)
    {
        $this->taxrefFile = $taxref;
        if($taxref){
            $this->updateAt = new \DateTime('now');
        }

        return $this;
    }

    public function getTaxref()
    {
        return $this->taxref;
    }

    public function setTaxref($taxref)
    {
        $this->taxref = $taxref;

    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}
