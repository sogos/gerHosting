<?php
/**
 * Created by PhpStorm.
 * User: tcordier
 * Date: 21/06/14
 * Time: 14:53
 */

namespace Ger\Bundle\FrontendBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('class' => 'nav navbar-collapse collapse navbar-collapse-primary')));
        $uniqid = uniqid();
        $menu->addChild('Configuration', array('uri' => '#' . $uniqid))
            ->setAttribute('href', '#' . $uniqid)
            ->setAttribute('i-class', 'icon-stethoscope')
            ->setAttribute('class', 'dark-nav')
            ->setChildrenAttribute('class', 'collapse')
            ->setChildrenAttribute('id', $uniqid)
            ->addChild('Environnements', array('route' => 'api_environments_get_environments'))
            ->setAttribute('i-class', 'icon-picture');
        $menu['Configuration']->addChild('Autorités', array('route' => 'api_authorities_get_authorities'))
            ->setAttribute('i-class', 'icon-legal');
        $menu['Configuration']->addChild('Applications', array('route' => 'api_applications_get_applications'))
            ->setAttribute('i-class', 'icon-bar-chart');
        $menu['Configuration']->addChild('Types de BDD', array('route' => 'api_databasetypes_get_database_types'))
            ->setAttribute('i-class', 'icon-tasks');
        $menu['Configuration']->addChild('Types de Cache', array('route' => 'api_cachingtypes_get_caching_types'))
            ->setAttribute('i-class', 'icon-certificate');
        $menu['Configuration']->addChild('Exchanges RabbitMQ', array('route' => 'api_rabbitmqexchanges_get_rabbit_m_q_exchange'))
            ->setAttribute('i-class', 'icon-exchange');
        $menu['Configuration']->addChild('Queues RabbitMQ', array('route' => 'api_rabbitmqqueues_get_rabbit_m_q_queue'))
            ->setAttribute('i-class', 'icon-envelope');

        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'))
            ->setAttribute('i-class', 'icon-user');

        return $menu;
    }
}