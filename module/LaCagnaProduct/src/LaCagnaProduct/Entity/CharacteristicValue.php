<?php

namespace LaCagnaProduct\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharacteristicValue
 */
class CharacteristicValue
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $value;

    /**
     * @var \LaCagnaProduct\Entity\Characteristic
     */
    private $characteristic;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set value
     *
     * @param string $value
     *
     * @return CharacteristicValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set characteristic
     *
     * @param \LaCagnaProduct\Entity\Characteristic $characteristic
     *
     * @return CharacteristicValue
     */
    public function setCharacteristic(\LaCagnaProduct\Entity\Characteristic $characteristic = null)
    {
        $this->characteristic = $characteristic;

        return $this;
    }

    /**
     * Get characteristic
     *
     * @return \LaCagnaProduct\Entity\Characteristic
     */
    public function getCharacteristic()
    {
        return $this->characteristic;
    }

    /**
     * Add article
     *
     * @param \LaCagnaProduct\Entity\Article $article
     *
     * @return CharacteristicValue
     */
    public function addArticle(\LaCagnaProduct\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \LaCagnaProduct\Entity\Article $article
     */
    public function removeArticle(\LaCagnaProduct\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
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
