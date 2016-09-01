<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hostel;
use AppBundle\Entity\Room;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RoomController
 * @package AppBundle\Controller
 * @Route("/{_locale}", requirements={"_locale" = "%app.locales%"})
 */
class RoomController extends Controller
{
    /**
     * @Route("/room/{id}", name="room_view")
     */
    public function viewAction(Request $request, Room $room) {
        return $this->render('room/view.html.twig', [
            'room' => $room
        ]);
    }

    public function getRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Hostel');
    }
}
