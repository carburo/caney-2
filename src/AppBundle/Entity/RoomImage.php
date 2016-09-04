<?php

namespace AppBundle\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RoomImage
 *
 * @ORM\Table(name="room_image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomImageRepository")
 * @Vich\Uploadable
 * @deprecated use Hostel Image instead
 */
class RoomImage extends Image
{
    /**
     * @var Room
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="images")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    private $room;

    /**
     * @return Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom($room)
    {
        $this->room = $room;
    }

    public function __toString() {
        return "{$this->room->getName()}/{$this->getFilename()}";
    }
}

