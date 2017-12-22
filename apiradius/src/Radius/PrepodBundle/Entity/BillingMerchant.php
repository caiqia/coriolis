<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillingMerchant
 *
 * @ORM\Table(name="billing_merchant", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class BillingMerchant
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=128, nullable=false)
     */
    private $username = '';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=false)
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=200, nullable=false)
     */
    private $mac = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pin", type="string", length=200, nullable=false)
     */
    private $pin = '';

    /**
     * @var string
     *
     * @ORM\Column(name="txnId", type="string", length=200, nullable=false)
     */
    private $txnid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="planName", type="string", length=128, nullable=false)
     */
    private $planname = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="planId", type="integer", nullable=false)
     */
    private $planid;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="string", length=200, nullable=false)
     */
    private $quantity = '';

    /**
     * @var string
     *
     * @ORM\Column(name="business_email", type="string", length=200, nullable=false)
     */
    private $businessEmail = '';

    /**
     * @var string
     *
     * @ORM\Column(name="business_id", type="string", length=200, nullable=false)
     */
    private $businessId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="txn_type", type="string", length=200, nullable=false)
     */
    private $txnType = '';

    /**
     * @var string
     *
     * @ORM\Column(name="txn_id", type="string", length=200, nullable=false)
     */
    private $txnId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_type", type="string", length=200, nullable=false)
     */
    private $paymentType = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_tax", type="string", length=200, nullable=false)
     */
    private $paymentTax = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_cost", type="string", length=200, nullable=false)
     */
    private $paymentCost = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_fee", type="string", length=200, nullable=false)
     */
    private $paymentFee = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_total", type="string", length=200, nullable=false)
     */
    private $paymentTotal = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_currency", type="string", length=200, nullable=false)
     */
    private $paymentCurrency = '';

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=200, nullable=false)
     */
    private $firstName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=200, nullable=false)
     */
    private $lastName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_email", type="string", length=200, nullable=false)
     */
    private $payerEmail = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_address_name", type="string", length=200, nullable=false)
     */
    private $payerAddressName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_address_street", type="string", length=200, nullable=false)
     */
    private $payerAddressStreet = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_address_country", type="string", length=200, nullable=false)
     */
    private $payerAddressCountry = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_address_country_code", type="string", length=200, nullable=false)
     */
    private $payerAddressCountryCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_address_city", type="string", length=200, nullable=false)
     */
    private $payerAddressCity = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_address_state", type="string", length=200, nullable=false)
     */
    private $payerAddressState = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_address_zip", type="string", length=200, nullable=false)
     */
    private $payerAddressZip = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payment_date", type="datetime", nullable=true)
     */
    private $paymentDate = '1999-10-10 10:10:10';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_status", type="string", length=200, nullable=false)
     */
    private $paymentStatus = '';

    /**
     * @var string
     *
     * @ORM\Column(name="pending_reason", type="string", length=200, nullable=false)
     */
    private $pendingReason = '';

    /**
     * @var string
     *
     * @ORM\Column(name="reason_code", type="string", length=200, nullable=false)
     */
    private $reasonCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="receipt_ID", type="string", length=200, nullable=false)
     */
    private $receiptId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_address_status", type="string", length=200, nullable=false)
     */
    private $paymentAddressStatus = '';

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_type", type="string", length=200, nullable=false)
     */
    private $vendorType = '';

    /**
     * @var string
     *
     * @ORM\Column(name="payer_status", type="string", length=200, nullable=false)
     */
    private $payerStatus = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

