<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PayementRepository")
 */
class Payement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datePaie;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroCompte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroCheque;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePayement", inversedBy="payements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePayement;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\facture", inversedBy="payements")
     */
    private $facture;

    public function __construct()
    {
        $this->facture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePaie(): ?\DateTimeInterface
    {
        return $this->datePaie;
    }

    public function setDatePaie(\DateTimeInterface $datePaie): self
    {
        $this->datePaie = $datePaie;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getNumeroCompte(): ?string
    {
        return $this->numeroCompte;
    }

    public function setNumeroCompte(string $numeroCompte): self
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }

    public function getNumeroCheque(): ?string
    {
        return $this->numeroCheque;
    }

    public function setNumeroCheque(string $numeroCheque): self
    {
        $this->numeroCheque = $numeroCheque;

        return $this;
    }

    public function getTypePayement(): ?TypePayement
    {
        return $this->typePayement;
    }

    public function setTypePayement(?TypePayement $typePayement): self
    {
        $this->typePayement = $typePayement;

        return $this;
    }

    /**
     * @return Collection|facture[]
     */
    public function getFacture(): Collection
    {
        return $this->facture;
    }

    public function addFacture(facture $facture): self
    {
        if (!$this->facture->contains($facture)) {
            $this->facture[] = $facture;
        }

        return $this;
    }

    public function removeFacture(facture $facture): self
    {
        if ($this->facture->contains($facture)) {
            $this->facture->removeElement($facture);
        }

        return $this;
    }
}
