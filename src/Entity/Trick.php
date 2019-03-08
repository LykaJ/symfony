<?php

namespace App\Entity;

use DateTimeInterface;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="tricks")
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
     * @Assert\NotBlank(message="Ajoutez une image")
     */
    private $image;

    /**
     * Trick constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->creation_date = new \DateTime();
        $this->edition_date = new \DateTime();
    }

    public function __toString()
    {
       return $this->category;
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

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     * @return $this
     * @throws \Exception
     */
    public function setImage($image)
    {
        $this->image = $image;

        if($this->image instanceof UploadedFile)
        {
            $this->edition_date = new \DateTime('now');
        }

        return $this;
    }
}
