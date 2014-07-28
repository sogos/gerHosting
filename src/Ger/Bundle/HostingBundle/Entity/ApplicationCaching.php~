<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * ApplicationCaching
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\ApplicationCachingRepository")
 */
class ApplicationCaching
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
     * @var application
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\Application", inversedBy="caching_mechanisms")
     */
    private $application;

    /**
     * @var type
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\CachingType", inversedBy="applications_caching")
     */
    private $type;

    /**
     * @var resolve_ssi;
     * @ORM\Column(name="resolve_ssi", type="boolean", nullable=false)
     */
    private $resolve_ssi;

    /**
     * @var description
     * @NotBlank()
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * Set application
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Application $application
     * @return ApplicationCaching
     */
    public function setApplication(\Ger\Bundle\HostingBundle\Entity\Application $application = null)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Get application
     *
     * @return \Ger\Bundle\HostingBundle\Entity\Application 
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Set resolve_ssi
     *
     * @param boolean $resolveSsi
     * @return ApplicationCaching
     */
    public function setResolveSsi($resolveSsi)
    {
        $this->resolve_ssi = $resolveSsi;

        return $this;
    }



    /**
     * Get resolve_ssi
     *
     * @return boolean 
     */
    public function getResolveSsi()
    {
        return $this->resolve_ssi;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ApplicationCaching
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param \Ger\Bundle\HostingBundle\Entity\CachingType $type
     * @return ApplicationCaching
     */
    public function setType(\Ger\Bundle\HostingBundle\Entity\CachingType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Ger\Bundle\HostingBundle\Entity\CachingType 
     */
    public function getType()
    {
        return $this->type;
    }
}
