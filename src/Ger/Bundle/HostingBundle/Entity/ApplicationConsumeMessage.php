<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ApplicationConsumeMessage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\ApplicationConsumeMessageRepository")
 */
class ApplicationConsumeMessage
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var application
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\Application", inversedBy="consume_messages")
     */
    private $application;

    /**
     * @var queue
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\RabbitMQQueue", inversedBy="consumers")
     */
    private $queue;


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
     * Set description
     *
     * @param string $description
     * @return ApplicationConsumeMessage
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
     * Set application
     *
     * @param \Ger\Bundle\HostingBundle\Entity\Application $application
     * @return ApplicationConsumeMessage
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
     * Set queue
     *
     * @param \Ger\Bundle\HostingBundle\Entity\RabbitMQQueue $queue
     * @return ApplicationConsumeMessage
     */
    public function setQueue(\Ger\Bundle\HostingBundle\Entity\RabbitMQQueue $queue = null)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue
     *
     * @return \Ger\Bundle\HostingBundle\Entity\RabbitMQQueue 
     */
    public function getQueue()
    {
        return $this->queue;
    }
}
