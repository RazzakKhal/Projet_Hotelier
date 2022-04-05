<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    #[ORM\Column(type: 'string', length: 255)]
    private $Image;

    #[ORM\Column(type: 'text')]
    private $Description;

    #[ORM\Column(type: 'float')]
    private $Price;

    #[ORM\Column(type: 'array')]
    private $Library = [];

    #[ORM\Column(type: 'string', length: 255)]
    private $BookingLink;

    #[ORM\ManyToOne(targetEntity: Etablissement::class, inversedBy: 'Rooms')]
    #[ORM\JoinColumn(nullable: false)]
    private $etablissement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getLibrary(): ?array
    {
        return $this->Library;
    }

    public function setLibrary(array $Library): self
    {
        $this->Library = $Library;

        return $this;
    }

    public function getBookingLink(): ?string
    {
        return $this->BookingLink;
    }

    public function setBookingLink(string $BookingLink): self
    {
        $this->BookingLink = $BookingLink;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }
}
