<?php

namespace my;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $fname;

    /**
     * @var string
     */
    private $sname;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $address;

    /**
     * @var integer
     */
    private $account;

    /**
     * @var string
     */
    private $building;

    /**
     * @var integer
     */
    private $block;

    /**
     * @var integer
     */
    private $stair;

    /**
     * @var integer
     */
    private $unit;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $buy;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $incmon;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->buy = new \Doctrine\Common\Collections\ArrayCollection();
        $this->incmon = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fname
     *
     * @param string $fname
     * @return User
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    
        return $this;
    }

    /**
     * Get fname
     *
     * @return string 
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set sname
     *
     * @param string $sname
     * @return User
     */
    public function setSname($sname)
    {
        $this->sname = $sname;
    
        return $this;
    }

    /**
     * Get sname
     *
     * @return string 
     */
    public function getSname()
    {
        return $this->sname;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set account
     *
     * @param integer $account
     * @return User
     */
    public function setAccount($account)
    {
        $this->account = $account;
    
        return $this;
    }

    /**
     * Get account
     *
     * @return integer 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set building
     *
     * @param string $building
     * @return User
     */
    public function setBuilding($building)
    {
        $this->building = $building;
    
        return $this;
    }

    /**
     * Get building
     *
     * @return string 
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set block
     *
     * @param integer $block
     * @return User
     */
    public function setBlock($block)
    {
        $this->block = $block;
    
        return $this;
    }

    /**
     * Get block
     *
     * @return integer 
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set stair
     *
     * @param integer $stair
     * @return User
     */
    public function setStair($stair)
    {
        $this->stair = $stair;
    
        return $this;
    }

    /**
     * Get stair
     *
     * @return integer 
     */
    public function getStair()
    {
        return $this->stair;
    }

    /**
     * Set unit
     *
     * @param integer $unit
     * @return User
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    
        return $this;
    }

    /**
     * Get unit
     *
     * @return integer 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Add buy
     *
     * @param \my\Buy $buy
     * @return User
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

    /**
     * Add incmon
     *
     * @param \my\Incmon $incmon
     * @return User
     */
    public function addIncmon(\my\Incmon $incmon)
    {
        $this->incmon[] = $incmon;
    
        return $this;
    }

    /**
     * Remove incmon
     *
     * @param \my\Incmon $incmon
     */
    public function removeIncmon(\my\Incmon $incmon)
    {
        $this->incmon->removeElement($incmon);
    }

    /**
     * Get incmon
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIncmon()
    {
        return $this->incmon;
    }
}
