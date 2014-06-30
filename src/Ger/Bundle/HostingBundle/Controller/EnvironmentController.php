<?php

namespace Ger\Bundle\HostingBundle\Controller;

use Ger\Bundle\HostingBundle\Entity\Environment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class EnvironmentController extends AbstractController
{
    /**
     * @Route("/environments/")
     * @Template("@GerHosting/Environment/list.html.twig")
     */
    public function getEnvironmentsAction()
    {
        $environment = new Environment();
        $form = $this->createForm('ger_hosting_environment', $environment);
        $environments = $this->getEnvironmentRepository()->findAll();
        return array(
            'environments' => $environments,
            'form' => $form->createView()
        );
    }

}
