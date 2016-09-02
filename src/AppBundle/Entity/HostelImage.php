<?php

namespace AppBundle\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HostelImage
 *
 * @ORM\Table(name="hostel_image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HostelImageRepository")
 * @Vich\Uploadable
 */
class HostelImage extends Image
{
    /**
     * @var Hostel
     * @ORM\ManyToOne(targetEntity="Hostel", inversedBy="images")
     * @ORM\JoinColumn(name="hostel_id", referencedColumnName="id")
     */
    private $hostel;

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

    public function __toString() {
        return "{$this->hostel->getHostelName()}/{$this->getFilename()}";
    }
}

