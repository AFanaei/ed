<?php

namespace my;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incmon
 */
class Incmon
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $tocken;

    /**
     * @var integer
     */
    private $amount;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $state;

    /**
     * @var \my\User
     */
    private $user;


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
     * Set tocken
     *
     * @param string $tocken
     * @return Incmon
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
     * Set amount
     *
     * @param integer $amount
     * @return Incmon
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Incmon
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Incmon
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
     * Set user
     *
     * @param \my\User $user
     * @return Incmon
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
     * @ORM\PrePersist
     */
    public function setDateValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function setTockenValue()
    {
        // Add your code here
    }
}
