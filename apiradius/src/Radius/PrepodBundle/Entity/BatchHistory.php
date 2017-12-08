<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BatchHistory
 *
 * @ORM\Table(name="batch_history", indexes={@ORM\Index(name="batch_name", columns={"batch_name"})})
 * @ORM\Entity
 */
class BatchHistory
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
     * @ORM\Column(name="batch_name", type="string", length=64, nullable=true)
     */
    private $batchName;

    /**
     * @var string
     *
     * @ORM\Column(name="batch_description", type="string", length=256, nullable=true)
     */
    private $batchDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="hotspot_id", type="integer", nullable=true)
     */
    private $hotspotId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="batch_status", type="string", length=128, nullable=false)
     */
    private $batchStatus = 'Pending';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=true)
     */
    private $creationdate = '1999-10-10 10:10:10';

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
    private $updatedate = '1999-10-10 10:10:10';

    /**
     * @var string
     *
     * @ORM\Column(name="updateby", type="string", length=128, nullable=true)
     */
    private $updateby;


}

