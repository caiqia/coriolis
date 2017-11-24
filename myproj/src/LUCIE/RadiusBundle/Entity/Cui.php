<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cui
 *
 * @ORM\Table(name="cui")
 * @ORM\Entity
 */
class Cui
{
    /**
     * @var string
     *
     * @ORM\Column(name="cui", type="string", length=32, nullable=false)
     */
    private $cui = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=false)
     */
    private $creationdate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastaccounting", type="datetime", nullable=false)
     */
    private $lastaccounting = '1999-10-10 10:10:10';

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="clientipaddress", type="string", length=15)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $clientipaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="callingstationid", type="string", length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $callingstationid;


}

