<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HostelImage;
use AppBundle\Form\HostelImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HostelImageController
 * @package AppBundle\Controller
 * @Route("/{_locale}", requirements={"_locale" = "%app.locales%"})
 */
class HostelImageControllerController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('hostel_image/edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/hostel/image/edit/{id}", name="hostel_image_edit")
     */
    public function editAction(Request $request, HostelImage $image)
    {
        $this->denyAccessUnlessGranted('edit', $image->getHostel());
        $form = $this->createForm(HostelImageType::class, $image);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->saveInDatabase($image);
            return $this->redirectToRoute('hostel_view', ['slug' => $image->getHostel()->getSlug()]);
        }

        return $this->render('hostel_image/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function saveInDatabase($entity) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }

    public function getRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:HostelImage');
    }

}
