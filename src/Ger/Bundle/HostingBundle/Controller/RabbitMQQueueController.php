<?php

namespace Ger\Bundle\HostingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Ger\Bundle\HostingBundle\Entity\RabbitMQQueue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RabbitMQQueueController
 * @package Ger\Bundle\HostingBundle\Controller
 * @NamePrefix("api_rabbitmqqueues_")
 */
class RabbitMQQueueController extends AbstractController
{

    /**
     * @Template("@GerHosting/RabbitMQQueue/list.html.twig")
     */
    public function getRabbitMQQueueAction()
    {
        $rabbitmqqueue = new RabbitMQQueue();
        $form = $this->createForm('ger_hosting_rabbitmqqueue', $rabbitmqqueue);
        $rabbitmqqueues = $this->getRabbitMQQueueRepository()->findAll();
        return array(
            'rabbitmqqueues' => $rabbitmqqueues,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_rabbitmqqueues_post_rabbit_m_q_queue'),
            'type' => 'creation'
        );
    }


    /**
     * @Template("@GerHosting/RabbitMQQueue/list.html.twig")
     */
    public function postRabbitMQQueueAction(Request $request)
    {
        $rabbitmqqueue = new RabbitMQQueue();
        $form = $this->createForm('ger_hosting_rabbitmqqueue', $rabbitmqqueue);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->persist($rabbitmqqueue);
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($rabbitmqqueue);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "La Queue RabbitMQ a bien été créée");
                return new RedirectResponse($this->get('router')->generate('api_rabbitmqqueues_get_rabbit_m_q_queue'));
            }
        }
        $rabbitmqqueues = $this->getRabbitMQQueueRepository()->findAll();
        return array(
            'rabbitmqqueues' => $rabbitmqqueues,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_rabbitmqqueues_post_rabbit_m_q_queue'),
            'type' => 'creation',
        );
    }


    public function getDeleteRabbitMQQueueAction($id)
    {
        $rabbitmqqueue = $this->getRabbitMQQueueRepository()->find($id);
        if($rabbitmqqueue) {
            $this->getEntityManager()->remove($rabbitmqqueue);
                $this->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->add("notice", "La Queue RabbitMQ a bien été supprimée");
        }
        return new RedirectResponse($this->get('router')->generate('api_rabbitmqqueues_get_rabbit_m_q_queue'));
    }

    /**
     * @param $id
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/RabbitMQQueue/list.html.twig")
     */
    public function getEditRabbitMQQueueAction($id)
    {
        $rabbitmqqueue = $this->getRabbitMQQueueRepository()->find($id);
        if(!$rabbitmqqueue) {
            throw new NotFoundHttpException('Emetteur RabbitMQ non trouvée');
        }
        $form = $this->createForm('ger_hosting_rabbitmqqueue', $rabbitmqqueue);
        $rabbitmqqueues = $this->getRabbitMQQueueRepository()->findAll();
        return array(
            'rabbitmqqueues' => $rabbitmqqueues,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_rabbitmqqueues_post_update_rabbit_m_q_queue', array('id' => $id)),
            'type' => 'edition'
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/RabbitMQQueue/list.html.twig")
     */
    public function postUpdateRabbitMQQueueAction(Request $request, $id)
    {
        $rabbitmqqueue = $this->getRabbitMQQueueRepository()->find($id);
        if(!$rabbitmqqueue) {
            throw new NotFoundHttpException('Emetteur RabbitMQ non trouvée');
        }
        $form = $this->createForm('ger_hosting_rabbitmqqueue', $rabbitmqqueue);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($rabbitmqqueue);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "La Queue RabbitMQ a bien été sauvegardée");
                return new RedirectResponse($this->get('router')->generate('api_rabbitmqqueues_get_rabbit_m_q_queue'));
            }
        }
        $rabbitmqqueues = $this->getRabbitMQQueueRepository()->findAll();
        return array(
            'rabbitmqqueues' => $rabbitmqqueues,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_rabbitmqqueues_post_update_rabbit_m_q_queue', array('id' => $id)),
            'type' => 'creation'
        );
    }

}
