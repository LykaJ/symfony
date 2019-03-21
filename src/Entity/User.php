<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="Cet identifiant est déjà utilisé"
 * )
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $real_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="6", minMessage="Votre mot de passe doit contenir au moins 6 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $signup_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $last_login;

    /**
     * @ORM\Column(type="integer")
     */
    private $picture_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Trick", mappedBy="author", cascade={"persist", "remove"})
     */
    private $trick;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="author")
     */
    private $comments;

    /**

     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe ne correspondent pas")
     */
    private $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    /**
     * @Assert\Length(min="6", minMessage="Votre mot de passe doit contenir au moins 6 caractères")
     */
    private $new_password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe ne correspondent pas")
     */
    private $confirm_new_password;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PasswordReset", mappedBy="user", cascade={"persist", "remove"})
     */
    private $passwordReset;

    /**
     * User constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->signup_date = new \DateTime();
        $this->last_login = new \DateTime();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRealName(): ?string
    {
        return $this->real_name;
    }

    public function setRealName(string $real_name): self
    {
        $this->real_name = $real_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSignupDate(): ?\DateTimeInterface
    {
        return $this->signup_date;
    }

    public function setSignupDate(\DateTimeInterface $signup_date): self
    {
        $this->signup_date = $signup_date;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->last_login;
    }

    public function setLastLogin(\DateTimeInterface $last_login): self
    {
        $this->last_login = $last_login;

        return $this;
    }

    public function getPictureId(): ?int
    {
        return $this->picture_id;
    }

    public function setPictureId(int $picture_id): self
    {
        $this->picture_id = $picture_id;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
     $this->confirm_password = $confirm_password;
     return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->new_password;
    }

    public function setNewPassword(string $new_password): self
    {
        $this->new_password = $new_password;
        return $this;
    }

    public function getConfirmNewPassword(): ?string
    {
        return $this->confirm_new_password;
    }

    public function setConfirmNewPassword(string $confirm_new_password): self
    {
        $this->confirm_new_password = $confirm_new_password;
        return $this;
    }


    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
        ]);
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
            $this->username,
            $this->password
        ) =  unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(Trick $trick): self
    {
        $this->trick = $trick;

        // set the owning side of the relation if necessary
        if ($this !== $trick->getAuthor()) {
            $trick->setAuthor($this);
        }

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
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPasswordReset(): ?PasswordReset
    {
        return $this->passwordReset;
    }

    public function setPasswordReset(?PasswordReset $passwordReset): self
    {
        $this->passwordReset = $passwordReset;

        // set (or unset) the owning side of the relation if necessary
        $newUser_id = $passwordReset === null ? null : $this;
        if ($newUser_id !== $passwordReset->getUserId()) {
            $passwordReset->setUserId($newUser_id);
        }

        return $this;
    }

    public function getToken(): ?PasswordReset
    {
        return $this->token;
    }

    public function setToken(?PasswordReset $token): self
    {
        $this->token = $token;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $token === null ? null : $this;
        if ($newUser !== $token->getUser()) {
            $token->setUser($newUser);
        }

        return $this;
    }
}
