<?php

namespace App\Entity;

use App\Repository\SeedVarietyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeedVarietyRepository::class)]
class SeedVariety
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'seedVariety', targetEntity: SeedType::class)]
    private Collection $seedTypes;

    public function __construct()
    {
        $this->seedTypes = new ArrayCollection();
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

    /**
     * @return Collection<int, SeedType>
     */
    public function getSeedTypes(): Collection
    {
        return $this->seedTypes;
    }

    public function addSeedType(SeedType $seedType): self
    {
        if (!$this->seedTypes->contains($seedType)) {
            $this->seedTypes->add($seedType);
            $seedType->setSeedVariety($this);
        }

        return $this;
    }

    public function removeSeedType(SeedType $seedType): self
    {
        if ($this->seedTypes->removeElement($seedType)) {
            // set the owning side to null (unless already changed)
            if ($seedType->getSeedVariety() === $this) {
                $seedType->setSeedVariety(null);
            }
        }

        return $this;
    }
}
