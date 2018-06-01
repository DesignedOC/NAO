<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
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
     *  * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="picture")
     * @var File
     */
    private $pictureFile;
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
    /**
     * @param null|string $picture
     */
    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }
    /**
     * @return null|File
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }
    /**
     * @param null|File $picture
     */
    public function setPictureFile(?File $picture = null): void
    {
        $this->pictureFile = $picture;
        if (null != $picture) {
            $this->updatedAt = new \DateTime();
        }
    }
    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}