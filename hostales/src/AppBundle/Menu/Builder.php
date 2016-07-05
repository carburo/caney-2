<?php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('menu.homepage', ['route' => 'homepage']);
        $menu->addChild('menu.hostels', ['route' => 'hostels']);
        $menu->addChild('menu.contact', ['route' => 'contact']);

        $menu->addChild('Register', ['route' => 'hostel_registration']);

//         // access services from the container!
//         $em = $this->container->get('doctrine')->getManager();
//         // findMostRecent and Blog are just imaginary examples
//         $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

//         $menu->addChild('Latest Blog Post', array(
//             'route' => 'blog_show',
//             'routeParameters' => array('id' => $blog->getId())
//         ));

        // create another menu item
//        $menu->addChild('About Me', ['route' => 'contact']);
//        // you can also add sub level's to your menu's as follows
//        $menu['About Me']->setChildrenAttribute('class', 'dropdown-menu');
//        // data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
//        $menu['About Me']->setLinkAttribute('class', 'dropdown-toggle');
//        $menu['About Me']->setLinkAttribute('data-toggle', 'dropdown');
//        $menu['About Me']->setLinkAttribute('role', 'button');
//        $menu['About Me']->setLinkAttribute('aria-haspopup', 'true');
//        $menu['About Me']->setLinkAttribute('aria-expanded', 'false');
//
//        $menu['About Me']->addChild('Edit profile', ['route' => 'hostels']);

        // ... add more children

        return $menu;
    }
}