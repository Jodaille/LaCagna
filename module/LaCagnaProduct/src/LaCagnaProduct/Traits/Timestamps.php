<?php
/*
@author: Mitchell van Wijngaarden
https://github.com/mitchellvanw/laravel-doctrine/blob/master/src/Traits/Timestamps.php
*/

namespace LaCagnaProduct\Traits;

use Doctrine\ORM\Mapping AS ORM;
use DateTime;

trait Timestamps
{
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
	    $now = new Datetime;
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new DateTime;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}
