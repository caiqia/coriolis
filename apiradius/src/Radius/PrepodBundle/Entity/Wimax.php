<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wimax
 *
 * @ORM\Table(name="wimax", indexes={@ORM\Index(name="username", columns={"username"}), @ORM\Index(name="spi", columns={"spi"})})
 * @ORM\Entity
 */
class Wimax
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64, nullable=false)
     */
    private $username = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="authdate", type="datetime", nullable=false)
     */
    private $authdate = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="spi", type="string", length=16, nullable=false)
     */
    private $spi = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mipkey", type="string", length=400, nullable=false)
     */
    private $mipkey = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="lifetime", type="integer", nullable=true)
     */
    private $lifetime;


}

