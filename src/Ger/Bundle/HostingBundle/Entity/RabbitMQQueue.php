<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RabbitMQQueue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\RabbitMQQueueRepository")
 */
class RabbitMQQueue
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
     * @var consumers
     * @ORM\OneToMany(targetEntity="Ger\Bundle\HostingBundle\Entity\ApplicationConsumeMessage", mappedBy="queue", orphanRemoval=true)
     */
    private $consumers;

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
     * @return RabbitMQQueue
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
        $this->consumers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add consumers
     *
     * @param \Ger\Bundle\HostingBundle\Entity\ApplicationConsumeMessage $consumers
     * @return RabbitMQQueue
     */
    public function addConsumer(\Ger\Bundle\HostingBundle\Entity\ApplicationConsumeMessage $consumers)
    {
        $this->consumers[] = $consumers;

        return $this;
    }

    /**
     * Remove consumers
     *
     * @param \Ger\Bundle\HostingBundle\Entity\ApplicationConsumeMessage $consumers
     */
    public function removeConsumer(\Ger\Bundle\HostingBundle\Entity\ApplicationConsumeMessage $consumers)
    {
        $this->consumers->removeElement($consumers);
    }

    /**
     * Get consumers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConsumers()
    {
        return $this->consumers;
    }
}
