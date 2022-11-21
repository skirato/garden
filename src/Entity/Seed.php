<?php

namespace App\Entity;

use App\Repository\SeedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeedRepository::class)]
class Seed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?bool $isOrganic = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\ManyToOne(inversedBy: 'seeds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SeedType $seedType = null;

    #[ORM\ManyToOne(inversedBy: 'seeds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SeedSource $seedSource = null;

    #[ORM\ManyToOne(inversedBy: 'seeds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SeedBrand $seedBrand = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $acquiredAt = null;

    #[ORM\Column(length: 255)]
    private ?string $icon = null;

    #[ORM\OneToMany(mappedBy: 'seed', targetEntity: Plant::class)]
    private Collection $plants;

    public function __construct()
    {
        $this->plants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function isIsOrganic(): ?bool
    {
        return $this->isOrganic;
    }

    public function setIsOrganic(bool $isOrganic): self
    {
        $this->isOrganic = $isOrganic;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getSeedType(): ?SeedType
    {
        return $this->seedType;
    }

    public function setSeedType(?SeedType $seedType): self
    {
        $this->seedType = $seedType;

        return $this;
    }

    public function getSeedSource(): ?SeedSource
    {
        return $this->seedSource;
    }

    public function setSeedSource(?SeedSource $seedSource): self
    {
        $this->seedSource = $seedSource;

        return $this;
    }

    public function getSeedBrand(): ?SeedBrand
    {
        return $this->seedBrand;
    }

    public function setSeedBrand(?SeedBrand $seedBrand): self
    {
        $this->seedBrand = $seedBrand;

        return $this;
    }

    public function getAcquiredAt(): ?\DateTimeImmutable
    {
        return $this->acquiredAt;
    }

    public function setAcquiredAt(\DateTimeImmutable $acquiredAt): self
    {
        $this->acquiredAt = $acquiredAt;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection<int, Plant>
     */
    public function getPlants(): Collection
    {
        return $this->plants;
    }

    public function addPlant(Plant $plant): self
    {
        if (!$this->plants->contains($plant)) {
            $this->plants->add($plant);
            $plant->setSeed($this);
        }

        return $this;
    }

    public function removePlant(Plant $plant): self
    {
        if ($this->plants->removeElement($plant)) {
            // set the owning side to null (unless already changed)
            if ($plant->getSeed() === $this) {
                $plant->setSeed(null);
            }
        }

        return $this;
    }
}
