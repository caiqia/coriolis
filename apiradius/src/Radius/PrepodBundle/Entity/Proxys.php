<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proxys
 *
 * @ORM\Table(name="proxys")
 * @ORM\Entity
 */
class Proxys
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="proxyname", type="string", length=128, nullable=true)
     */
    private $proxyname;

    /**
     * @var integer
     *
     * @ORM\Column(name="retry_delay", type="integer", nullable=true)
     */
    private $retryDelay;

    /**
     * @var integer
     *
     * @ORM\Column(name="retry_count", type="integer", nullable=true)
     */
    private $retryCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="dead_time", type="integer", nullable=true)
     */
    private $deadTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="default_fallback", type="integer", nullable=true)
     */
    private $defaultFallback;

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


}

