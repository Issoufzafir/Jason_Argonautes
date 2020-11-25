<?php

namespace App\Entity;

use App\Repository\ArgonautesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArgonautesRepository::class)
 */
class Argonautes
{
    /**
     * @ORM\Id
     *
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }




}
