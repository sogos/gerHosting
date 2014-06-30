<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Host
 *
 * @ORM\Table("hosts")
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\HostRepository")
 */
class Host
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
     * @var string
     *
     * @ORM\Column(name="public_ip", type="string", length=255)
     */
    private $publicIp;


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
     * @return Host
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
     * Set publicIp
     *
     * @param string $publicIp
     * @return Host
     */
    public function setPublicIp($publicIp)
    {
        $this->publicIp = $publicIp;

        return $this;
    }

    /**
     * Get publicIp
     *
     * @return string 
     */
    public function getPublicIp()
    {
        return $this->publicIp;
    }
}
