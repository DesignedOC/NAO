<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\file;
/**
 * @ORM\Entity(repositoryClass="App\Repository\BadgeRepository")
 * @Vich\Uploadable
 */
class Badge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="badges")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty= "picture")
     * @var File
     */
    private $pictureFile;


    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $updatedAt;


    public function __construct()
    {
        $this->updatedAt = new \Datetime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;

    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }
    public function setPictureFile(?File $picture = null):void
    {
        $this->pictureFile = $picture;
        if(null != $picture)
        {
            $this->updatedAt = new \DateTime();
        }
    }


    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
