<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillingHistory
 *
 * @ORM\Table(name="billing_history", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class BillingHistory
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=128, nullable=true)
     */
    private $username;

    /**
     * @var integer
     *
     * @ORM\Column(name="planId", type="integer", nullable=true)
     */
    private $planid;

    /**
     * @var string
     *
     * @ORM\Column(name="billAmount", type="string", length=200, nullable=true)
     */
    private $billamount;

    /**
     * @var string
     *
     * @ORM\Column(name="billAction", type="string", length=128, nullable=false)
     */
    private $billaction = 'Unavailable';

    /**
     * @var string
     *
     * @ORM\Column(name="billPerformer", type="string", length=200, nullable=true)
     */
    private $billperformer;

    /**
     * @var string
     *
     * @ORM\Column(name="billReason", type="string", length=200, nullable=true)
     */
    private $billreason;

    /**
     * @var string
     *
     * @ORM\Column(name="paymentmethod", type="string", length=200, nullable=true)
     */
    private $paymentmethod;

    /**
     * @var string
     *
     * @ORM\Column(name="cash", type="string", length=200, nullable=true)
     */
    private $cash;

    /**
     * @var string
     *
     * @ORM\Column(name="creditcardname", type="string", length=200, nullable=true)
     */
    private $creditcardname;

    /**
     * @var string
     *
     * @ORM\Column(name="creditcardnumber", type="string", length=200, nullable=true)
     */
    private $creditcardnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="creditcardverification", type="string", length=200, nullable=true)
     */
    private $creditcardverification;

    /**
     * @var string
     *
     * @ORM\Column(name="creditcardtype", type="string", length=200, nullable=true)
     */
    private $creditcardtype;

    /**
     * @var string
     *
     * @ORM\Column(name="creditcardexp", type="string", length=200, nullable=true)
     */
    private $creditcardexp;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon", type="string", length=200, nullable=true)
     */
    private $coupon;

    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="string", length=200, nullable=true)
     */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=200, nullable=true)
     */
    private $notes;

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

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

