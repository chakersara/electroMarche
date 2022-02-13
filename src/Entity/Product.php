<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="idProds",type="string", length=255)
     */
    private $idProds;

    /**
     * @ORM\Column(name="amountMax",type="float", nullable=true)
     */
    private $amountMax;

    /**
     * @ORM\Column(name="amountMin",type="float", nullable=true)
     */
    private $amountMin;

    /**
     * @ORM\Column(name="availability",type="text", nullable=true)
     */
    private $availability;

    /**
     * @ORM\Column(name="condition",type="text", nullable=true)
     */
    private $conditionp;

    /**
     * @ORM\Column(name="currency",type="string", length=20, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(name="dateSeen",type="text", nullable=true)
     */
    private $dateSeen;

    /**
     * @ORM\Column(name="isSale",type="integer", nullable=true)
     */
    private $isSale;

    /**
     * @ORM\Column(name="merchant",type="text")
     */
    private $merchant;

    /**
     * @ORM\Column(name="shipping",type="text", nullable=true)
     */
    private $shipping;

    /**
     * @ORM\Column(name="sourceURLs",type="text")
     */
    private $sourceURLs;

    /**
     * @ORM\Column(name="asins",type="text", nullable=true)
     */
    private $asins;

    /**
     * @ORM\Column(name="brand",type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(name="categories",type="string", length=255)
     */
    private $categories;

    /**
     * @ORM\Column(name="dateAdded",type="string", length=255, nullable=true)
     */
    private $dateAdded;

    /**
     * @ORM\Column(name="dateUpdated",type="string", length=255, nullable=true)
     */
    private $dateUpdated;

    /**
     * @ORM\Column(name="ean",type="string", length=255, nullable=true)
     */
    private $ean;

    /**
     * @ORM\Column(name="imageUrls",type="text", nullable=true)
     */
    private $imageURLs;

    /**
     * @ORM\Column(name="keys",type="text", nullable=true)
     */
    private $keysP;

    /**
     * @ORM\Column(name="manufacturer",type="string", length=255, nullable=true)
     */
    private $manufacturer;

    /**
     * @ORM\Column(name="manufacturerNumber",type="string", length=255, nullable=true)
     */
    private $manufacturerNumber;

    /**
     * @ORM\Column(name="name",type="text", nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(name="primaryCategories",type="string", length=225, nullable=true)
     */
    private $primaryCategories;

    /**
     * @ORM\Column(name="upc",type="text", nullable=true)
     */
    private $upc;

    /**
     * @ORM\Column(name="weight",type="text", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(name="imageMerchant",type="text", nullable=true)
     */
    private $imageMerchant;

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProds(): ?string
    {
        return $this->idProds;
    }

    public function setIdProds(string $idProds): self
    {
        $this->idProds = $idProds;

        return $this;
    }

    public function getAmountMax(): ?float
    {
        return $this->amountMax;
    }

    public function setAmountMax(?float $amountMax): self
    {
        $this->amountMax = $amountMax;

        return $this;
    }

    public function getAmountMin(): ?float
    {
        return $this->amountMin;
    }

    public function setAmountMin(?float $amountMin): self
    {
        $this->amountMin = $amountMin;

        return $this;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function setAvailability(?string $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getConditionp(): ?string
    {
        return $this->conditionp;
    }

    public function setConditionp(?string $conditionp): self
    {
        $this->conditionp = $conditionp;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDateSeen(): ?string
    {
        return $this->dateSeen;
    }

    public function setDateSeen(?string $dateSeen): self
    {
        $this->dateSeen = $dateSeen;

        return $this;
    }

    public function getIsSale(): ?int
    {
        return $this->isSale;
    }

    public function setIsSale(?int $isSale): self
    {
        $this->isSale = $isSale;

        return $this;
    }

    public function getMerchant(): ?string
    {
        return $this->merchant;
    }

    public function setMerchant(string $merchant): self
    {
        $this->merchant = $merchant;

        return $this;
    }

    public function getShipping(): ?string
    {
        return $this->shipping;
    }

    public function setShipping(?string $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getSourceURLs(): ?string
    {
        return $this->sourceURLs;
    }

    public function setSourceURLs(string $sourceURLs): self
    {
        $this->sourceURLs = $sourceURLs;

        return $this;
    }

    public function getAsins(): ?string
    {
        return $this->asins;
    }

    public function setAsins(?string $asins): self
    {
        $this->asins = $asins;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(string $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getDateAdded(): ?string
    {
        return $this->dateAdded;
    }

    public function setDateAdded(?string $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?string $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;

        return $this;
    }

    public function getImageURLs(): ?string
    {
        return $this->imageURLs;
    }

    public function setImageURLs(?string $imageURLs): self
    {
        $this->imageURLs = $imageURLs;

        return $this;
    }

    public function getKeysP(): ?string
    {
        return $this->keysP;
    }

    public function setKeysP(?string $keysP): self
    {
        $this->keysP = $keysP;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getManufacturerNumber(): ?string
    {
        return $this->manufacturerNumber;
    }

    public function setManufacturerNumber(?string $manufacturerNumber): self
    {
        $this->manufacturerNumber = $manufacturerNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrimaryCategories(): ?string
    {
        return $this->primaryCategories;
    }

    public function setPrimaryCategories(?string $primaryCategories): self
    {
        $this->primaryCategories = $primaryCategories;

        return $this;
    }

    public function getUpc(): ?string
    {
        return $this->upc;
    }

    public function setUpc(?string $upc): self
    {
        $this->upc = $upc;

        return $this;
    }

    public function getImageMerchant(): ?string
    {
        return $this->imageMerchant;
    }

    public function setImageMerchant(?string $imageMerchant): self
    {
        $this->imageMerchant = $imageMerchant;

        return $this;
    }
}
