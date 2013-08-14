<?php

namespace my;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bread
 */
class Bread
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $cost;

    /**
     * @var integer
     */
    private $tahvilhour;

    /**
     * @var integer
     */
    private $rezervday;

    /**
     * @var integer
     */
    private $rezervhour;

    /**
     * @var \DateTime
     */
    private $fromdate;

    /**
     * @var \DateTime
     */
    private $todate;

    /**
     * @var integer
     */
    private $maxnum;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $buy;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->buy = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param string $type
     * @return Bread
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
     * Set cost
     *
     * @param integer $cost
     * @return Bread
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    
        return $this;
    }

    /**
     * Get cost
     *
     * @return integer 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set tahvilhour
     *
     * @param integer $tahvilhour
     * @return Bread
     */
    public function setTahvilhour($tahvilhour)
    {
        $this->tahvilhour = $tahvilhour;
    
        return $this;
    }

    /**
     * Get tahvilhour
     *
     * @return integer 
     */
    public function getTahvilhour()
    {
        return $this->tahvilhour;
    }

    /**
     * Set rezervday
     *
     * @param integer $rezervday
     * @return Bread
     */
    public function setRezervday($rezervday)
    {
        $this->rezervday = $rezervday;
    
        return $this;
    }

    /**
     * Get rezervday
     *
     * @return integer 
     */
    public function getRezervday()
    {
        return $this->rezervday;
    }

    /**
     * Set rezervhour
     *
     * @param integer $rezervhour
     * @return Bread
     */
    public function setRezervhour($rezervhour)
    {
        $this->rezervhour = $rezervhour;
    
        return $this;
    }

    /**
     * Get rezervhour
     *
     * @return integer 
     */
    public function getRezervhour()
    {
        return $this->rezervhour;
    }

    /**
     * Set fromdate
     *
     * @param \DateTime $fromdate
     * @return Bread
     */
    public function setFromdate($fromdate)
    {
        $this->fromdate = $fromdate;
    
        return $this;
    }

    /**
     * Get fromdate
     *
     * @return \DateTime 
     */
    public function getFromdate()
    {
        return $this->fromdate;
    }

    /**
     * Set todate
     *
     * @param \DateTime $todate
     * @return Bread
     */
    public function setTodate($todate)
    {
        $this->todate = $todate;
    
        return $this;
    }

    /**
     * Get todate
     *
     * @return \DateTime 
     */
    public function getTodate()
    {
        return $this->todate;
    }

    /**
     * Set maxnum
     *
     * @param integer $maxnum
     * @return Bread
     */
    public function setMaxnum($maxnum)
    {
        $this->maxnum = $maxnum;
    
        return $this;
    }

    /**
     * Get maxnum
     *
     * @return integer 
     */
    public function getMaxnum()
    {
        return $this->maxnum;
    }

    /**
     * Add buy
     *
     * @param \my\Buy $buy
     * @return Bread
     */
    public function addBuy(\my\Buy $buy)
    {
        $this->buy[] = $buy;
    
        return $this;
    }

    /**
     * Remove buy
     *
     * @param \my\Buy $buy
     */
    public function removeBuy(\my\Buy $buy)
    {
        $this->buy->removeElement($buy);
    }

    /**
     * Get buy
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBuy()
    {
        return $this->buy;
    }
}
