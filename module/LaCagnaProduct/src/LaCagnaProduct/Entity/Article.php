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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add stocks
     *
     * @param \LaCagnaProduct\Entity\Stock $stocks
     * @return Article
     */
    public function addStock(\LaCagnaProduct\Entity\Stock $stocks)
    {
        $this->stocks[] = $stocks;

        return $this;
    }

    /**
     * Remove stocks
     *
     * @param \LaCagnaProduct\Entity\Stock $stocks
     */
    public function removeStock(\LaCagnaProduct\Entity\Stock $stocks)
    {
        $this->stocks->removeElement($stocks);
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
     * Add prices
     *
     * @param \LaCagnaProduct\Entity\Price $prices
     * @return Article
     */
    public function addPrice(\LaCagnaProduct\Entity\Price $prices)
    {
        $this->prices[] = $prices;

        return $this;
    }

    /**
     * Remove prices
     *
     * @param \LaCagnaProduct\Entity\Price $prices
     */
    public function removePrice(\LaCagnaProduct\Entity\Price $prices)
    {
        $this->prices->removeElement($prices);
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
     * Add products
     *
     * @param \LaCagnaProduct\Entity\Product $products
     * @return Article
     */
    public function addProduct(\LaCagnaProduct\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \LaCagnaProduct\Entity\Product $products
     */
    public function removeProduct(\LaCagnaProduct\Entity\Product $products)
    {
        $this->products->removeElement($products);
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
     * Add medias
     *
     * @param \LaCagnaProduct\Entity\Media $medias
     * @return Article
     */
    public function addMedia(\LaCagnaProduct\Entity\Media $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \LaCagnaProduct\Entity\Media $medias
     */
    public function removeMedia(\LaCagnaProduct\Entity\Media $medias)
    {
        $this->medias->removeElement($medias);
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
     * Add characteristicsvalues
     *
     * @param \LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalues
     * @return Article
     */
    public function addCharacteristicsvalue(\LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalues)
    {
        $this->characteristicsvalues[] = $characteristicsvalues;

        return $this;
    }

    /**
     * Remove characteristicsvalues
     *
     * @param \LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalues
     */
    public function removeCharacteristicsvalue(\LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalues)
    {
        $this->characteristicsvalues->removeElement($characteristicsvalues);
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
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        // Add your code here
    }
}
