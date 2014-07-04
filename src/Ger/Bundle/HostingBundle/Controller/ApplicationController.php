<?php

namespace Ger\Bundle\HostingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Ger\Bundle\HostingBundle\Entity\Application;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as FosRest;

/**
 * Class ApplicationController
 * @package Ger\Bundle\HostingBundle\Controller
 * @NamePrefix("api_applications_")
 */
class ApplicationController extends AbstractController
{


    /**
     * @Template("@GerHosting/Application/list.html.twig")
     * @FosRest\Route("applications")
     */
    public function getApplicationsAction()
    {
        $application = new Application();
        $form = $this->createForm('ger_hosting_application', $application);
        $applications = $this->getApplicationRepository()->findAll();
        return array(
            'applications' => $applications,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_applications_post_applications'),
            'type' => 'creation'
        );
    }


    /**
     * @Template("@GerHosting/Application/list.html.twig")
     * @FosRest\Route("applications")
     */
    public function postApplicationsAction(Request $request)
    {
        $application = new Application();
        $form = $this->createForm('ger_hosting_application', $application);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->persist($application);
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($application);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "L'application a bien été crée");
                return new RedirectResponse($this->get('router')->generate('api_applications_get_applications'));
            }
        }
        $applications = $this->getApplicationRepository()->findAll();
        return array(
            'applications' => $applications,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_applications_post_applications'),
            'type' => 'creation',
        );
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @FosRest\Route("applications/{id}/delete")
     */
    public function getDeleteApplicationAction($id)
    {
        $application = $this->getApplicationRepository()->find($id);
        if($application) {
            $this->getEntityManager()->remove($application);
                $this->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->add("notice", "L'application a bien été supprimée");
        }
        return new RedirectResponse($this->get('router')->generate('api_applications_get_applications'));
    }

    /**
     * @param $id
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/Application/list.html.twig")
     * @FosRest\Route("applications/{id}/edit")
     */
    public function getEditApplicationAction($id)
    {
        $application = $this->getApplicationRepository()->find($id);
        if(!$application) {
            throw new NotFoundHttpException('Autorité non trouvée');
        }
        $form = $this->createForm('ger_hosting_application', $application);
        $applications = $this->getApplicationRepository()->findAll();
        return array(
            'applications' => $applications,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_applications_post_update_applications', array('id' => $id)),
            'type' => 'edition'
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/Application/list.html.twig")
     * @FosRest\Route("applications/{id}/update")
     */
    public function postUpdateApplicationsAction(Request $request, $id)
    {
        $application = $this->getApplicationRepository()->find($id);
        if(!$application) {
            throw new NotFoundHttpException('Autorité non trouvée');
        }
        $form = $this->createForm('ger_hosting_application', $application);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($application);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "L'application a bien été sauvegardée");
                return new RedirectResponse($this->get('router')->generate('api_applications_get_applications'));
            }
        }
        $applications = $this->getApplicationRepository()->findAll();
        return array(
            'applications' => $applications,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_applications_post_update_applications', array('id' => $id)),
            'type' => 'creation'
        );
    }

}
