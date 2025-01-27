<?php

namespace App\Entity;

use App\Repository\EstiloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstiloRepository::class)]
class Estilo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, PerfilEstilo>
     */
    #[ORM\OneToMany(targetEntity: PerfilEstilo::class, mappedBy: 'estilo')]
    private Collection $perfilEstilos;

    #[ORM\OneToOne(mappedBy: 'genero', cascade: ['persist', 'remove'])]
    private ?Cancion $cancion = null;

    public function __construct()
    {
        $this->perfilEstilos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
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
            $perfilEstilo->setEstilo($this);
        }

        return $this;
    }

    public function removePerfilEstilo(PerfilEstilo $perfilEstilo): static
    {
        if ($this->perfilEstilos->removeElement($perfilEstilo)) {
            // set the owning side to null (unless already changed)
            if ($perfilEstilo->getEstilo() === $this) {
                $perfilEstilo->setEstilo(null);
            }
        }

        return $this;
    }

    public function getCancion(): ?Cancion
    {
        return $this->cancion;
    }

    public function setCancion(Cancion $cancion): static
    {
        // set the owning side of the relation if necessary
        if ($cancion->getGenero() !== $this) {
            $cancion->setGenero($this);
        }

        $this->cancion = $cancion;

        return $this;
    }
}
