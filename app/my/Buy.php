<?php

namespace my;

use Doctrine\ORM\Mapping as ORM;

/**
 * Buy
 */
class Buy
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $tahvil_date;

    /**
     * @var integer
     */
    private $number;

    /**
     * @var string
     */
    private $tocken;

    /**
     * @var integer
     */
    private $cost;

    /**
     * @var integer
     */
    private $state;

    /**
     * @var \DateTime
     */
    private $kharid_date;

    /**
     * @var \my\User
     */
    private $user;

    /**
     * @var \my\Bread
     */
    private $bread;


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
     * Set tahvil_date
     *
     * @param \DateTime $tahvilDate
     * @return Buy
     */
    public function setTahvilDate($tahvilDate)
    {
        $this->tahvil_date = $tahvilDate;
    
        return $this;
    }

    /**
     * Get tahvil_date
     *
     * @return \DateTime 
     */
    public function getTahvilDate()
    {
        return $this->tahvil_date;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Buy
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set tocken
     *
     * @param string $tocken
     * @return Buy
     */
    public function setTocken($tocken)
    {
        $this->tocken = $tocken;
    
        return $this;
    }

    /**
     * Get tocken
     *
     * @return string 
     */
    public function getTocken()
    {
        return $this->tocken;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     * @return Buy
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
     * Set state
     *
     * @param integer $state
     * @return Buy
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set kharid_date
     *
     * @param \DateTime $kharidDate
     * @return Buy
     */
    public function setKharidDate($kharidDate)
    {
        $this->kharid_date = $kharidDate;
    
        return $this;
    }

    /**
     * Get kharid_date
     *
     * @return \DateTime 
     */
    public function getKharidDate()
    {
        return $this->kharid_date;
    }

    /**
     * Set user
     *
     * @param \my\User $user
     * @return Buy
     */
    public function setUser(\my\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \my\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set bread
     *
     * @param \my\Bread $bread
     * @return Buy
     */
    public function setBread(\my\Bread $bread = null)
    {
        $this->bread = $bread;
    
        return $this;
    }

    /**
     * Get bread
     *
     * @return \my\Bread 
     */
    public function getBread()
    {
        return $this->bread;
    }
    /**
     * @ORM\PrePersist
     */
    public function setKharidDateAtValue()
    {
        // Add your code here
    }
}
