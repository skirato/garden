<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantRepository::class)]
class Plant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'plants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seed $seed = null;

    #[ORM\OneToOne(targetEntity: self::class, cascade: ['persist', 'remove'])]
    private ?self $parent = null;

    #[ORM\ManyToOne(inversedBy: 'plants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Container $container = null;

    #[ORM\Column]
    private ?int $qtySeedsPerSlot = null;

    #[ORM\ManyToMany(targetEntity: Feed::class, inversedBy: 'plants')]
    private Collection $feeds;

    #[ORM\Column]
    private ?int $posX = null;

    #[ORM\Column]
    private ?int $posY = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $plantedAt = null;

    #[ORM\OneToMany(mappedBy: 'plant', targetEntity: Observation::class)]
    private Collection $observations;

    public function __construct()
    {
        $this->feeds = new ArrayCollection();
        $this->observations = new ArrayCollection();
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

    public function getSeed(): ?Seed
    {
        return $this->seed;
    }

    public function setSeed(?Seed $seed): self
    {
        $this->seed = $seed;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getContainer(): ?Container
    {
        return $this->container;
    }

    public function setContainer(?Container $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function getQtySeedsPerSlot(): ?int
    {
        return $this->qtySeedsPerSlot;
    }

    public function setQtySeedsPerSlot(int $qtySeedsPerSlot): self
    {
        $this->qtySeedsPerSlot = $qtySeedsPerSlot;

        return $this;
    }

    /**
     * @return Collection<int, Feed>
     */
    public function getFeeds(): Collection
    {
        return $this->feeds;
    }

    public function addFeed(Feed $feed): self
    {
        if (!$this->feeds->contains($feed)) {
            $this->feeds->add($feed);
        }

        return $this;
    }

    public function removeFeed(Feed $feed): self
    {
        $this->feeds->removeElement($feed);

        return $this;
    }

    public function getPosX(): ?int
    {
        return $this->posX;
    }

    public function setPosX(int $posX): self
    {
        $this->posX = $posX;

        return $this;
    }

    public function getPosY(): ?int
    {
        return $this->posY;
    }

    public function setPosY(int $posY): self
    {
        $this->posY = $posY;

        return $this;
    }

    public function getPlantedAt(): ?\DateTimeImmutable
    {
        return $this->plantedAt;
    }

    public function setPlantedAt(\DateTimeImmutable $plantedAt): self
    {
        $this->plantedAt = $plantedAt;

        return $this;
    }

    /**
     * @return Collection<int, Observation>
     */
    public function getObservations(): Collection
    {
        return $this->observations;
    }

    public function addObservation(Observation $observation): self
    {
        if (!$this->observations->contains($observation)) {
            $this->observations->add($observation);
            $observation->setPlant($this);
        }

        return $this;
    }

    public function removeObservation(Observation $observation): self
    {
        if ($this->observations->removeElement($observation)) {
            // set the owning side to null (unless already changed)
            if ($observation->getPlant() === $this) {
                $observation->setPlant(null);
            }
        }

        return $this;
    }
}
