<?php

namespace Ger\Bundle\HostingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Ger\Bundle\HostingBundle\Entity\CachingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CacheTypeController
 * @package Ger\Bundle\HostingBundle\Controller
 * @NamePrefix("api_cachingtypes_")
 */
class CachingTypeController extends AbstractController
{

    /**
     * @Template("@GerHosting/CachingType/list.html.twig")
     */
    public function getCachingTypesAction()
    {
        $cachingtype = new CachingType();
        $form = $this->createForm('ger_hosting_cachingtype', $cachingtype);
        $cachingtypes = $this->getCachingTypeRepository()->findAll();
        return array(
            'cachingtypes' => $cachingtypes,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_cachingtypes_post_caching_types'),
            'type' => 'creation'
        );
    }


    /**
     * @Template("@GerHosting/CachingType/list.html.twig")
     */
    public function postCachingTypesAction(Request $request)
    {
        $cachingtype = new CachingType();
        $form = $this->createForm('ger_hosting_cachingtype', $cachingtype);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->persist($cachingtype);
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($cachingtype);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "Le Type de Cache a bien été crée");
                return new RedirectResponse($this->get('router')->generate('api_cachingtypes_get_caching_types'));
            }
        }
        $cachingtypes = $this->getCachingTypeRepository()->findAll();
        return array(
            'cachingtypes' => $cachingtypes,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_cachingtypes_post_caching_types'),
            'type' => 'creation',
        );
    }


    public function getDeleteCachingTypeAction($id)
    {
        $cachingtype = $this->getCachingTypeRepository()->find($id);
        if($cachingtype) {
            $this->getEntityManager()->remove($cachingtype);
                $this->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->add("notice", "Le Type de Cache a bien été supprimée");
        }
        return new RedirectResponse($this->get('router')->generate('api_cachingtypes_get_caching_types'));
    }

    /**
     * @param $id
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/CachingType/list.html.twig")
     */
    public function getEditCachingTypeAction($id)
    {
        $cachingtype = $this->getCachingTypeRepository()->find($id);
        if(!$cachingtype) {
            throw new NotFoundHttpException('Type de Cache non trouvée');
        }
        $form = $this->createForm('ger_hosting_cachingtype', $cachingtype);
        $cachingtypes = $this->getCachingTypeRepository()->findAll();
        return array(
            'cachingtypes' => $cachingtypes,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_cachingtypes_post_update_caching_types', array('id' => $id)),
            'type' => 'edition'
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/CachingType/list.html.twig")
     */
    public function postUpdateCachingTypesAction(Request $request, $id)
    {
        $cachingtype = $this->getCachingTypeRepository()->find($id);
        if(!$cachingtype) {
            throw new NotFoundHttpException('Type de Cache non trouvée');
        }
        $form = $this->createForm('ger_hosting_cachingtype', $cachingtype);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($cachingtype);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "Le Type de Cache a bien été sauvegardée");
                return new RedirectResponse($this->get('router')->generate('api_cachingtypes_get_caching_types'));
            }
        }
        $cachingtypes = $this->getCachingTypeRepository()->findAll();
        return array(
            'cachingtypes' => $cachingtypes,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_cachingtypes_post_update_caching_types', array('id' => $id)),
            'type' => 'creation'
        );
    }

}
