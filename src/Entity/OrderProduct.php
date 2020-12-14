<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OrderProductRepository::class)
 */
class OrderProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orderProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="float")
     */
    private $Qte;

    /**
     * @ORM\Column(type="float")
     */
    private $amountProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?Order
    {
        return $this->commande;
    }

    public function setCommande(?Order $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQte(): ?float
    {
        return $this->Qte;
    }

    public function setQte(float $Qte): self
    {
        $this->Qte = $Qte;

        return $this;
    }

    public function getAmountProduct(): ?float
    {
        return $this->amountProduct;
    }

    public function setAmountProduct(float $amountProduct): self
    {
        $this->amountProduct = $amountProduct;

        return $this;
    }
}
