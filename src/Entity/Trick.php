<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="tricks", fetch="EXTRA_LAZY")
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $edition_date;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tricks", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="trick", orphanRemoval=true, fetch="EXTRA_LAZY")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImageMedia", mappedBy="trick", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $imageMedia;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VideoMedia", mappedBy="trick", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $videoMedia;

    /**
     * Trick constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->creation_date = new \DateTime;
        $this->edition_date = new \DateTime();
        $this->comments = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->imageMedia = new ArrayCollection();
        $this->videoMedia = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return (new Slugify())->slugify($this->title);
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
        return $this->creation_date;
    }

    public function setCreationDate(DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getEditionDate(): ?DateTimeInterface
    {
        return $this->edition_date;
    }

    /**
     * @param DateTimeInterface|null $edition_date
     * @return Trick
     * @throws \Exception
     */
    public function setEditionDate(?DateTimeInterface $edition_date): self
    {
        $this->edition_date = $edition_date;

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
        $this->edition_date = new \DateTime('now');

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
    public function getImageMedia(): Collection
    {
        return $this->imageMedia;
    }

    /**
     * @param ImageMedia $imageMedium
     * @return Trick
     */
    public function addImageMedium(ImageMedia $imageMedium): self
    {
        if (!$this->imageMedia->contains($imageMedium)) {
            $this->imageMedia[] = $imageMedium;
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
        if ($this->imageMedia->contains($imageMedium)) {
            $this->imageMedia->removeElement($imageMedium);
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
    public function getVideoMedia(): Collection
    {
        return $this->videoMedia;
    }

    /**
     * @param VideoMedia $videoMedium
     * @return Trick
     */
    public function addVideoMedium(VideoMedia $videoMedium): self
    {
        if (!$this->videoMedia->contains($videoMedium)) {
            $this->videoMedia[] = $videoMedium;
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
        if ($this->videoMedia->contains($videoMedium)) {
            $this->videoMedia->removeElement($videoMedium);
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
            $this->imageMedia,
            $this->videoMedia
            ) =  unserialize($serialized, ['allowed_classes' => false]);
    }
}
