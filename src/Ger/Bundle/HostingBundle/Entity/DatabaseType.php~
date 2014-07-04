<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatabaseType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\DatabaseTypeRepository")
 */
class DatabaseType
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
     * @var applications_database
     * @ORM\OneToMany(targetEntity="Ger\Bundle\HostingBundle\Entity\ApplicationDatabase", mappedBy="type")
     */
    private $applications_database;

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
     * @return DatabaseType
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
        $this->applications_database = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add applications_database
     *
     * @param \Ger\Bundle\HostingBundle\Entity\ApplicationDatabase $applicationsDatabase
     * @return DatabaseType
     */
    public function addApplicationsDatabase(\Ger\Bundle\HostingBundle\Entity\ApplicationDatabase $applicationsDatabase)
    {
        $this->applications_database[] = $applicationsDatabase;

        return $this;
    }

    /**
     * Remove applications_database
     *
     * @param \Ger\Bundle\HostingBundle\Entity\ApplicationDatabase $applicationsDatabase
     */
    public function removeApplicationsDatabase(\Ger\Bundle\HostingBundle\Entity\ApplicationDatabase $applicationsDatabase)
    {
        $this->applications_database->removeElement($applicationsDatabase);
    }

    /**
     * Get applications_database
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getApplicationsDatabase()
    {
        return $this->applications_database;
    }
}
