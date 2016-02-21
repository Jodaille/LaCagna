<?php

namespace LaCagnaProduct\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="LaCagnaProduct\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Product
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
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \LaCagnaProduct\Entity\Media
     */
    private $mainmedia;

    /**
     * @var \LaCagnaProduct\Entity\Brand
     */
    private $brand;

    /**
     * @var \LaCagnaProduct\Entity\Type
     */
    private $type;

    /**
     * @var \LaCagnaProduct\Entity\State
     */
    private $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ingredients;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categories;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $flags;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $medias;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->flags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
     * @return Product
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
     * Set title
     *
     * @param string $title
     * @return Product
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
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set mainmedia
     *
     * @param \LaCagnaProduct\Entity\Media $mainmedia
     * @return Product
     */
    public function setMainmedia(\LaCagnaProduct\Entity\Media $mainmedia = null)
    {
        $this->mainmedia = $mainmedia;

        return $this;
    }

    /**
     * Get mainmedia
     *
     * @return \LaCagnaProduct\Entity\Media
     */
    public function getMainmedia()
    {
        return $this->mainmedia;
    }

    /**
     * Set brand
     *
     * @param \LaCagnaProduct\Entity\Brand $brand
     * @return Product
     */
    public function setBrand(\LaCagnaProduct\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \LaCagnaProduct\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set type
     *
     * @param \LaCagnaProduct\Entity\Type $type
     * @return Product
     */
    public function setType(\LaCagnaProduct\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \LaCagnaProduct\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set state
     *
     * @param \LaCagnaProduct\Entity\State $state
     * @return Product
     */
    public function setState(\LaCagnaProduct\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \LaCagnaProduct\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add ingredients
     *
     * @param \LaCagnaProduct\Entity\Ingredient $ingredients
     * @return Product
     */
    public function addIngredient(\LaCagnaProduct\Entity\Ingredient $ingredients)
    {
        $this->ingredients[] = $ingredients;

        return $this;
    }

    /**
     * Remove ingredients
     *
     * @param \LaCagnaProduct\Entity\Ingredient $ingredients
     */
    public function removeIngredient(\LaCagnaProduct\Entity\Ingredient $ingredients)
    {
        $this->ingredients->removeElement($ingredients);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Add categories
     *
     * @param \LaCagnaProduct\Entity\Category $categories
     * @return Product
     */
    public function addCategory(\LaCagnaProduct\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \LaCagnaProduct\Entity\Category $categories
     */
    public function removeCategory(\LaCagnaProduct\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
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
     * Add flags
     *
     * @param \LaCagnaProduct\Entity\Flag $flags
     * @return Product
     */
    public function addFlag(\LaCagnaProduct\Entity\Flag $flags)
    {
        $this->flags[] = $flags;

        return $this;
    }

    /**
     * Remove flags
     *
     * @param \LaCagnaProduct\Entity\Flag $flags
     */
    public function removeFlag(\LaCagnaProduct\Entity\Flag $flags)
    {
        $this->flags->removeElement($flags);
    }

    /**
     * Get flags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Add articles
     *
     * @param \LaCagnaProduct\Entity\Article $articles
     * @return Product
     */
    public function addArticle(\LaCagnaProduct\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \LaCagnaProduct\Entity\Article $articles
     */
    public function removeArticle(\LaCagnaProduct\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
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
     * Add medias
     *
     * @param \LaCagnaProduct\Entity\Media $medias
     * @return Product
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
