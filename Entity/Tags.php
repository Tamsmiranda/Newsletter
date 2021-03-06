<?php

namespace Emtags\Bundle\NewsletterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emtags\Bundle\NewsletterBundle\Entity\Tags
 */
class Tags
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $lead;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lead = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tags
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
     * Add lead
     *
     * @param Emtags\Bundle\NewsletterBundle\Entity\Leads $lead
     * @return Tags
     */
    public function addLead(\Emtags\Bundle\NewsletterBundle\Entity\Leads $lead)
    {
        $this->lead[] = $lead;
    
        return $this;
    }

    /**
     * Remove lead
     *
     * @param Emtags\Bundle\NewsletterBundle\Entity\Leads $lead
     */
    public function removeLead(\Emtags\Bundle\NewsletterBundle\Entity\Leads $lead)
    {
        $this->lead->removeElement($lead);
    }

    /**
     * Get lead
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLead()
    {
        return $this->lead;
    }
	
	public function __toString()
	{
	  return $this->getName();
	}
}