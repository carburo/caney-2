<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * RangePricedService
 *
 * @ORM\Entity
 */
class RangePricedService extends Service
{

    /**
     * @var string
     *
     * @ORM\Column(name="minimum_price", type="decimal", precision=10, scale=2)
     */
    private $minimumPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="maximum_price", type="decimal", precision=10, scale=2)
     */
    private $maximumPrice;

    /**
     * @return string
     */
    public function getMinimumPrice()
    {
        return $this->minimumPrice;
    }

    /**
     * @param string $minimumPrice
     */
    public function setMinimumPrice($minimumPrice)
    {
        $this->minimumPrice = $minimumPrice;
    }

    /**
     * @return string
     */
    public function getMaximumPrice()
    {
        return $this->maximumPrice;
    }

    /**
     * @param string $maximumPrice
     */
    public function setMaximumPrice($maximumPrice)
    {
        $this->maximumPrice = $maximumPrice;
    }
}

