<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 11, nullable: true)]
    private ?string $numero_telephone = null;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Client::class)]
    private Collection $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(?string $numero_telephone): static
    {
        $this->numero_telephone = $numero_telephone;

        return $this;
    }

    /**
     * @return Collection<int, client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(client $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->setEntreprise($this);
        }

        return $this;
    }

    public function removeClient(client $client): static
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getEntreprise() === $this) {
                $client->setEntreprise(null);
            }
        }

        return $this;
    }
}
