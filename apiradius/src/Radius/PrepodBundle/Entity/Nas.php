<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nas
 *
 * @ORM\Table(name="nas", indexes={@ORM\Index(name="nasname", columns={"nasname"})})
 * @ORM\Entity
 */
class Nas
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
     * @ORM\Column(name="nasname", type="string", length=128, nullable=false)
     */
    private $nasname;

    /**
     * @var string
     *
     * @ORM\Column(name="shortname", type="string", length=32, nullable=true)
     */
    private $shortname;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=true)
     */
    private $type = 'other';

    /**
     * @var integer
     *
     * @ORM\Column(name="ports", type="integer", nullable=true)
     */
    private $ports;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=60, nullable=false)
     */
    private $secret = 'secret';

    /**
     * @var string
     *
     * @ORM\Column(name="server", type="string", length=64, nullable=true)
     */
    private $server;

    /**
     * @var string
     *
     * @ORM\Column(name="community", type="string", length=50, nullable=true)
     */
    private $community;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=true)
     */
    private $description = 'RADIUS Client';


}

