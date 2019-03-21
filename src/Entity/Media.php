<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trick", inversedBy="media")
     */
    private $trick;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param array $path
     * @return Media
     */
    public function setPath(?string $path): self
    {
        $this->path = $path;

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
