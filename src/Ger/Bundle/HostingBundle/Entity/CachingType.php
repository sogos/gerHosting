<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CachingType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\CachingTypeRepository")
 */
class CachingType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var application_caching
     * @ORM\OneToMany(targetEntity="Ger\Bundle\HostingBundle\Entity\ApplicationCaching", mappedBy="type", cascade={"PERSIST", "REMOVE"}, orphanRemoval=true)
     */
    private $applications_caching;

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
     * @return CachingType
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
     * Constructor
     */
    public function __construct()
    {
        $this->applications_caching = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add applications_caching
     *
     * @param \Ger\Bundle\HostingBundle\Entity\ApplicationCaching $applicationsCaching
     * @return CachingType
     */
    public function addApplicationsCaching(\Ger\Bundle\HostingBundle\Entity\ApplicationCaching $applicationsCaching)
    {
        $this->applications_caching[] = $applicationsCaching;

        return $this;
    }

    /**
     * Remove applications_caching
     *
     * @param \Ger\Bundle\HostingBundle\Entity\ApplicationCaching $applicationsCaching
     */
    public function removeApplicationsCaching(\Ger\Bundle\HostingBundle\Entity\ApplicationCaching $applicationsCaching)
    {
        $this->applications_caching->removeElement($applicationsCaching);
    }

    /**
     * Get applications_caching
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getApplicationsCaching()
    {
        return $this->applications_caching;
    }
}
