<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * HostelImage
 *
 * @ORM\Table(name="hostel_image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HostelImageRepository")
 * @Vich\Uploadable
 */
class HostelImage
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
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @Vich\UploadableField(mapping="hostel_images", fileNameProperty="filename")
     * @var File
     */
    private $imageFile;

    /**
     * @var ImageDescription
     * @ORM\ManyToOne(targetEntity="ImageDescription")
     * @ORM\JoinColumn(name="description_id", referencedColumnName="id")
     */
    private $description;

    /**
     * @var Hostel
     * @ORM\ManyToOne(targetEntity="Hostel", inversedBy="images")
     * @ORM\JoinColumn(name="hostel_id", referencedColumnName="id")
     */
    private $hostel;

    /**
     * @var int
     *
     * @ORM\Column(name="pixel_width", type="integer")
     */
    private $pixelWidth;

    /**
     * @var int
     *
     * @ORM\Column(name="pixel_height", type="integer")
     */
    private $pixelHeight;

    /**
     * @var date
     *
     * @ORM\Column(name="updatedAt", type="date", nullable=true)
     */
    private $updatedAt;

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
     * Set description
     *
     * @param ImageDescription $description
     *
     * @return HostelImage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return ImageDescription
     */
    public function getDescription()
    {
        return $this->description;
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
     * @return date
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param date $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return int
     */
    public function getPixelWidth()
    {
        return $this->pixelWidth;
    }

    /**
     * @param int $pixelWidth
     */
    public function setPixelWidth($pixelWidth)
    {
        $this->pixelWidth = $pixelWidth;
    }

    /**
     * @return int
     */
    public function getPixelHeight()
    {
        return $this->pixelHeight;
    }

    /**
     * @param int $pixelHeight
     */
    public function setPixelHeight($pixelHeight)
    {
        $this->pixelHeight = $pixelHeight;
    }

    public function __toString() {
        return "{$this->hostel->getHostelName()}/{$this->filename})";
    }
}

