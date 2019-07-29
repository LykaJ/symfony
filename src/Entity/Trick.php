<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 * @UniqueEntity("title")
 */
class Trick
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    /**
     * @ORM\Column(type="text")
     */
    private $content;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="tricks")
     */
    private $category;
    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $editionDate;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

    /**
     * @var UploadedFile
     * @Assert\File(
     *     maxSize = "300k",
     *     maxSizeMessage = "Le fichier est trop volumineux (0.53 MB). Sa taille ne doit pas dépasser 0.3 MB."
     * )
     */
    private $uploadedImage;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="trick", orphanRemoval=true)
     */
    private $comments;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImageMedia", mappedBy="trick", orphanRemoval=true, cascade={"persist", "remove"})
     */
    public $mediaImages;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VideoMedia", mappedBy="trick", orphanRemoval=true, cascade={"persist", "remove"})
     */
    public $mediaVideos;


    /**
     * Trick constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime;
        $this->editionDate = new \DateTime();
        $this->comments = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->mediaImages = new ArrayCollection();
        $this->mediaVideos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return Trick
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getCreationDate(): ?DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function getEditionDate(): ?DateTimeInterface
    {
        return $this->editionDate;
    }

    /**
     * @param DateTimeInterface|null $editionDate
     * @return Trick
     * @throws \Exception
     */
    public function setEditionDate(?DateTimeInterface $editionDate): self
    {
        $this->editionDate = $editionDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Trick
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getImageUpload(): ?UploadedFile
    {
        return $this->uploadedImage;
    }

    /**
     * @param UploadedFile $uploadedImage
     * @return Trick
     * @throws \Exception
     */
    public function setImageUpload(?UploadedFile $uploadedImage): self
    {
        $this->uploadedImage = $uploadedImage;
        $this->editionDate = new \DateTime('now');
        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTrick($this);
        }
        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|ImageMedia[]
     */
    public function getMediaImages(): ?Collection
    {
        return $this->mediaImages;
    }

    /**
     * @param ImageMedia $imageMedium
     * @return Trick
     */
    public function addImageMedium(ImageMedia $imageMedium): self
    {
        if (!$this->mediaImages->contains($imageMedium)) {
            $this->mediaImages[] = $imageMedium;
            $imageMedium->setTrick($this);
        }
        return $this;
    }

    /**
     * @param ImageMedia $imageMedium
     * @return Trick
     */
    public function removeImageMedium(ImageMedia $imageMedium): self
    {
        if ($this->mediaImages->contains($imageMedium)) {
            $this->mediaImages->removeElement($imageMedium);
            // set the owning side to null (unless already changed)
            if ($imageMedium->getTrick() === $this) {
                $imageMedium->setTrick(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|VideoMedia[]
     */
    public function getMediaVideos(): ?Collection
    {
        return $this->mediaVideos;
    }


    /**
     * @param VideoMedia $videoMedium
     * @return Trick
     */
    public function addVideoMedium(VideoMedia $videoMedium): self
    {
        if (!$this->mediaVideos->contains($videoMedium)) {
            $this->mediaVideos[] = $videoMedium;
            $videoMedium->setTrick($this);
        }
        return $this;
    }


    /**
     * @param VideoMedia $videoMedium
     * @return Trick
     */
    public function removeVideoMedium(VideoMedia $videoMedium): self
    {
        if ($this->mediaVideos->contains($videoMedium)) {
            $this->mediaVideos->removeElement($videoMedium);
            // set the owning side to null (unless already changed)
            if ($videoMedium->getTrick() === $this) {
                $videoMedium->setTrick(null);
            }
        }
        return $this;
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->category,
            $this->mediaImages,
            $this->mediaVideos
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}