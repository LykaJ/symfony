<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
     * @ORM\Column(type="string", length=60)
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
     * @ORM\Column(type="integer")
     */
    private $category_id;

    public function __construct()
    {
        $this->creation_date = new \DateTime();
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
    public function getCategory(): ?string //?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return Trick
     */
    public function setCategory(string $category): self //(?Category $category)
    {
        $this->category = $category;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getEditionDate(): ?\DateTimeInterface
    {
        return $this->edition_date;
    }

    public function setEditionDate(?\DateTimeInterface $edition_date): self
    {
        $this->edition_date = $edition_date;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

}
