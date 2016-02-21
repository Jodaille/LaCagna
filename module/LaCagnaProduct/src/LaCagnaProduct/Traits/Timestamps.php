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
    private $created_at;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
	    $now = new Datetime;
        $this->created_at = $now;
        $this->updated_at = $now;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updated_at = new DateTime;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->created_at = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updated_at = $updatedAt;
    }
}
