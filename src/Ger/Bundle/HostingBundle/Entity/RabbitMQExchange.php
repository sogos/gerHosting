<?php

namespace Ger\Bundle\HostingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RabbitMQExchange
 *
 * @ORM\Table()
 * @UniqueEntity("name")
 * @ORM\Entity(repositoryClass="Ger\Bundle\HostingBundle\Entity\RabbitMQExchangeRepository")
 */
class RabbitMQExchange
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @NotBlank()
     *
     */
    private $name;

    /**
     * @var producers
     * @ORM\OneToMany(targetEntity="Ger\Bundle\HostingBundle\Entity\ApplicationProduceMessage", mappedBy="exchange", orphanRemoval=true)
     */
    private $producers;

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
     * @return RabbitMQExchange
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
        $this->producers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add producers
     *
     * @param \Ger\Bundle\HostingBundle\Entity\ApplicationProduceMessage $producers
     * @return RabbitMQExchange
     */
    public function addProducer(\Ger\Bundle\HostingBundle\Entity\ApplicationProduceMessage $producers)
    {
        $this->producers[] = $producers;

        return $this;
    }

    /**
     * Remove producers
     *
     * @param \Ger\Bundle\HostingBundle\Entity\ApplicationProduceMessage $producers
     */
    public function removeProducer(\Ger\Bundle\HostingBundle\Entity\ApplicationProduceMessage $producers)
    {
        $this->producers->removeElement($producers);
    }

    /**
     * Get producers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducers()
    {
        return $this->producers;
    }
}
