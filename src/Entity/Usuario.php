<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    private ?string $password = null;

    /**
     * @var Collection<int, UsuarioPlayList>
     */
    #[ORM\OneToMany(targetEntity: UsuarioPlayList::class, mappedBy: 'usuario')]
    private Collection $playlist;

    /**
     * @var Collection<int, UsuarioCancion>
     */
    #[ORM\OneToMany(targetEntity: UsuarioCancion::class, mappedBy: 'usuario')]
    private Collection $usuarioCancions;

    public function __construct()
    {
        $this->playlist = new ArrayCollection();
        $this->usuarioCancions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, UsuarioPlayList>
     */
    public function getPlaylist(): Collection
    {
        return $this->playlist;
    }

    public function addPlaylist(UsuarioPlayList $playlist): static
    {
        if (!$this->playlist->contains($playlist)) {
            $this->playlist->add($playlist);
            $playlist->setUsuario($this);
        }

        return $this;
    }

    public function removePlaylist(UsuarioPlayList $playlist): static
    {
        if ($this->playlist->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getUsuario() === $this) {
                $playlist->setUsuario(null);
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
            $usuarioCancion->setUsuario($this);
        }

        return $this;
    }

    public function removeUsuarioCancion(UsuarioCancion $usuarioCancion): static
    {
        if ($this->usuarioCancions->removeElement($usuarioCancion)) {
            // set the owning side to null (unless already changed)
            if ($usuarioCancion->getUsuario() === $this) {
                $usuarioCancion->setUsuario(null);
            }
        }

        return $this;
    }
}
