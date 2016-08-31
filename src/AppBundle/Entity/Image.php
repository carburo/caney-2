<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ImageTranslation")
 */
class Image
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
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="front_page", type="boolean")
     */
    private $frontPage;

    /**
     *
     * @ORM\ManyToMany(targetEntity="ImageTag", cascade={"persist"}, inversedBy="images")
     * @ORM\JoinTable(name="tagged_images")
     */
    private $tags;

    /**
     * @ORM\OneToMany(
     *   targetEntity="ImageTranslation",
     *   mappedBy="object",
     *   cascade={"persist", "remove"}
     * )
     */
    private $translations;

    public function __construct() {
        $this->tags = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function addTranslation(OtherServicesTranslation $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
    }

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
     * Set filename
     *
     * @param string $filename
     *
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Image
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
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
     * @return boolean
     */
    public function isFrontPage()
    {
        return $this->frontPage;
    }

    /**
     * @param boolean $frontPage
     */
    public function setFrontPage($frontPage)
    {
        $this->frontPage = $frontPage;
    }

    public function __toString() {
        return $this->filename;
    }
}
