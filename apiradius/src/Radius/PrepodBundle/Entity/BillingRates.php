<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillingRates
 *
 * @ORM\Table(name="billing_rates", indexes={@ORM\Index(name="rateName", columns={"rateName"})})
 * @ORM\Entity
 */
class BillingRates
{
    /**
     * @var string
     *
     * @ORM\Column(name="rateName", type="string", length=128, nullable=false)
     */
    private $ratename = '';

    /**
     * @var string
     *
     * @ORM\Column(name="rateType", type="string", length=128, nullable=false)
     */
    private $ratetype = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="rateCost", type="integer", nullable=false)
     */
    private $ratecost = '0';

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

