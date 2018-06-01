<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
<<<<<<< HEAD
use Symfony\Component\HttpFoundation\File\File;

=======
use Symfony\Component\HttpFoundation\File\file;
>>>>>>> config vich in Badge Entity with add updatedAt and pictureFile fields + add vich type for Badge in easyAdmin.yaml
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     * @Assert\Valid
     */
    private $picture;

    /**
<<<<<<< HEAD
     *  * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="picture")
=======
     * @Vich\UploadableField(mapping="product_images", fileNameProperty= "picture")
>>>>>>> config vich in Badge Entity with add updatedAt and pictureFile fields + add vich type for Badge in easyAdmin.yaml
     * @var File
     */
    private $pictureFile;

<<<<<<< HEAD
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * Badge constructor.
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return mixed
     */
=======

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $updatedAt;


    public function __construct()
    {
        $this->updatedAt = new \Datetime();
    }

>>>>>>> config vich in Badge Entity with add updatedAt and pictureFile fields + add vich type for Badge in easyAdmin.yaml
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return user|null
     */
    public function getUser(): ?user
    {
        return $this->user;
    }

    /**
     * @param user|null $user
     * @return Badge
     */
    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

<<<<<<< HEAD
    /**
     * @param null|string $picture
     */
=======
>>>>>>> config vich in Badge Entity with add updatedAt and pictureFile fields + add vich type for Badge in easyAdmin.yaml
    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;

    }

<<<<<<< HEAD
    /**
     * @return null|File
     */
=======
>>>>>>> config vich in Badge Entity with add updatedAt and pictureFile fields + add vich type for Badge in easyAdmin.yaml
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }
<<<<<<< HEAD

    /**
     * @param null|File $picture
     */
    public function setPictureFile(?File $picture = null): void
    {
        $this->pictureFile = $picture;
        if (null != $picture) {
=======
    public function setPictureFile(?File $picture = null):void
    {
        $this->pictureFile = $picture;
        if(null != $picture)
        {
>>>>>>> config vich in Badge Entity with add updatedAt and pictureFile fields + add vich type for Badge in easyAdmin.yaml
            $this->updatedAt = new \DateTime();
        }
    }

<<<<<<< HEAD
    /**
     * @return \DateTime
     */
=======

>>>>>>> config vich in Badge Entity with add updatedAt and pictureFile fields + add vich type for Badge in easyAdmin.yaml
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

<<<<<<< HEAD
    /**
     * @param $updatedAt
     * @return $this
     */
=======
>>>>>>> config vich in Badge Entity with add updatedAt and pictureFile fields + add vich type for Badge in easyAdmin.yaml
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
