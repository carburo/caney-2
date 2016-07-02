<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ServicesController
 * @package AppBundle\Controller
 * @Route("/{_locale}", requirements={"_locale" = "%app.locales%"})
 */
class ServicesController extends Controller
{
    /**
     * @Route("/services", name="services")
     */
    public function servicesAction(Request $request)
    {
        return $this->render('services/index.html.twig');
    }
}
