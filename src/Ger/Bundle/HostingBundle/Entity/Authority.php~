<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Authority
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\AuthorityRepository")
 */
class Authority
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
     * @var environments
     * @ORM\OneToMany(targetEntity="Ger\Bundle\HostingBundle\Entity\Environment", mappedBy="authority", cascade={"persist"})
     */
    private $environments;

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
     * @return Authority
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
        $this->environments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add environments
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Environment $environments
     * @return Authority
     */
    public function addEnvironment(\Ger\Bundle\HostingBundle\Entity\Environment $environments)
    {
        $this->environments[] = $environments;

        return $this;
    }

    /**
     * Remove environments
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Environment $environments
     */
    public function removeEnvironment(\Ger\Bundle\HostingBundle\Entity\Environment $environments)
    {
        $this->environments->removeElement($environments);
    }

    /**
     * Get environments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnvironments()
    {
        return $this->environments;
    }
}
