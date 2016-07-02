<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Hostel
 *
 * @ORM\Table(name="hostel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HostelRepository")
 */
class Hostel
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
     * @Gedmo\Slug(fields={"hostelName"})
     * @ORM\Column(length=64, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="hostel_name", type="string", length=255)
     */
    private $hostelName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable = true)
     */
    private $description;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="host_languages", type="string", length=255)
     */
    private $hostLanguages;

    /**
     * @var bool
     *
     * @ORM\Column(name="private_bathroom", type="boolean")
     */
    private $privateBathroom;

    /**
     * @var bool
     *
     * @ORM\Column(name="air_conditioner", type="boolean")
     */
    private $airConditioner;

    /**
     * @var bool
     *
     * @ORM\Column(name="hair_dryer", type="boolean")
     */
    private $hairDryer;

    /**
     * @var bool
     *
     * @ORM\Column(name="towels_in_the_room", type="boolean")
     */
    private $towelsInTheRoom;

    /**
     * @var int
     *
     * @ORM\Column(name="clean_sheets", type="integer")
     */
    private $cleanSheets;

    /**
     * @var bool
     *
     * @ORM\Column(name="bathroom_items", type="boolean")
     */
    private $bathroomItems;

    /**
     * @var string
     *
     * @ORM\Column(name="breakfast_price", type="decimal", precision=10, scale=2)
     */
    private $breakfastPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="dinner_price", type="decimal", precision=10, scale=2)
     */
    private $dinnerPrice;

    /**
     * @var bool
     *
     * @ORM\Column(name="internet", type="boolean")
     */
    private $internet;

    /**
     * @var bool
     *
     * @ORM\Column(name="wifi", type="boolean")
     */
    private $wifi;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="hostel")
     */
    private $rooms;

    /**
     * @ORM\OneToMany(targetEntity="HostelImage", mappedBy="hostel")
     */
    private $images;

    /**
     *
     * @ORM\ManyToMany(targetEntity="OtherServices")
     * @ORM\JoinTable(name="services_by_hostel",
     *      joinColumns={@ORM\JoinColumn(name="hostel_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="service_id", referencedColumnName="id")}
     *      )
     */
    private $otherServices;

    /**
     * @var City
     * @ORM\ManyToOne(targetEntity="City", inversedBy="hostels")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @var bool
     *
     * @ORM\Column(name="highSeason", type="boolean")
     */
    private $highSeason;


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
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getHostelName()
    {
        return $this->hostelName;
    }

    /**
     * @param string $hostelName
     */
    public function setHostelName($hostelName)
    {
        $this->hostelName = $hostelName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Hostel
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Set hostLanguages
     *
     * @param string $hostLanguages
     *
     * @return Hostel
     */
    public function setHostLanguages($hostLanguages)
    {
        $this->hostLanguages = $hostLanguages;

        return $this;
    }

    /**
     * Get hostLanguages
     *
     * @return string
     */
    public function getHostLanguages()
    {
        return $this->hostLanguages;
    }

    /**
     * Set privateBathroom
     *
     * @param boolean $privateBathroom
     *
     * @return Hostel
     */
    public function setPrivateBathroom($privateBathroom)
    {
        $this->privateBathroom = $privateBathroom;

        return $this;
    }

    /**
     * Get privateBathroom
     *
     * @return bool
     */
    public function getPrivateBathroom()
    {
        return $this->privateBathroom;
    }

    /**
     * Set airConditioner
     *
     * @param boolean $airConditioner
     *
     * @return Hostel
     */
    public function setAirConditioner($airConditioner)
    {
        $this->airConditioner = $airConditioner;

        return $this;
    }

    /**
     * Get airConditioner
     *
     * @return bool
     */
    public function getAirConditioner()
    {
        return $this->airConditioner;
    }

    /**
     * Set hairDryer
     *
     * @param boolean $hairDryer
     *
     * @return Hostel
     */
    public function setHairDryer($hairDryer)
    {
        $this->hairDryer = $hairDryer;

        return $this;
    }

    /**
     * Get hairDryer
     *
     * @return bool
     */
    public function getHairDryer()
    {
        return $this->hairDryer;
    }

    /**
     * Set towelsInTheRoom
     *
     * @param boolean $towelsInTheRoom
     *
     * @return Hostel
     */
    public function setTowelsInTheRoom($towelsInTheRoom)
    {
        $this->towelsInTheRoom = $towelsInTheRoom;

        return $this;
    }

    /**
     * Get towelsInTheRoom
     *
     * @return bool
     */
    public function getTowelsInTheRoom()
    {
        return $this->towelsInTheRoom;
    }

    /**
     * Set cleanSheets
     *
     * @param integer $cleanSheets
     *
     * @return Hostel
     */
    public function setCleanSheets($cleanSheets)
    {
        $this->cleanSheets = $cleanSheets;

        return $this;
    }

    /**
     * Get cleanSheets
     *
     * @return int
     */
    public function getCleanSheets()
    {
        return $this->cleanSheets;
    }

    /**
     * Set bathroomItems
     *
     * @param boolean $bathroomItems
     *
     * @return Hostel
     */
    public function setBathroomItems($bathroomItems)
    {
        $this->bathroomItems = $bathroomItems;

        return $this;
    }

    /**
     * Get bathroomItems
     *
     * @return bool
     */
    public function getBathroomItems()
    {
        return $this->bathroomItems;
    }

    /**
     * Set breakfastPrice
     *
     * @param string $breakfastPrice
     *
     * @return Hostel
     */
    public function setBreakfastPrice($breakfastPrice)
    {
        $this->breakfastPrice = $breakfastPrice;

        return $this;
    }

    /**
     * Get breakfastPrice
     *
     * @return string
     */
    public function getBreakfastPrice()
    {
        return $this->breakfastPrice;
    }

    /**
     * Set dinnerPrice
     *
     * @param string $dinnerPrice
     *
     * @return Hostel
     */
    public function setDinnerPrice($dinnerPrice)
    {
        $this->dinnerPrice = $dinnerPrice;

        return $this;
    }

    /**
     * Get dinnerPrice
     *
     * @return string
     */
    public function getDinnerPrice()
    {
        return $this->dinnerPrice;
    }

    /**
     * Set internet
     *
     * @param boolean $internet
     *
     * @return Hostel
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get internet
     *
     * @return bool
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set wifi
     *
     * @param boolean $wifi
     *
     * @return Hostel
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;

        return $this;
    }

    /**
     * Get wifi
     *
     * @return bool
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * @return mixed
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param mixed $rooms
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;
    }

    /**
     * @return mixed
     */
    public function getOtherServices()
    {
        return $this->otherServices;
    }

    /**
     * @param mixed $otherServices
     */
    public function setOtherServices($otherServices)
    {
        $this->otherServices = $otherServices;
    }

    public function __toString() {
        return $this->hostelName;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return boolean
     */
    public function isHighSeason()
    {
        return $this->highSeason;
    }

    /**
     * @param boolean $highSeason
     */
    public function setHighSeason($highSeason)
    {
        $this->highSeason = $highSeason;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}


