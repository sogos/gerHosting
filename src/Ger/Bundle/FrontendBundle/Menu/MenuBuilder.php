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
        $menu->addChild('Dashboard', array('uri' => '#' .$uniqid))
            ->setAttribute('href', '#' .$uniqid)
            ->setAttribute('i-class', 'icon-dashboard icon-2x')
            ->setAttribute('class', 'dark-nav')
            ->setChildrenAttribute('class', 'collapse')
             ->setChildrenAttribute('id', $uniqid)
                ->addChild('Test', array('route' => 'ger_frontend_default_test'))
                    ->setAttribute('i-class', 'icon-hand-up');
        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'))
            ->setAttribute('i-class', 'icon-user icon-2x');

        return $menu;
    }
}