<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Radippool
 *
 * @ORM\Table(name="radippool", indexes={@ORM\Index(name="radippool_poolname_expire", columns={"pool_name", "expiry_time"}), @ORM\Index(name="framedipaddress", columns={"framedipaddress"}), @ORM\Index(name="radippool_nasip_poolkey_ipaddress", columns={"nasipaddress", "pool_key", "framedipaddress"})})
 * @ORM\Entity
 */
class Radippool
{
    /**
     * @var string
     *
     * @ORM\Column(name="pool_name", type="string", length=30, nullable=false)
     */
    private $poolName;

    /**
     * @var string
     *
     * @ORM\Column(name="framedipaddress", type="string", length=15, nullable=false)
     */
    private $framedipaddress = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nasipaddress", type="string", length=15, nullable=false)
     */
    private $nasipaddress = '';

    /**
     * @var string
     *
     * @ORM\Column(name="calledstationid", type="string", length=30, nullable=false)
     */
    private $calledstationid;

    /**
     * @var string
     *
     * @ORM\Column(name="callingstationid", type="string", length=30, nullable=false)
     */
    private $callingstationid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiry_time", type="datetime", nullable=true)
     */
    private $expiryTime;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64, nullable=false)
     */
    private $username = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pool_key", type="string", length=30, nullable=false)
     */
    private $poolKey;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

