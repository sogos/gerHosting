<?php


namespace Ger\Bundle\HostingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AbstractController  extends Controller {

    /**
     * @inheritdoc
     */
    public function getEntityManager() {
        return $this->get('doctrine')->getManager();
    }

    /**
     * @return mixed
     */
    public function getEnvironmentRepository() {
        return $this->getEntityManager()->getRepository('GerHostingBundle:Environment');
    }

    /**
     * @return mixed
     */
    public function getAuthorityRepository() {
        return $this->getEntityManager()->getRepository('GerHostingBundle:Authority');
    }

    /**
     * @return mixed
     */
    public function getApplicationRepository() {
        return $this->getEntityManager()->getRepository('GerHostingBundle:Application');
    }

    /**
     * @return mixed
     */
    public function getDatabaseTypeRepository() {
        return $this->getEntityManager()->getRepository('GerHostingBundle:DatabaseType');
    }

    /**
     * @return mixed
     */
    public function getCachingTypeRepository() {
        return $this->getEntityManager()->getRepository('GerHostingBundle:CachingType');
    }

    /**
     * @return mixed
     */
    public function getRabbitMQExchangeRepository() {
        return $this->getEntityManager()->getRepository('GerHostingBundle:RabbitMQExchange');
    }

    /**
     * @return mixed
     */
    public function getRabbitMQQueueRepository() {
        return $this->getEntityManager()->getRepository('GerHostingBundle:RabbitMQQueue');
    }
} 