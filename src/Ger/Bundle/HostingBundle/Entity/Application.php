<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Application
 *
 * @ORM\Table("applications")
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\ApplicationRepository")
 */
class Application
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
     * @NotBlank()
     */
    private $name;

    /**
     * @var depends_on_applications
     * @ORM\ManyToMany(targetEntity="Ger\Bundle\HostingBundle\Entity\Application", inversedBy="is_required_by_applications")
     * @ORM\JoinTable("applications_depends_applications")
     */
    private $depends_on_applications;

    /**
     * @var is_required_by_applications
     * @ORM\ManyToMany(targetEntity="Ger\Bundle\HostingBundle\Entity\Application", mappedBy="depends_on_applications")
     */
    private $is_required_by_applications;


    /**
     * @var require_databases
     * @ORM\OneToMany(targetEntity="Ger\Bundle\HostingBundle\Entity\ApplicationDatabase", mappedBy="application", cascade={"PERSIST", "REMOVE"}, orphanRemoval=true)
     */
    private $require_databases;

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
     * @return Application
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
        $this->depends_on_applications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->is_required_by_applications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->require_databases = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add depends_on_applications
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Application $dependsOnApplications
     * @return Application
     */
    public function addDependsOnApplication(\Ger\Bundle\HostingBundle\Entity\Application $dependsOnApplications)
    {
        $this->depends_on_applications[] = $dependsOnApplications;

        return $this;
    }

    /**
     * Remove depends_on_applications
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Application $dependsOnApplications
     */
    public function removeDependsOnApplication(\Ger\Bundle\HostingBundle\Entity\Application $dependsOnApplications)
    {
        $this->depends_on_applications->removeElement($dependsOnApplications);
    }

    /**
     * Get depends_on_applications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDependsOnApplications()
    {
        return $this->depends_on_applications;
    }

    /**
     * Add is_required_by_applications
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Application $isRequiredByApplications
     * @return Application
     */
    public function addIsRequiredByApplication(\Ger\Bundle\HostingBundle\Entity\Application $isRequiredByApplications)
    {
        $this->is_required_by_applications[] = $isRequiredByApplications;

        return $this;
    }

    /**
     * Remove is_required_by_applications
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Application $isRequiredByApplications
     */
    public function removeIsRequiredByApplication(\Ger\Bundle\HostingBundle\Entity\Application $isRequiredByApplications)
    {
        $this->is_required_by_applications->removeElement($isRequiredByApplications);
    }

    /**
     * Get is_required_by_applications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIsRequiredByApplications()
    {
        return $this->is_required_by_applications;
    }

    /**
     * Get require_databases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequireDatabases()
    {
        return $this->require_databases;
    }

    /**
     * @param ApplicationDatabase $applicationDatabase
     * @return $this
     */
    public function addRequireDatabase(ApplicationDatabase $applicationDatabase) {
        $this->require_databases[] = $applicationDatabase;
        $applicationDatabase->setApplication($this);
        return $this;
    }

    /**
     * @param ApplicationDatabase $applicationDatabase
     */
    public function removeRequireDatabase(ApplicationDatabase $applicationDatabase) {
        if($this->require_databases->contains($applicationDatabase)) {
           $this->require_databases->removeElement($applicationDatabase);
        }
    }


}
