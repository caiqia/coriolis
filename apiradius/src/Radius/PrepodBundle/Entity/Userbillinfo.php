<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userbillinfo
 *
 * @ORM\Table(name="userbillinfo", uniqueConstraints={@ORM\UniqueConstraint(name="ind_name", columns={"username"})}, indexes={@ORM\Index(name="planname", columns={"planName"})})
 * @ORM\Entity
 */
class Userbillinfo
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
     * @ORM\Column(name="planName", type="string", length=128, nullable=true)
     */
    private $planname;

    /**
     * @var integer
     *
     * @ORM\Column(name="hotspot_id", type="integer", nullable=true)
     */
    private $hotspotId;

    /**
     * @var string
     *
     * @ORM\Column(name="hotspotlocation", type="string", length=32, nullable=true)
     */
    private $hotspotlocation;

    /**
     * @var string
     *
     * @ORM\Column(name="contactperson", type="string", length=200, nullable=true)
     */
    private $contactperson;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=200, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=200, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=200, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=200, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=200, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=200, nullable=true)
     */
    private $zip;

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
     * @ORM\Column(name="notes", type="string", length=200, nullable=true)
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="changeuserbillinfo", type="string", length=128, nullable=true)
     */
    private $changeuserbillinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="lead", type="string", length=200, nullable=true)
     */
    private $lead;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon", type="string", length=200, nullable=true)
     */
    private $coupon;

    /**
     * @var string
     *
     * @ORM\Column(name="ordertaker", type="string", length=200, nullable=true)
     */
    private $ordertaker;

    /**
     * @var string
     *
     * @ORM\Column(name="billstatus", type="string", length=200, nullable=true)
     */
    private $billstatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastbill", type="date", nullable=true)
     */
    private $lastbill = '1999-10-10';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nextbill", type="date", nullable=true)
     */
    private $nextbill = '1999-10-10';

    /**
     * @var integer
     *
     * @ORM\Column(name="nextinvoicedue", type="integer", nullable=true)
     */
    private $nextinvoicedue;

    /**
     * @var integer
     *
     * @ORM\Column(name="billdue", type="integer", nullable=true)
     */
    private $billdue;

    /**
     * @var string
     *
     * @ORM\Column(name="postalinvoice", type="string", length=8, nullable=true)
     */
    private $postalinvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="faxinvoice", type="string", length=8, nullable=true)
     */
    private $faxinvoice;

    /**
     * @var string
     *
     * @ORM\Column(name="emailinvoice", type="string", length=8, nullable=true)
     */
    private $emailinvoice;

    /**
     * @var integer
     *
     * @ORM\Column(name="batch_id", type="integer", nullable=true)
     */
    private $batchId;

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

