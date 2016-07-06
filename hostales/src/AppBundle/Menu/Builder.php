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
        
        $menu->addChild('menu.homepage', [
            'route' => 'homepage'
        ]);
        
        $menu->addChild('menu.hostels', [
            'route' => 'hostels'
        ]);
        
        $menu->addChild('menu.contact', [
            'route' => 'contact'
        ]);
        
        $menu->addChild('Register', [
            'route' => 'hostel_registration'
        ]);
        
        // access services from the container!
        // $em = $this->container->get('doctrine')->getManager();
        
        return $menu;
    }
    
    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
    
        $securityChecker = $this->container->get('security.authorization_checker');
        $translator = $this->container->get('translator');
        if ($securityChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $securityContext = $this->container->get('security.token_storage');
            $username = $securityContext->getToken()
            ->getUser()
            ->getUsername();
        
            $userMessage = $translator->trans('menu.welcome.message', [
                '%visitor%' => $username
            ]);
        
            // create another menu item
            $menu->addChild('User', [
                'label' => $userMessage
            ])->setAttribute('dropdown', true);
        
            $menu['User']->addChild($translator->trans('menu.user.edit'), [
                'route' => 'fos_user_profile_edit'
            ])->setAttribute('icon', 'icon icon-edit');
        
            $menu['User']->addChild($translator->trans('layout.logout', [], 'FOSUserBundle'), [
                'route' => 'fos_user_security_logout'
            ])->setAttribute('icon', 'icon icon-sign-out');
        } else {
            $menu->addChild($translator->trans('layout.login', [], 'FOSUserBundle'), [
                'route' => 'fos_user_security_login'
            ])->setAttribute('icon', 'icon icon-sign-in');
        }
    
        return $menu;
    }
    
    
//     public function languageMenu(FactoryInterface $factory, array $options)
//     {
//         $menu = $this->createMenu($factory);
    
//         $locales = explode('|', $this->container->getParameter('app.locales'));
        
//         $menu->addChild('Language', [
//             'label' => 'Language'
//         ])->setAttribute('dropdown', true);
        
//         foreach ($locales as $locale) {
//             $menu['Language']->addChild($locale, [
//                 'route' => 'fos_user_security_login'
//             ]);
//         }
    
//         return $menu;
//     }

}