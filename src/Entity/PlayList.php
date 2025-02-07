<?php

namespace App\Entity;

use App\Repository\PlayListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayListRepository::class)]
class PlayList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $likes = null;

    #[ORM\Column(length: 20)]
    private ?string $visibilidad = null;

    /**
     * @var Collection<int, UsuarioPlayList>
     */
    #[ORM\OneToMany(targetEntity: UsuarioPlayList::class, mappedBy: 'playlist')]
    private Collection $usuario;

    /**
     * @var Collection<int, PlayListCancion>
     */
    #[ORM\OneToMany(targetEntity: PlayListCancion::class, mappedBy: 'playlist')]
    private Collection $canciones;

    public function __construct()
    {
        $this->usuario = new ArrayCollection();
        $this->canciones = new ArrayCollection();
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

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getVisibilidad(): ?string
    {
        return $this->visibilidad;
    }

    public function setVisibilidad(string $visibilidad): static
    {
        $this->visibilidad = $visibilidad;

        return $this;
    }

    /**
     * @return Collection<int, UsuarioPlayList>
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function addUsuario(UsuarioPlayList $usuario): static
    {
        if (!$this->usuario->contains($usuario)) {
            $this->usuario->add($usuario);
            $usuario->setPlaylist($this);
        }

        return $this;
    }

    public function removeUsuario(UsuarioPlayList $usuario): static
    {
        if ($this->usuario->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getPlaylist() === $this) {
                $usuario->setPlaylist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayListCancion>
     */
    public function getCanciones(): Collection
    {
        return $this->canciones;
    }

    public function addCancione(PlayListCancion $cancione): static
    {
        if (!$this->canciones->contains($cancione)) {
            $this->canciones->add($cancione);
            $cancione->setPlaylist($this);
        }

        return $this;
    }

    public function removeCancione(PlayListCancion $cancione): static
    {
        if ($this->canciones->removeElement($cancione)) {
            // set the owning side to null (unless already changed)
            if ($cancione->getPlaylist() === $this) {
                $cancione->setPlaylist(null);
            }
        }

        return $this;
    }
}
