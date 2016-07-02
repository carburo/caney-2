<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PicturesController
 * @package AppBundle\Controller
 * @Route("/{_locale}", requirements={"_locale" = "%app.locales%"})
 */
class PicturesController extends Controller
{

    /**
     * @Route("/pictures", name="pictures")
     */
    public function picturesAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:ImageTag');
        $tags = $repo->findAll();
        $repo = $this->getDoctrine()->getRepository('AppBundle:Image');
        $images = $repo->findByFrontPage(false);

        return $this->render('pictures/index.html.twig', array(
            'tags' => $tags,
            'images' => $images,
        ));
    }
}
