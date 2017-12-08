<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceItems
 *
 * @ORM\Table(name="invoice_items")
 * @ORM\Entity
 */
class InvoiceItems
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
     * @var integer
     *
     * @ORM\Column(name="invoice_id", type="integer", nullable=false)
     */
    private $invoiceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="plan_id", type="integer", nullable=true)
     */
    private $planId;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $amount = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="tax_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $taxAmount = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $total = '0.00';

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


}

