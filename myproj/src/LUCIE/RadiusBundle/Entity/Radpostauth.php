<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Radpostauth
 *
 * @ORM\Table(name="radpostauth")
 * @ORM\Entity
 */
class Radpostauth
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64, nullable=false)
     */
    private $username = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=64, nullable=false)
     */
    private $pass = '';

    /**
     * @var string
     *
     * @ORM\Column(name="reply", type="string", length=32, nullable=false)
     */
    private $reply = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="authdate", type="datetime", nullable=false)
     */
    private $authdate = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

