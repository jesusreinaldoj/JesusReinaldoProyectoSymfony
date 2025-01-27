<?php

namespace App\Entity;

use App\Repository\PlayListCancionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayListCancionRepository::class)]
class PlayListCancion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'canciones')]
    private ?PlayList $playlist = null;

    #[ORM\ManyToOne(inversedBy: 'playListCancions')]
    private ?Cancion $cancion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylist(): ?PlayList
    {
        return $this->playlist;
    }

    public function setPlaylist(?PlayList $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getCancion(): ?Cancion
    {
        return $this->cancion;
    }

    public function setCancion(?Cancion $cancion): static
    {
        $this->cancion = $cancion;

        return $this;
    }
}
