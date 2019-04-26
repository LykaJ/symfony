<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageMediaRepository")
 */
class ImageMedia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;
    /**
     * @var UploadedFile
     *  @Assert\Image(
     *  mimeTypes= {"image/jpeg", "image/jpg", "image/png"},
     *  mimeTypesMessage = "Le fichier ne possède pas une extension valide ! Veuillez insérer une image en .jpg, .jpeg ou .png",
     *  minWidth = 500,
     *  minWidthMessage = "La largeur de cette image est trop petite",
     *  maxWidth = 3000,
     *  maxWidthMessage = "La largeur de cette image est trop grande",
     *  minHeight = 282,
     *  minHeightMessage = "La hauteur de cette image est trop petite",
     *  maxHeight = 1687,
     *  maxHeightMessage ="La hauteur de cette image est trop grande",
     *  )
     */
    private $file;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trick", inversedBy="mediaImages")
     * @ORM\JoinColumn(name="trick_id", referencedColumnName="id")
     */
    private $trick;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * @param UploadedFile|null $file
     * @return ImageMedia
     */
    public function setFile(?UploadedFile $file): self
    {
        $this->file = $file;
        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;
        return $this;
    }
}