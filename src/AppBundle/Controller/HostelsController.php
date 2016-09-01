<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Location;
use AppBundle\Entity\Hostel;
use AppBundle\Form\HostelType;
use AppBundle\Repository\HostelRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HostelsController
 * @package AppBundle\Controller
 * @Route("/{_locale}", requirements={"_locale" = "%app.locales%"})
 */
class HostelsController extends Controller
{
    /**
     * @Route("/hostels/{slug}", name="hostelsByDestination")
     */
    public function galleryByDestinationAction(Request $request, Location $destination) {
        return $this->hostelGallery($destination->getHostels());
    }

    /**
     * @Route("/hostels", name="hostels")
     */
    public function galleryAction(Request $request) {
        $repo = $this->getRepository();
        return $this->hostelGallery($repo->findAll());
    }

    private function hostelGallery($hostels) {
        return $this->render('hostel/gallery.html.twig', [
            'hostels' => $hostels,
        ]);
    }

    /**
     * @Route("/hostel/search", name="hostel_search", options={"expose"=true})
     */
    public function searchAction(Request $request) {
        $repo = $this->getRepository();
        $query = $request->query->get('query');
        $hostels = $repo->search($query);

        return $this->render('hostel/gallery_content.html.twig', [
            'hostels' => $hostels
        ]);
    }

    /**
     * @Route("/hostel/register", name="hostel_registration")
     */
    public function registerAction(Request $request)
    {
        $hostel = new Hostel();

        $this->denyAccessUnlessGranted('create', $hostel);

        $hostel->setOwner($this->getUser());
        $hostel->setActive(false);

        $form = $this->createForm(HostelType::class, $hostel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->saveInDatabase($hostel);
            return $this->redirectToRoute('hostel_edit', ['slug' => $hostel->getSlug()]);
        }

        return $this->render('hostel/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/hostel/edit/{slug}", name="hostel_edit")
     */
    public function editAction(Request $request, Hostel $hostel)
    {
        $this->denyAccessUnlessGranted('edit', $hostel);
        $form = $this->createForm(HostelType::class, $hostel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->saveInDatabase($hostel);
            return $this->redirectToRoute('hostel_view', ['slug' => $hostel->getSlug()]);
        }

        return $this->render('hostel/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/hostel/{slug}", name="hostel_view")
     */
    public function viewAction(Request $request, Hostel $hostel) {
        return $this->render('hostel/view.html.twig', [
            'hostel' => $hostel
        ]);
    }

    private function saveInDatabase($entity) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }

    public function getRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Hostel');
    }
}
