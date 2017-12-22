<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillingPlans
 *
 * @ORM\Table(name="billing_plans", indexes={@ORM\Index(name="planName", columns={"planName"})})
 * @ORM\Entity
 */
class BillingPlans
{
    /**
     * @var string
     *
     * @ORM\Column(name="planName", type="string", length=128, nullable=true)
     */
    private $planname;

    /**
     * @var string
     *
     * @ORM\Column(name="planId", type="string", length=128, nullable=true)
     */
    private $planid;

    /**
     * @var string
     *
     * @ORM\Column(name="planType", type="string", length=128, nullable=true)
     */
    private $plantype;

    /**
     * @var string
     *
     * @ORM\Column(name="planTimeBank", type="string", length=128, nullable=true)
     */
    private $plantimebank;

    /**
     * @var string
     *
     * @ORM\Column(name="planTimeType", type="string", length=128, nullable=true)
     */
    private $plantimetype;

    /**
     * @var string
     *
     * @ORM\Column(name="planTimeRefillCost", type="string", length=128, nullable=true)
     */
    private $plantimerefillcost;

    /**
     * @var string
     *
     * @ORM\Column(name="planBandwidthUp", type="string", length=128, nullable=true)
     */
    private $planbandwidthup;

    /**
     * @var string
     *
     * @ORM\Column(name="planBandwidthDown", type="string", length=128, nullable=true)
     */
    private $planbandwidthdown;

    /**
     * @var string
     *
     * @ORM\Column(name="planTrafficTotal", type="string", length=128, nullable=true)
     */
    private $plantraffictotal;

    /**
     * @var string
     *
     * @ORM\Column(name="planTrafficUp", type="string", length=128, nullable=true)
     */
    private $plantrafficup;

    /**
     * @var string
     *
     * @ORM\Column(name="planTrafficDown", type="string", length=128, nullable=true)
     */
    private $plantrafficdown;

    /**
     * @var string
     *
     * @ORM\Column(name="planTrafficRefillCost", type="string", length=128, nullable=true)
     */
    private $plantrafficrefillcost;

    /**
     * @var string
     *
     * @ORM\Column(name="planRecurring", type="string", length=128, nullable=true)
     */
    private $planrecurring;

    /**
     * @var string
     *
     * @ORM\Column(name="planRecurringPeriod", type="string", length=128, nullable=true)
     */
    private $planrecurringperiod;

    /**
     * @var string
     *
     * @ORM\Column(name="planCost", type="string", length=128, nullable=true)
     */
    private $plancost;

    /**
     * @var string
     *
     * @ORM\Column(name="planSetupCost", type="string", length=128, nullable=true)
     */
    private $plansetupcost;

    /**
     * @var string
     *
     * @ORM\Column(name="planTax", type="string", length=128, nullable=true)
     */
    private $plantax;

    /**
     * @var string
     *
     * @ORM\Column(name="planCurrency", type="string", length=128, nullable=true)
     */
    private $plancurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="planGroup", type="string", length=128, nullable=true)
     */
    private $plangroup;

    /**
     * @var string
     *
     * @ORM\Column(name="planActive", type="string", length=32, nullable=false)
     */
    private $planactive = 'yes';

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

