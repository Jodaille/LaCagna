<?php

namespace LaCagnaProduct\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 */
class Price
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
     * @var float
     */
    private $specialValue;

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
     * @return Price
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
     * Set specialValue
     *
     * @param float $specialValue
     * @return Price
     */
    public function setSpecialValue($specialValue)
    {
        $this->specialValue = $specialValue;

        return $this;
    }

    /**
     * Get specialValue
     *
     * @return float
     */
    public function getSpecialValue()
    {
        return $this->specialValue;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Price
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
     * @return Price
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
     * Set article
     *
     * @param \LaCagnaProduct\Entity\Article $article
     * @return Price
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
