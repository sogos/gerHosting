<?php

namespace Ger\Bundle\HostingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Ger\Bundle\HostingBundle\Entity\Environment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EnvironmentController
 * @package Ger\Bundle\HostingBundle\Controller
 * @NamePrefix("api_environments_")
 */
class EnvironmentController extends AbstractController
{


    /**
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


    /**
     * @Template("@GerHosting/Environment/list.html.twig")
     */
    public function postEnvironmentsAction(Request $request)
    {
        $environment = new Environment();
        $form = $this->createForm('ger_hosting_environment', $environment);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->persist($environment);
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($environment);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "Your changes were saved!");
                return new RedirectResponse($this->get('router')->generate('api_environments_get_environments'));
            }
        }
        $environments = $this->getEnvironmentRepository()->findAll();
        return array(
            'environments' => $environments,
            'form' => $form->createView()
        );
    }


    public function getDeleteEnvironmentAction($id)
    {
        $environment = $this->getEnvironmentRepository()->find($id);
        if($environment) {
            $this->getEntityManager()->remove($environment);
                $this->getEntityManager()->flush();
        }
        return new RedirectResponse($this->get('router')->generate('api_environments_get_environments'));
    }
}
