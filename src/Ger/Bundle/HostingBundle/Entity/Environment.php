<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Environment
 * @UniqueEntity("name")
 * @ORM\Table("environments")
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\EnvironmentRepository")
 */
class Environment
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
     * @var description
     *
     * @ORM\Column(name="description", type="text")
     * @NotBlank()
     */
    private $description;

    /**
     * @var authority
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\Authority", inversedBy="Environments")
     * @NotNull()
     */
    private $authority;

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
     * @return Environment
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
     * Set description
     *
     * @param string $description
     * @return Environment
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
     * Set authority
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Authority $authority
     * @return Environment
     */
    public function setAuthority(\Ger\Bundle\HostingBundle\Entity\Authority $authority = null)
    {
        $this->authority = $authority;

        return $this;
    }

    /**
     * Get authority
     *
     * @return \Ger\Bundle\HostingBundle\Entity\Authority 
     */
    public function getAuthority()
    {
        return $this->authority;
    }
}
