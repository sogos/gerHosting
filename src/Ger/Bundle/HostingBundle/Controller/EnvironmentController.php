<?php

namespace Ger\Bundle\HostingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Ger\Bundle\HostingBundle\Entity\Environment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_environments_post_environments')
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
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_environments_post_environments')
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

    /**
     * @param $id
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/Environment/list.html.twig")
     */
    public function getEditEnvironmentAction($id)
    {
        $environment = $this->getEnvironmentRepository()->find($id);
        if(!$environment) {
            throw new NotFoundHttpException('Environment non trouvé');
        }
        $form = $this->createForm('ger_hosting_environment', $environment);
        $environments = $this->getEnvironmentRepository()->findAll();
        return array(
            'environments' => $environments,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_environments_post_update_environments', array('id' => $id))
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/Environment/list.html.twig")
     */
    public function postUpdateEnvironmentsAction(Request $request, $id)
    {
        $environment = $this->getEnvironmentRepository()->find($id);
        if(!$environment) {
            throw new NotFoundHttpException('Environment non trouvé');
        }
        $form = $this->createForm('ger_hosting_environment', $environment);
        $form->handleRequest($request);
        if($form->isValid()) {
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
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_environments_post_update_environments', array('id' => $id))
        );
    }

}
