<?php

namespace LaCagnaProduct\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 */
class Article
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $codeprovider;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stocks;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $prices;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $medias;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $characteristicsvalues;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->characteristicsvalues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Article
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set codeprovider
     *
     * @param string $codeprovider
     *
     * @return Article
     */
    public function setCodeprovider($codeprovider)
    {
        $this->codeprovider = $codeprovider;

        return $this;
    }

    /**
     * Get codeprovider
     *
     * @return string
     */
    public function getCodeprovider()
    {
        return $this->codeprovider;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Article
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add stock
     *
     * @param \LaCagnaProduct\Entity\Stock $stock
     *
     * @return Article
     */
    public function addStock(\LaCagnaProduct\Entity\Stock $stock)
    {
        $this->stocks[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \LaCagnaProduct\Entity\Stock $stock
     */
    public function removeStock(\LaCagnaProduct\Entity\Stock $stock)
    {
        $this->stocks->removeElement($stock);
    }

    /**
     * Get stocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Add price
     *
     * @param \LaCagnaProduct\Entity\Price $price
     *
     * @return Article
     */
    public function addPrice(\LaCagnaProduct\Entity\Price $price)
    {
        $this->prices[] = $price;

        return $this;
    }

    /**
     * Remove price
     *
     * @param \LaCagnaProduct\Entity\Price $price
     */
    public function removePrice(\LaCagnaProduct\Entity\Price $price)
    {
        $this->prices->removeElement($price);
    }

    /**
     * Get prices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * Add product
     *
     * @param \LaCagnaProduct\Entity\Product $product
     *
     * @return Article
     */
    public function addProduct(\LaCagnaProduct\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \LaCagnaProduct\Entity\Product $product
     */
    public function removeProduct(\LaCagnaProduct\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add media
     *
     * @param \LaCagnaProduct\Entity\Media $media
     *
     * @return Article
     */
    public function addMedia(\LaCagnaProduct\Entity\Media $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param \LaCagnaProduct\Entity\Media $media
     */
    public function removeMedia(\LaCagnaProduct\Entity\Media $media)
    {
        $this->medias->removeElement($media);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Add characteristicsvalue
     *
     * @param \LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalue
     *
     * @return Article
     */
    public function addCharacteristicsvalue(\LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalue)
    {
        $this->characteristicsvalues[] = $characteristicsvalue;

        return $this;
    }

    /**
     * Remove characteristicsvalue
     *
     * @param \LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalue
     */
    public function removeCharacteristicsvalue(\LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalue)
    {
        $this->characteristicsvalues->removeElement($characteristicsvalue);
    }

    /**
     * Get characteristicsvalues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharacteristicsvalues()
    {
        return $this->characteristicsvalues;
    }
    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updated_at = new \DateTime("now");
    }
}

