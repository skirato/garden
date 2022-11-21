<?php

namespace App\Entity;

use App\Repository\SeedTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeedTypeRepository::class)]
class SeedType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'seedTypes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SeedVariety $seedType = null;

    #[ORM\OneToMany(mappedBy: 'seedType', targetEntity: Seed::class)]
    private Collection $seeds;

    public function __construct()
    {
        $this->seeds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSeedType(): ?SeedVariety
    {
        return $this->seedType;
    }

    public function setSeedType(?SeedVariety $seedType): self
    {
        $this->seedType = $seedType;

        return $this;
    }

    /**
     * @return Collection<int, Seed>
     */
    public function getSeeds(): Collection
    {
        return $this->seeds;
    }

    public function addSeed(Seed $seed): self
    {
        if (!$this->seeds->contains($seed)) {
            $this->seeds->add($seed);
            $seed->setSeedType($this);
        }

        return $this;
    }

    public function removeSeed(Seed $seed): self
    {
        if ($this->seeds->removeElement($seed)) {
            // set the owning side to null (unless already changed)
            if ($seed->getSeedType() === $this) {
                $seed->setSeedType(null);
            }
        }

        return $this;
    }
}
