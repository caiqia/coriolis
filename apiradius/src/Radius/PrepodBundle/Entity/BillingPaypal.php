<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillingPaypal
 *
 * @ORM\Table(name="billing_paypal", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class BillingPaypal
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=128, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=200, nullable=true)
     */
    private $mac;

    /**
     * @var string
     *
     * @ORM\Column(name="pin", type="string", length=200, nullable=true)
     */
    private $pin;

    /**
     * @var string
     *
     * @ORM\Column(name="txnId", type="string", length=200, nullable=true)
     */
    private $txnid;

    /**
     * @var string
     *
     * @ORM\Column(name="planName", type="string", length=128, nullable=true)
     */
    private $planname;

    /**
     * @var string
     *
     * @ORM\Column(name="planId", type="string", length=200, nullable=true)
     */
    private $planid;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="string", length=200, nullable=true)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="receiver_email", type="string", length=200, nullable=true)
     */
    private $receiverEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="business", type="string", length=200, nullable=true)
     */
    private $business;

    /**
     * @var string
     *
     * @ORM\Column(name="tax", type="string", length=200, nullable=true)
     */
    private $tax;

    /**
     * @var string
     *
     * @ORM\Column(name="mc_gross", type="string", length=200, nullable=true)
     */
    private $mcGross;

    /**
     * @var string
     *
     * @ORM\Column(name="mc_fee", type="string", length=200, nullable=true)
     */
    private $mcFee;

    /**
     * @var string
     *
     * @ORM\Column(name="mc_currency", type="string", length=200, nullable=true)
     */
    private $mcCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=200, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=200, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_email", type="string", length=200, nullable=true)
     */
    private $payerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="address_name", type="string", length=200, nullable=true)
     */
    private $addressName;

    /**
     * @var string
     *
     * @ORM\Column(name="address_street", type="string", length=200, nullable=true)
     */
    private $addressStreet;

    /**
     * @var string
     *
     * @ORM\Column(name="address_country", type="string", length=200, nullable=true)
     */
    private $addressCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="address_country_code", type="string", length=200, nullable=true)
     */
    private $addressCountryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="address_city", type="string", length=200, nullable=true)
     */
    private $addressCity;

    /**
     * @var string
     *
     * @ORM\Column(name="address_state", type="string", length=200, nullable=true)
     */
    private $addressState;

    /**
     * @var string
     *
     * @ORM\Column(name="address_zip", type="string", length=200, nullable=true)
     */
    private $addressZip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payment_date", type="datetime", nullable=true)
     */
    private $paymentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_status", type="string", length=200, nullable=true)
     */
    private $paymentStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_address_status", type="string", length=200, nullable=true)
     */
    private $paymentAddressStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="payer_status", type="string", length=200, nullable=true)
     */
    private $payerStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

