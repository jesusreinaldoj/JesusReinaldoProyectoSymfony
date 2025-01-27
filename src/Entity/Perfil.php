<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto = null;

    #[ORM\Column(nullable: true)]
    private ?int $edad = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, PerfilEstilo>
     */
    #[ORM\OneToMany(targetEntity: PerfilEstilo::class, mappedBy: 'perfil')]
    private Collection $perfilEstilos;

    public function __construct()
    {
        $this->perfilEstilos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): static
    {
        $this->foto = $foto;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): static
    {
        $this->edad = $edad;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, PerfilEstilo>
     */
    public function getPerfilEstilos(): Collection
    {
        return $this->perfilEstilos;
    }

    public function addPerfilEstilo(PerfilEstilo $perfilEstilo): static
    {
        if (!$this->perfilEstilos->contains($perfilEstilo)) {
            $this->perfilEstilos->add($perfilEstilo);
            $perfilEstilo->setPerfil($this);
        }

        return $this;
    }

    public function removePerfilEstilo(PerfilEstilo $perfilEstilo): static
    {
        if ($this->perfilEstilos->removeElement($perfilEstilo)) {
            // set the owning side to null (unless already changed)
            if ($perfilEstilo->getPerfil() === $this) {
                $perfilEstilo->setPerfil(null);
            }
        }

        return $this;
    }
}
