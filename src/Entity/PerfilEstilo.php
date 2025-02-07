<?php

namespace App\Entity;

use App\Repository\PerfilEstiloRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilEstiloRepository::class)]
class PerfilEstilo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'perfilEstilos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Perfil $perfil = null;

    #[ORM\ManyToOne(inversedBy: 'perfilEstilos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Estilo $estilo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil): static
    {
        $this->perfil = $perfil;

        return $this;
    }

    public function getEstilo(): ?Estilo
    {
        return $this->estilo;
    }

    public function setEstilo(?Estilo $estilo): static
    {
        $this->estilo = $estilo;

        return $this;
    }
}
