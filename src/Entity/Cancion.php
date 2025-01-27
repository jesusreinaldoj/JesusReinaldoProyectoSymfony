<?php

namespace App\Entity;

use App\Repository\CancionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CancionRepository::class)]
class Cancion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $duracion = null;

    #[ORM\Column(length: 20)]
    private ?string $autor = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $ubicacion = null;

    #[ORM\Column]
    private ?int $likes = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $album = null;

    #[ORM\Column]
    private ?int $reproducciones = null;

    #[ORM\OneToOne(inversedBy: 'cancion', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Estilo $genero = null;

    /**
     * @var Collection<int, PlayListCancion>
     */
    #[ORM\OneToMany(targetEntity: PlayListCancion::class, mappedBy: 'cancion')]
    private Collection $playListCancions;

    /**
     * @var Collection<int, UsuarioCancion>
     */
    #[ORM\OneToMany(targetEntity: UsuarioCancion::class, mappedBy: 'cancion')]
    private Collection $usuarioCancions;

    public function __construct()
    {
        $this->playListCancions = new ArrayCollection();
        $this->usuarioCancions = new ArrayCollection();
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

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): static
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): static
    {
        $this->autor = $autor;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(?string $ubicacion): static
    {
        $this->ubicacion = $ubicacion;

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

    public function getAlbum(): ?string
    {
        return $this->album;
    }

    public function setAlbum(?string $album): static
    {
        $this->album = $album;

        return $this;
    }

    public function getReproducciones(): ?int
    {
        return $this->reproducciones;
    }

    public function setReproducciones(int $reproducciones): static
    {
        $this->reproducciones = $reproducciones;

        return $this;
    }

    public function getGenero(): ?Estilo
    {
        return $this->genero;
    }

    public function setGenero(Estilo $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * @return Collection<int, PlayListCancion>
     */
    public function getPlayListCancions(): Collection
    {
        return $this->playListCancions;
    }

    public function addPlayListCancion(PlayListCancion $playListCancion): static
    {
        if (!$this->playListCancions->contains($playListCancion)) {
            $this->playListCancions->add($playListCancion);
            $playListCancion->setCancion($this);
        }

        return $this;
    }

    public function removePlayListCancion(PlayListCancion $playListCancion): static
    {
        if ($this->playListCancions->removeElement($playListCancion)) {
            // set the owning side to null (unless already changed)
            if ($playListCancion->getCancion() === $this) {
                $playListCancion->setCancion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UsuarioCancion>
     */
    public function getUsuarioCancions(): Collection
    {
        return $this->usuarioCancions;
    }

    public function addUsuarioCancion(UsuarioCancion $usuarioCancion): static
    {
        if (!$this->usuarioCancions->contains($usuarioCancion)) {
            $this->usuarioCancions->add($usuarioCancion);
            $usuarioCancion->setCancion($this);
        }

        return $this;
    }

    public function removeUsuarioCancion(UsuarioCancion $usuarioCancion): static
    {
        if ($this->usuarioCancions->removeElement($usuarioCancion)) {
            // set the owning side to null (unless already changed)
            if ($usuarioCancion->getCancion() === $this) {
                $usuarioCancion->setCancion(null);
            }
        }

        return $this;
    }
}
