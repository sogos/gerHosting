<?php

namespace Ger\Bundle\HostingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Ger\Bundle\HostingBundle\Entity\Authority;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AuthorityController
 * @package Ger\Bundle\HostingBundle\Controller
 * @NamePrefix("api_authorities_")
 */
class AuthorityController extends AbstractController
{


    /**
     * @Template("@GerHosting/Authority/list.html.twig")
     */
    public function getAuthoritiesAction()
    {
        $authority = new Authority();
        $form = $this->createForm('ger_hosting_authority', $authority);
        $authorities = $this->getAuthorityRepository()->findAll();
        return array(
            'authorities' => $authorities,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_authorities_post_authorities'),
            'type' => 'creation'
        );
    }


    /**
     * @Template("@GerHosting/Authority/list.html.twig")
     */
    public function postAuthoritiesAction(Request $request)
    {
        $authority = new Authority();
        $form = $this->createForm('ger_hosting_authority', $authority);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->persist($authority);
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($authority);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "L'autorité a bien été crée");
                return new RedirectResponse($this->get('router')->generate('api_authorities_get_authorities'));
            }
        }
        $authorities = $this->getAuthorityRepository()->findAll();
        return array(
            'authorities' => $authorities,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_authorities_post_authorities'),
            'type' => 'creation',
        );
    }


    public function getDeleteAuthorityAction($id)
    {
        $authority = $this->getAuthorityRepository()->find($id);
        if($authority) {
            $this->getEntityManager()->remove($authority);
                $this->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->add("notice", "L'autorité a bien été supprimée");
        }
        return new RedirectResponse($this->get('router')->generate('api_authorities_get_authorities'));
    }

    /**
     * @param $id
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/Authority/list.html.twig")
     */
    public function getEditAuthorityAction($id)
    {
        $authority = $this->getAuthorityRepository()->find($id);
        if(!$authority) {
            throw new NotFoundHttpException('Autorité non trouvée');
        }
        $form = $this->createForm('ger_hosting_authority', $authority);
        $authorities = $this->getAuthorityRepository()->findAll();
        return array(
            'authorities' => $authorities,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_authorities_post_update_authorities', array('id' => $id)),
            'type' => 'edition'
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/Authority/list.html.twig")
     */
    public function postUpdateAuthoritiesAction(Request $request, $id)
    {
        $authority = $this->getAuthorityRepository()->find($id);
        if(!$authority) {
            throw new NotFoundHttpException('Autorité non trouvée');
        }
        $form = $this->createForm('ger_hosting_authority', $authority);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($authority);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "L'autorité a bien été sauvegardée");
                return new RedirectResponse($this->get('router')->generate('api_authorities_get_authorities'));
            }
        }
        $authorities = $this->getAuthorityRepository()->findAll();
        return array(
            'authorities' => $authorities,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_authorities_post_update_authorities', array('id' => $id)),
            'type' => 'creation'
        );
    }

}
