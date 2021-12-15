<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdminRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 * @UniqueEntity(
 *  fields={"username"},
 *  message="L'identifiant que vous avez indiqué est déja utilisé !"
 * )
 */
class Admin implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\Length(min="8", minMessage="Le mot de passe doit faire minimum 8 caractères 😊")
    * 
    */
    private $password;


    /**
    * @Assert\EqualTo(propertyPath="password", message="Vos mot de passe ne sont pas identique 🤔")
    */
    public $confirm_password;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;


    

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function eraseCredentials(){}

    public function getSalt() {}

    public function getRoles() {
        return ['ROLE_ADMIN'];
    }



}
