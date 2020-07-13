<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numchambre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Regex(
     *      pattern = "#^[0-9]+$#",
     * )
     */
    private $numbat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typechambre;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="chambre")
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumchambre(): ?string
    {
        return $this->numchambre;
    }

    public function setNumchambre(string $numchambre): self
    {
        $this->numchambre = $numchambre;

        return $this;
    }

    public function getNumbat(): ?int
    {
        return $this->numbat;
    }

    public function setNumbat(int $numbat): self
    {
        $this->numbat = $numbat;

        return $this;
    }

    public function getTypechambre(): ?string
    {
        return $this->typechambre;
    }

    public function setTypechambre(string $typechambre): self
    {
        $this->typechambre = $typechambre;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Etudiant $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setChambre($this);
        }

        return $this;
    }

    public function removeRelation(Etudiant $relation): self
    {
        if ($this->relation->contains($relation)) {
            $this->relation->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getChambre() === $this) {
                $relation->setChambre(null);
            }
        }

        return $this;
    }
}
