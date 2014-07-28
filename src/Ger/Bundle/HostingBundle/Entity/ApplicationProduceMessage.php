<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * ApplicationProduceMessage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\ApplicationProduceMessageRepository")
 */
class ApplicationProduceMessage
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
     * @NotBlank()
     */
    private $description;

    /**
     * @var application
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\Application", inversedBy="produce_messages")
     * @NotNull()
     */
    private $application;

    /**
     * @var exchange
     * @ORM\ManyToOne(targetEntity="Ger\Bundle\HostingBundle\Entity\RabbitMQExchange", inversedBy="producers")
     * @NotNull()
     */
    private $exchange;

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
     * @return ApplicationProduceMessage
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
     * @return ApplicationProduceMessage
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
     * Set exchange
     *
     * @param \Ger\Bundle\HostingBundle\Entity\RabbitMQExchange $exchange
     * @return ApplicationProduceMessage
     */
    public function setExchange(\Ger\Bundle\HostingBundle\Entity\RabbitMQExchange $exchange = null)
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * Get exchange
     *
     * @return \Ger\Bundle\HostingBundle\Entity\RabbitMQExchange 
     */
    public function getExchange()
    {
        return $this->exchange;
    }
}
