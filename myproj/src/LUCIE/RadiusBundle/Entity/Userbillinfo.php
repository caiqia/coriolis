<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userbillinfo
 *
 * @ORM\Table(name="userbillinfo", indexes={@ORM\Index(name="username", columns={"username"}), @ORM\Index(name="planname", columns={"planName"})})
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
     * @ORM\Column(name="lastbill", type="date", nullable=false)
     */
    private $lastbill = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nextbill", type="date", nullable=false)
     */
    private $nextbill = '0000-00-00';

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



    /**
     * Set username
     *
     * @param string $username
     *
     * @return Userbillinfo
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set planname
     *
     * @param string $planname
     *
     * @return Userbillinfo
     */
    public function setPlanname($planname)
    {
        $this->planname = $planname;

        return $this;
    }

    /**
     * Get planname
     *
     * @return string
     */
    public function getPlanname()
    {
        return $this->planname;
    }

    /**
     * Set hotspotId
     *
     * @param integer $hotspotId
     *
     * @return Userbillinfo
     */
    public function setHotspotId($hotspotId)
    {
        $this->hotspotId = $hotspotId;

        return $this;
    }

    /**
     * Get hotspotId
     *
     * @return integer
     */
    public function getHotspotId()
    {
        return $this->hotspotId;
    }

    /**
     * Set hotspotlocation
     *
     * @param string $hotspotlocation
     *
     * @return Userbillinfo
     */
    public function setHotspotlocation($hotspotlocation)
    {
        $this->hotspotlocation = $hotspotlocation;

        return $this;
    }

    /**
     * Get hotspotlocation
     *
     * @return string
     */
    public function getHotspotlocation()
    {
        return $this->hotspotlocation;
    }

    /**
     * Set contactperson
     *
     * @param string $contactperson
     *
     * @return Userbillinfo
     */
    public function setContactperson($contactperson)
    {
        $this->contactperson = $contactperson;

        return $this;
    }

    /**
     * Get contactperson
     *
     * @return string
     */
    public function getContactperson()
    {
        return $this->contactperson;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Userbillinfo
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Userbillinfo
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Userbillinfo
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Userbillinfo
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Userbillinfo
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Userbillinfo
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Userbillinfo
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return Userbillinfo
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set paymentmethod
     *
     * @param string $paymentmethod
     *
     * @return Userbillinfo
     */
    public function setPaymentmethod($paymentmethod)
    {
        $this->paymentmethod = $paymentmethod;

        return $this;
    }

    /**
     * Get paymentmethod
     *
     * @return string
     */
    public function getPaymentmethod()
    {
        return $this->paymentmethod;
    }

    /**
     * Set cash
     *
     * @param string $cash
     *
     * @return Userbillinfo
     */
    public function setCash($cash)
    {
        $this->cash = $cash;

        return $this;
    }

    /**
     * Get cash
     *
     * @return string
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * Set creditcardname
     *
     * @param string $creditcardname
     *
     * @return Userbillinfo
     */
    public function setCreditcardname($creditcardname)
    {
        $this->creditcardname = $creditcardname;

        return $this;
    }

    /**
     * Get creditcardname
     *
     * @return string
     */
    public function getCreditcardname()
    {
        return $this->creditcardname;
    }

    /**
     * Set creditcardnumber
     *
     * @param string $creditcardnumber
     *
     * @return Userbillinfo
     */
    public function setCreditcardnumber($creditcardnumber)
    {
        $this->creditcardnumber = $creditcardnumber;

        return $this;
    }

    /**
     * Get creditcardnumber
     *
     * @return string
     */
    public function getCreditcardnumber()
    {
        return $this->creditcardnumber;
    }

    /**
     * Set creditcardverification
     *
     * @param string $creditcardverification
     *
     * @return Userbillinfo
     */
    public function setCreditcardverification($creditcardverification)
    {
        $this->creditcardverification = $creditcardverification;

        return $this;
    }

    /**
     * Get creditcardverification
     *
     * @return string
     */
    public function getCreditcardverification()
    {
        return $this->creditcardverification;
    }

    /**
     * Set creditcardtype
     *
     * @param string $creditcardtype
     *
     * @return Userbillinfo
     */
    public function setCreditcardtype($creditcardtype)
    {
        $this->creditcardtype = $creditcardtype;

        return $this;
    }

    /**
     * Get creditcardtype
     *
     * @return string
     */
    public function getCreditcardtype()
    {
        return $this->creditcardtype;
    }

    /**
     * Set creditcardexp
     *
     * @param string $creditcardexp
     *
     * @return Userbillinfo
     */
    public function setCreditcardexp($creditcardexp)
    {
        $this->creditcardexp = $creditcardexp;

        return $this;
    }

    /**
     * Get creditcardexp
     *
     * @return string
     */
    public function getCreditcardexp()
    {
        return $this->creditcardexp;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Userbillinfo
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set changeuserbillinfo
     *
     * @param string $changeuserbillinfo
     *
     * @return Userbillinfo
     */
    public function setChangeuserbillinfo($changeuserbillinfo)
    {
        $this->changeuserbillinfo = $changeuserbillinfo;

        return $this;
    }

    /**
     * Get changeuserbillinfo
     *
     * @return string
     */
    public function getChangeuserbillinfo()
    {
        return $this->changeuserbillinfo;
    }

    /**
     * Set lead
     *
     * @param string $lead
     *
     * @return Userbillinfo
     */
    public function setLead($lead)
    {
        $this->lead = $lead;

        return $this;
    }

    /**
     * Get lead
     *
     * @return string
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * Set coupon
     *
     * @param string $coupon
     *
     * @return Userbillinfo
     */
    public function setCoupon($coupon)
    {
        $this->coupon = $coupon;

        return $this;
    }

    /**
     * Get coupon
     *
     * @return string
     */
    public function getCoupon()
    {
        return $this->coupon;
    }

    /**
     * Set ordertaker
     *
     * @param string $ordertaker
     *
     * @return Userbillinfo
     */
    public function setOrdertaker($ordertaker)
    {
        $this->ordertaker = $ordertaker;

        return $this;
    }

    /**
     * Get ordertaker
     *
     * @return string
     */
    public function getOrdertaker()
    {
        return $this->ordertaker;
    }

    /**
     * Set billstatus
     *
     * @param string $billstatus
     *
     * @return Userbillinfo
     */
    public function setBillstatus($billstatus)
    {
        $this->billstatus = $billstatus;

        return $this;
    }

    /**
     * Get billstatus
     *
     * @return string
     */
    public function getBillstatus()
    {
        return $this->billstatus;
    }

    /**
     * Set lastbill
     *
     * @param \DateTime $lastbill
     *
     * @return Userbillinfo
     */
    public function setLastbill($lastbill)
    {
        $this->lastbill = $lastbill;

        return $this;
    }

    /**
     * Get lastbill
     *
     * @return \DateTime
     */
    public function getLastbill()
    {
        return $this->lastbill;
    }

    /**
     * Set nextbill
     *
     * @param \DateTime $nextbill
     *
     * @return Userbillinfo
     */
    public function setNextbill($nextbill)
    {
        $this->nextbill = $nextbill;

        return $this;
    }

    /**
     * Get nextbill
     *
     * @return \DateTime
     */
    public function getNextbill()
    {
        return $this->nextbill;
    }

    /**
     * Set nextinvoicedue
     *
     * @param integer $nextinvoicedue
     *
     * @return Userbillinfo
     */
    public function setNextinvoicedue($nextinvoicedue)
    {
        $this->nextinvoicedue = $nextinvoicedue;

        return $this;
    }

    /**
     * Get nextinvoicedue
     *
     * @return integer
     */
    public function getNextinvoicedue()
    {
        return $this->nextinvoicedue;
    }

    /**
     * Set billdue
     *
     * @param integer $billdue
     *
     * @return Userbillinfo
     */
    public function setBilldue($billdue)
    {
        $this->billdue = $billdue;

        return $this;
    }

    /**
     * Get billdue
     *
     * @return integer
     */
    public function getBilldue()
    {
        return $this->billdue;
    }

    /**
     * Set postalinvoice
     *
     * @param string $postalinvoice
     *
     * @return Userbillinfo
     */
    public function setPostalinvoice($postalinvoice)
    {
        $this->postalinvoice = $postalinvoice;

        return $this;
    }

    /**
     * Get postalinvoice
     *
     * @return string
     */
    public function getPostalinvoice()
    {
        return $this->postalinvoice;
    }

    /**
     * Set faxinvoice
     *
     * @param string $faxinvoice
     *
     * @return Userbillinfo
     */
    public function setFaxinvoice($faxinvoice)
    {
        $this->faxinvoice = $faxinvoice;

        return $this;
    }

    /**
     * Get faxinvoice
     *
     * @return string
     */
    public function getFaxinvoice()
    {
        return $this->faxinvoice;
    }

    /**
     * Set emailinvoice
     *
     * @param string $emailinvoice
     *
     * @return Userbillinfo
     */
    public function setEmailinvoice($emailinvoice)
    {
        $this->emailinvoice = $emailinvoice;

        return $this;
    }

    /**
     * Get emailinvoice
     *
     * @return string
     */
    public function getEmailinvoice()
    {
        return $this->emailinvoice;
    }

    /**
     * Set batchId
     *
     * @param integer $batchId
     *
     * @return Userbillinfo
     */
    public function setBatchId($batchId)
    {
        $this->batchId = $batchId;

        return $this;
    }

    /**
     * Get batchId
     *
     * @return integer
     */
    public function getBatchId()
    {
        return $this->batchId;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return Userbillinfo
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    /**
     * Get creationdate
     *
     * @return \DateTime
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * Set creationby
     *
     * @param string $creationby
     *
     * @return Userbillinfo
     */
    public function setCreationby($creationby)
    {
        $this->creationby = $creationby;

        return $this;
    }

    /**
     * Get creationby
     *
     * @return string
     */
    public function getCreationby()
    {
        return $this->creationby;
    }

    /**
     * Set updatedate
     *
     * @param \DateTime $updatedate
     *
     * @return Userbillinfo
     */
    public function setUpdatedate($updatedate)
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    /**
     * Get updatedate
     *
     * @return \DateTime
     */
    public function getUpdatedate()
    {
        return $this->updatedate;
    }

    /**
     * Set updateby
     *
     * @param string $updateby
     *
     * @return Userbillinfo
     */
    public function setUpdateby($updateby)
    {
        $this->updateby = $updateby;

        return $this;
    }

    /**
     * Get updateby
     *
     * @return string
     */
    public function getUpdateby()
    {
        return $this->updateby;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
