<?php

namespace Ger\Bundle\HostingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Ger\Bundle\HostingBundle\Entity\RabbitMQExchange;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class RabbitMQExchangeController
 * @package Ger\Bundle\HostingBundle\Controller
 * @NamePrefix("api_rabbitmqexchanges_")
 */
class RabbitMQExchangeController extends AbstractController
{
    /**
     * @Template("@GerHosting/RabbitMQExchange/list.html.twig")
     */
    public function getRabbitMQExchangeAction()
    {
        $rabbitmqexchange = new RabbitMQExchange();
        $form = $this->createForm('ger_hosting_rabbitmqexchange', $rabbitmqexchange);
        $rabbitmqexchanges = $this->getRabbitMQExchangeRepository()->findAll();
        return array(
            'rabbitmqexchanges' => $rabbitmqexchanges,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_rabbitmqexchanges_post_rabbit_m_q_exchange'),
            'type' => 'creation'
        );
    }


    /**
     * @Template("@GerHosting/RabbitMQExchange/list.html.twig")
     */
    public function postRabbitMQExchangeAction(Request $request)
    {
        $rabbitmqexchange = new RabbitMQExchange();
        $form = $this->createForm('ger_hosting_rabbitmqexchange', $rabbitmqexchange);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->persist($rabbitmqexchange);
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($rabbitmqexchange);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "L'Exchange RabbitMQ a bien été créé");
                return new RedirectResponse($this->get('router')->generate('api_rabbitmqexchanges_get_rabbit_m_q_exchange'));
            }
        }
        $rabbitmqexchanges = $this->getRabbitMQExchangeRepository()->findAll();
        return array(
            'rabbitmqexchanges' => $rabbitmqexchanges,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_rabbitmqexchanges_post_rabbit_m_q_exchange'),
            'type' => 'creation',
        );
    }


    public function getDeleteRabbitMQExchangeAction($id)
    {
        $rabbitmqexchange = $this->getRabbitMQExchangeRepository()->find($id);
        if($rabbitmqexchange) {
            $this->getEntityManager()->remove($rabbitmqexchange);
                $this->getEntityManager()->flush();
                $this->get('session')->getFlashBag()->add("notice", "L'Exchange RabbitMQ a bien été supprimé");
        }
        return new RedirectResponse($this->get('router')->generate('api_rabbitmqexchanges_get_rabbit_m_q_exchange'));
    }

    /**
     * @param $id
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/RabbitMQExchange/list.html.twig")
     */
    public function getEditRabbitMQExchangeAction($id)
    {
        $rabbitmqexchange = $this->getRabbitMQExchangeRepository()->find($id);
        if(!$rabbitmqexchange) {
            throw new NotFoundHttpException('Emetteur RabbitMQ non trouvée');
        }
        $form = $this->createForm('ger_hosting_rabbitmqexchange', $rabbitmqexchange);
        $rabbitmqexchanges = $this->getRabbitMQExchangeRepository()->findAll();
        return array(
            'rabbitmqexchanges' => $rabbitmqexchanges,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_rabbitmqexchanges_post_update_rabbit_m_q_exchange', array('id' => $id)),
            'type' => 'edition'
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @Template("@GerHosting/RabbitMQExchange/list.html.twig")
     */
    public function postUpdateRabbitMQExchangeAction(Request $request, $id)
    {
        $rabbitmqexchange = $this->getRabbitMQExchangeRepository()->find($id);
        if(!$rabbitmqexchange) {
            throw new NotFoundHttpException('Emetteur RabbitMQ non trouvée');
        }
        $form = $this->createForm('ger_hosting_rabbitmqexchange', $rabbitmqexchange);
        $form->handleRequest($request);
        if($form->isValid()) {
            $this->getEntityManager()->flush();
            if($request->getRequestFormat() == 'json') {
                return array($rabbitmqexchange);
            } else {
                $this->get('session')->getFlashBag()->add("notice", "L'Exchange RabbitMQ a bien été sauvegardé");
                return new RedirectResponse($this->get('router')->generate('api_rabbitmqexchanges_get_rabbit_m_q_exchange'));
            }
        }
        $rabbitmqexchanges = $this->getRabbitMQExchangeRepository()->findAll();
        return array(
            'rabbitmqexchanges' => $rabbitmqexchanges,
            'form' => $form->createView(),
            'action' => $this->get('router')->generate('api_rabbitmqexchanges_post_update_rabbit_m_q_exchange', array('id' => $id)),
            'type' => 'creation'
        );
    }

}
