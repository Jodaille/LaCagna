<?php

namespace LaCagnaProduct\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Brand
 */
class Brand
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var integer
     */
    private $id_manufacturer;

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
    private $medias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Brand
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set id_manufacturer
     *
     * @param integer $idManufacturer
     * @return Brand
     */
    public function setIdManufacturer($idManufacturer)
    {
        $this->id_manufacturer = $idManufacturer;

        return $this;
    }

    /**
     * Get id_manufacturer
     *
     * @return integer
     */
    public function getIdManufacturer()
    {
        return $this->id_manufacturer;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Brand
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
     * @return Brand
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
     * Add medias
     *
     * @param \LaCagnaProduct\Entity\Media $medias
     * @return Brand
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
