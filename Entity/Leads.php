<?php

namespace Emtags\Bundle\NewsletterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emtags\Bundle\NewsletterBundle\Entity\Leads
 */
class Leads
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $tag;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tag = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Leads
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Leads
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
     * Add tag
     *
     * @param Emtags\Bundle\NewsletterBundle\Entity\Tags $tag
     * @return Leads
     */
    public function addTag(\Emtags\Bundle\NewsletterBundle\Entity\Tags $tag)
    {
        $this->tag[] = $tag;
    
        return $this;
    }

    /**
     * Remove tag
     *
     * @param Emtags\Bundle\NewsletterBundle\Entity\Tags $tag
     */
    public function removeTag(\Emtags\Bundle\NewsletterBundle\Entity\Tags $tag)
    {
        $this->tag->removeElement($tag);
    }

    /**
     * Get tag
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTag()
    {
        return $this->tag;
    }
	
	public function __toString()
	{
	  return $this->getName();
	}
    /**
     * @var \DateTime $lastDispatch
     */
    private $lastDispatch;

    /**
     * @var boolean $enable
     */
    private $enable;


    /**
     * Set lastDispatch
     *
     * @param \DateTime $lastDispatch
     * @return Leads
     */
    public function setLastDispatch($lastDispatch)
    {
        $this->lastDispatch = $lastDispatch;
    
        return $this;
    }

    /**
     * Get lastDispatch
     *
     * @return \DateTime 
     */
    public function getLastDispatch()
    {
        return $this->lastDispatch;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return Leads
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    
        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
    }
}