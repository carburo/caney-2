<?php
/**
 * Created by PhpStorm.
 * User: rmartinez
 * Date: 29/08/16
 * Time: 22:28
 */

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class HostelMenuBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options): ItemInterface {
        $menu = $factory->createItem("root");
        $menu->setChildrenAttribute('class', 'nav nav-sidebar');

        $translator = $this->container->get('translator');

        $menu->addChild($translator->trans('general'), [
            'route' => 'fos_user_security_login'
        ]);

        $menu->addChild($translator->trans('services'), [
            'route' => 'fos_user_security_login'
        ]);

        $menu->addChild($translator->trans('pictures'), [
            'route' => 'fos_user_security_login'
        ]);

        return $menu;
    }

}