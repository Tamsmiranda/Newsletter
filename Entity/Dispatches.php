<?php

namespace Emtags\Bundle\NewsletterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emtags\Bundle\NewsletterBundle\Entity\Dispatches
 */
class Dispatches
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var \DateTime $date
     */
    private $date;

    /**
     * @var Emtags\Bundle\NewsletterBundle\Entity\Leads
     */
    private $lead;

    /**
     * @var Emtags\Bundle\NewsletterBundle\Entity\Campaigns
     */
    private $campaign;


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
     * Set date
     *
     * @param \DateTime $date
     * @return Dispatches
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
     * Set lead
     *
     * @param Emtags\Bundle\NewsletterBundle\Entity\Leads $lead
     * @return Dispatches
     */
    public function setLead(\Emtags\Bundle\NewsletterBundle\Entity\Leads $lead = null)
    {
        $this->lead = $lead;
    
        return $this;
    }

    /**
     * Get lead
     *
     * @return Emtags\Bundle\NewsletterBundle\Entity\Leads 
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * Set campaign
     *
     * @param Emtags\Bundle\NewsletterBundle\Entity\Campaigns $campaign
     * @return Dispatches
     */
    public function setCampaign(\Emtags\Bundle\NewsletterBundle\Entity\Campaigns $campaign = null)
    {
        $this->campaign = $campaign;
    
        return $this;
    }

    /**
     * Get campaign
     *
     * @return Emtags\Bundle\NewsletterBundle\Entity\Campaigns 
     */
    public function getCampaign()
    {
        return $this->campaign;
    }
}