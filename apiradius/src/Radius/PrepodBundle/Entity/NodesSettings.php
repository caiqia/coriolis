<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NodesSettings
 *
 * @ORM\Table(name="nodes_settings")
 * @ORM\Entity
 */
class NodesSettings
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
     * @ORM\Column(name="soft_checkin_time", type="string", length=128, nullable=true)
     */
    private $softCheckinTime;

    /**
     * @var string
     *
     * @ORM\Column(name="hard_checkin_time", type="string", length=128, nullable=true)
     */
    private $hardCheckinTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=true)
     */
    private $creationdate = '0000-00-00 00:00:00';

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
    private $updatedate = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="updateby", type="string", length=128, nullable=true)
     */
    private $updateby;


}

