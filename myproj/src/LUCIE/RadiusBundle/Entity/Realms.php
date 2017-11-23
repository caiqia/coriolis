<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Realms
 *
 * @ORM\Table(name="realms")
 * @ORM\Entity
 */
class Realms
{
    /**
     * @var string
     *
     * @ORM\Column(name="realmname", type="string", length=128, nullable=true)
     */
    private $realmname;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=32, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="authhost", type="string", length=256, nullable=true)
     */
    private $authhost;

    /**
     * @var string
     *
     * @ORM\Column(name="accthost", type="string", length=256, nullable=true)
     */
    private $accthost;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=128, nullable=true)
     */
    private $secret;

    /**
     * @var string
     *
     * @ORM\Column(name="ldflag", type="string", length=64, nullable=true)
     */
    private $ldflag;

    /**
     * @var integer
     *
     * @ORM\Column(name="nostrip", type="integer", nullable=true)
     */
    private $nostrip;

    /**
     * @var integer
     *
     * @ORM\Column(name="hints", type="integer", nullable=true)
     */
    private $hints;

    /**
     * @var integer
     *
     * @ORM\Column(name="notrealm", type="integer", nullable=true)
     */
    private $notrealm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=true)
     */
    private $creationdate;

    /**
     * @var string
     *
     * @ORM\Column(name="creationby", type="string", length=128, nullable=true)
     */
    private $creationby;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedate", type="datetime", nullable=true)
     */
    private $updatedate;

    /**
     * @var string
     *
     * @ORM\Column(name="updateby", type="string", length=128, nullable=true)
     */
    private $updateby;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

