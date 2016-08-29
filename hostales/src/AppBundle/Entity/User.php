<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="profilePicture", type="string", length=255, nullable=true)
     */
    private $profilePicture;
    
    /**
     * @Vich\UploadableField(mapping="profile_images", fileNameProperty="profilePicture")
     * @var File
     * @Assert\Image(
     * maxSize = "2048k"
     * )
     */
    private $imageFile;
    
    /**
     * @var date
     *
     * @ORM\Column(name="updatedAt", type="date", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="forename", type="string", length=255)
     * @Assert\NotBlank(message="Please enter your firstname.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     max=255,
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    private $forename;

    /**
     * @var string
     *
     * @ORM\Column(name="surename", type="string", length=255)
     * @Assert\NotBlank(message="Please enter your surename.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     max=255,
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    private $surename;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=true)
     */
    private $country;

    /**
     * @return string
     */
    public function getForename(): string
    {
        return $this->forename;
    }

    /**
     * @param string $forename
     */
    public function setForename(string $forename)
    {
        $this->forename = $forename;
    }

    /**
     * @return string
     */
    public function getSurename(): string
    {
        return $this->surename;
    }

    /**
     * @param string $surename
     */
    public function setSurename(string $surename)
    {
        $this->surename = $surename;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return "{$this->getForename()} {$this->getSurename()}";
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile = null)
    {
        $this->imageFile = $imageFile;
        
        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imageFile) {
            $this->updatedAt = new \DateTime('now');
        }
        
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

