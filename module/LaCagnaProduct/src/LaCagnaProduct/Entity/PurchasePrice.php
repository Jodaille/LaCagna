<?php

namespace LaCagnaProduct\Entity;

/**
 * PurchasePrice
 */
class PurchasePrice
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $value;

    /**
     * @var \DateTime
     */
    private $purchased_at;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \LaCagnaProduct\Entity\Article
     */
    private $article;

    /**
     * @var \LaCagnaProduct\Entity\Supplier
     */
    private $supplier;


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
     * Set value
     *
     * @param float $value
     *
     * @return PurchasePrice
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set purchasedAt
     *
     * @param \DateTime $purchasedAt
     *
     * @return PurchasePrice
     */
    public function setPurchasedAt($purchasedAt)
    {
        $this->purchased_at = $purchasedAt;

        return $this;
    }

    /**
     * Get purchasedAt
     *
     * @return \DateTime
     */
    public function getPurchasedAt()
    {
        return $this->purchased_at;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PurchasePrice
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
     * @return PurchasePrice
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
     * Set article
     *
     * @param \LaCagnaProduct\Entity\Article $article
     *
     * @return PurchasePrice
     */
    public function setArticle(\LaCagnaProduct\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \LaCagnaProduct\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set supplier
     *
     * @param \LaCagnaProduct\Entity\Supplier $supplier
     *
     * @return PurchasePrice
     */
    public function setSupplier(\LaCagnaProduct\Entity\Supplier $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \LaCagnaProduct\Entity\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
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
    {;
        $this->updated_at = new \DateTime("now");
    }
}
