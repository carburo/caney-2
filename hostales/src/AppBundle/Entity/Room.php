<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true, length=255)
     */
    private $description;

    /**
     * @var RoomType
     * @ORM\ManyToOne(targetEntity="RoomType")
     * @ORM\JoinColumn(name="room_type_id", referencedColumnName="id")
     */
    private $typeOfRoom;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_alta", type="decimal", precision=10, scale=2)
     */
    private $precioAlta;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_baja", type="decimal", precision=10, scale=2)
     */
    private $precioBaja;

    /**
     * @var Hostel
     * @ORM\ManyToOne(targetEntity="Hostel", inversedBy="rooms")
     * @ORM\JoinColumn(name="hostel_id", referencedColumnName="id")
     */
    private $hostel;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Room
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Room
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set precioAlta
     *
     * @param string $precioAlta
     *
     * @return Test
     */
    public function setPrecioAlta($precioAlta)
    {
        $this->precioAlta = $precioAlta;

        return $this;
    }

    /**
     * Get precioAlta
     *
     * @return string
     */
    public function getPrecioAlta()
    {
        return $this->precioAlta;
    }

    /**
     * Set precioBaja
     *
     * @param string $precioBaja
     *
     * @return Test
     */
    public function setPrecioBaja($precioBaja)
    {
        $this->precioBaja = $precioBaja;

        return $this;
    }

    /**
     * Get precioBaja
     *
     * @return string
     */
    public function getPrecioBaja()
    {
        return $this->precioBaja;
    }

    public function getPrice() {
        if($this->getHostel()->isHighSeason()) {
            return $this->getPrecioAlta();
        }
        return $this->getPrecioBaja();
    }

    /**
     * @return Hostel
     */
    public function getHostel()
    {
        return $this->hostel;
    }

    /**
     * @param Hostel $hostel
     */
    public function setHostel($hostel)
    {
        $this->hostel = $hostel;
    }

    /**
     * @return RoomType
     */
    public function getTypeOfRoom()
    {
        return $this->typeOfRoom;
    }

    /**
     * @param Room $typeOfRoom
     */
    public function setTypeOfRoom($typeOfRoom)
    {
        $this->typeOfRoom = $typeOfRoom;
    }

    /**
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function __toString() {
        return "{$this->getName()} ({$this->getCapacity()} persons, \${$this->getPrice()})";
    }
}

