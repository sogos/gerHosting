<?php

namespace Ger\Bundle\HostingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Ger\Bundle\HostingBundle\Entity\DatabaseType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class DatabaseTypeController
 * @package Ger\Bundle\HostingBundle\Controller
 * @NamePrefix("api_databasetypes_")
 */
class DatabaseTypeController extends AbstractController
{

    /**
     * @Template("@GerHosting/DatabaseType/list.html.twig")
     */
    public function getDatabaseTypesAction()
    {
        $databasetype = new DatabaseType();
        $form = $this->createForm('ger_hosting_databasetype', $databasetype);
        $databasetypes = $this->getDatabaseTypeRepository()->findAll();
        return array(
            'databasetypes' => $databasetypes,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_databasetypes_post_database_types'),
            'type' => 'creation'
        );
    }


    /**
     * @Template("@GerHosting/DatabaseType/list.html.twig")
     */
    public function postDatabaseTypesAction(Request $request)
    {
        $databasetype = new DatabaseType();
        $form = $this->createForm('ger_hosting_databasetype', $databasetype);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->persist($databasetype);
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($databasetype);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "Le Type de Base de donnée a bien été crée");
                return new RedirectResponse($this->get('router')->generate('api_databasetypes_get_database_types'));
            }
        }
        $databasetypes = $this->getDatabaseTypeRepository()->findAll();
        return array(
            'databasetypes' => $databasetypes,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_databasetypes_post_database_types'),
            'type' => 'creation',
        );
    }


    public function getDeleteDatabaseTypeAction($id)
    {
        $databasetype = $this->getDatabaseTypeRepository()->find($id);
        if($databasetype) {
            $this->getEntityManager()->remove($databasetype);
                $this->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->add("notice", "Le Type de Base de donnée a bien été supprimée");
        }
        return new RedirectResponse($this->get('router')->generate('api_databasetypes_get_database_types'));
    }

    /**
     * @param $id
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/DatabaseType/list.html.twig")
     */
    public function getEditDatabaseTypeAction($id)
    {
        $databasetype = $this->getDatabaseTypeRepository()->find($id);
        if(!$databasetype) {
            throw new NotFoundHttpException('Type de Base de donnée non trouvée');
        }
        $form = $this->createForm('ger_hosting_databasetype', $databasetype);
        $databasetypes = $this->getDatabaseTypeRepository()->findAll();
        return array(
            'databasetypes' => $databasetypes,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_databasetypes_post_update_database_types', array('id' => $id)),
            'type' => 'edition'
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/DatabaseType/list.html.twig")
     */
    public function postUpdateDatabaseTypesAction(Request $request, $id)
    {
        $databasetype = $this->getDatabaseTypeRepository()->find($id);
        if(!$databasetype) {
            throw new NotFoundHttpException('Type de Base de donnée non trouvée');
        }
        $form = $this->createForm('ger_hosting_databasetype', $databasetype);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($databasetype);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "Le Type de Base de donnée a bien été sauvegardée");
                return new RedirectResponse($this->get('router')->generate('api_databasetypes_get_database_types'));
            }
        }
        $databasetypes = $this->getDatabaseTypeRepository()->findAll();
        return array(
            'databasetypes' => $databasetypes,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_databasetypes_post_update_database_types', array('id' => $id)),
            'type' => 'creation'
        );
    }

}
