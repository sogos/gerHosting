<?php


namespace Ger\Bundle\HostingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AbstractController  extends Controller {

    /**
     * @return object
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
} 