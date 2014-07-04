<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * ApplicationDatabase
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\ApplicationDatabaseRepository")
 */
class ApplicationDatabase
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
     * @NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @var description
     * @NotBlank()
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var application
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\Application", inversedBy="require_databases")
     */
    private $application;
    /**
     * @var type
     * @NotNull()
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\DatabaseType", inversedBy="applications_database")
     */
    private $type;

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
     * @return ApplicationDatabase
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
     * Set application
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Application $application
     * @return ApplicationDatabase
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
     * Set type
     *
     * @param \Ger\Bundle\HostingBundle\Entity\DatabaseType $type
     * @return ApplicationDatabase
     */
    public function setType(\Ger\Bundle\HostingBundle\Entity\DatabaseType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Ger\Bundle\HostingBundle\Entity\DatabaseType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ApplicationDatabase
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
}
