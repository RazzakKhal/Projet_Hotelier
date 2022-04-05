<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $City;

    #[ORM\Column(type: 'string', length: 255)]
    private $Adress;

    #[ORM\Column(type: 'text')]
    private $Description;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Room::class, orphanRemoval: true)]
    private $Rooms;

    #[ORM\OneToOne(mappedBy: 'etablissement', targetEntity: User::class, cascade: ['persist', 'remove'])]

    private $Manager;

    public function __construct()
    {
        $this->Rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(string $Adress): self
    {
        $this->Adress = $Adress;

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

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->Rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->Rooms->contains($room)) {
            $this->Rooms[] = $room;
            $room->setEtablissement($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->Rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getEtablissement() === $this) {
                $room->setEtablissement(null);
            }
        }

        return $this;
    }

    public function getManager(): ?User
    {
        return $this->Manager;
    }

    public function setManager(User $Manager): self
    {
        $this->Manager = $Manager;

        return $this;
    }
}
