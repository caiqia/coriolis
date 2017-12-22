<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dictionary
 *
 * @ORM\Table(name="dictionary")
 * @ORM\Entity
 */
class Dictionary
{
    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=30, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Attribute", type="string", length=64, nullable=true)
     */
    private $attribute;

    /**
     * @var string
     *
     * @ORM\Column(name="Value", type="string", length=64, nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="Format", type="string", length=20, nullable=true)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="Vendor", type="string", length=32, nullable=true)
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="RecommendedOP", type="string", length=32, nullable=true)
     */
    private $recommendedop;

    /**
     * @var string
     *
     * @ORM\Column(name="RecommendedTable", type="string", length=32, nullable=true)
     */
    private $recommendedtable;

    /**
     * @var string
     *
     * @ORM\Column(name="RecommendedHelper", type="string", length=32, nullable=true)
     */
    private $recommendedhelper;

    /**
     * @var string
     *
     * @ORM\Column(name="RecommendedTooltip", type="string", length=512, nullable=true)
     */
    private $recommendedtooltip;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

