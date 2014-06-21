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

        $menu->addChild('Dashboard', array('route' => 'ger_frontend_default_index'))
            ->setAttribute('i-class', 'icon-dashboard icon-2x')
            ->setChildrenAttribute('class', 'collapse')
                ->addChild('Test', array('route' => 'ger_frontend_default_test'))->setAttribute('i-class', 'icon-hand-up');
        $menu->addChild('Dashboard 2', array('route' => 'ger_frontend_default_index'))
            ->setAttribute('i-class', 'icon-dashboard icon-2x');

        return $menu;
    }
}