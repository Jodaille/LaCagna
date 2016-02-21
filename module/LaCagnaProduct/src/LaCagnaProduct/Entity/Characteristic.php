<?php

namespace LaCagnaProduct\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Characteristic
 */
class Characteristic
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $abbreviation;

    /**
     * @var string
     */
    private $type;

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
    private $characteristicsvalues;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->characteristicsvalues = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set abbreviation
     *
     * @param string $abbreviation
     *
     * @return Characteristic
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * Get abbreviation
     *
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Characteristic
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     *
     * @return Characteristic
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
     *
     * @return Characteristic
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
     * Add characteristicsvalue
     *
     * @param \LaCagnaProduct\Entity\CharacteristicValue $characteristicsvalue
     *
     * @return Characteristic
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
     * Add category
     *
     * @param \LaCagnaProduct\Entity\Category $category
     *
     * @return Characteristic
     */
    public function addCategory(\LaCagnaProduct\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \LaCagnaProduct\Entity\Category $category
     */
    public function removeCategory(\LaCagnaProduct\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
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

