<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceStatus
 *
 * @ORM\Table(name="invoice_status")
 * @ORM\Entity
 */
class InvoiceStatus
{
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=32, nullable=false)
     */
    private $value = '';

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=128, nullable=false)
     */
    private $notes;

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

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

