<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userinfo
 *
 * @ORM\Table(name="userinfo", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class Userinfo
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
     * @ORM\Column(name="firstname", type="string", length=200, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=200, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=200, nullable=true)
     */
    private $department;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=200, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="workphone", type="string", length=200, nullable=true)
     */
    private $workphone;

    /**
     * @var string
     *
     * @ORM\Column(name="homephone", type="string", length=200, nullable=true)
     */
    private $homephone;

    /**
     * @var string
     *
     * @ORM\Column(name="mobilephone", type="string", length=200, nullable=true)
     */
    private $mobilephone;

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
     * @ORM\Column(name="notes", type="string", length=200, nullable=true)
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="changeuserinfo", type="string", length=128, nullable=true)
     */
    private $changeuserinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="portalloginpassword", type="string", length=128, nullable=true)
     */
    private $portalloginpassword = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="enableportallogin", type="integer", nullable=true)
     */
    private $enableportallogin = '0';

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
     * @return Userinfo
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Userinfo
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Userinfo
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Userinfo
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
     * Set department
     *
     * @param string $department
     *
     * @return Userinfo
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Userinfo
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
     * Set workphone
     *
     * @param string $workphone
     *
     * @return Userinfo
     */
    public function setWorkphone($workphone)
    {
        $this->workphone = $workphone;

        return $this;
    }

    /**
     * Get workphone
     *
     * @return string
     */
    public function getWorkphone()
    {
        return $this->workphone;
    }

    /**
     * Set homephone
     *
     * @param string $homephone
     *
     * @return Userinfo
     */
    public function setHomephone($homephone)
    {
        $this->homephone = $homephone;

        return $this;
    }

    /**
     * Get homephone
     *
     * @return string
     */
    public function getHomephone()
    {
        return $this->homephone;
    }

    /**
     * Set mobilephone
     *
     * @param string $mobilephone
     *
     * @return Userinfo
     */
    public function setMobilephone($mobilephone)
    {
        $this->mobilephone = $mobilephone;

        return $this;
    }

    /**
     * Get mobilephone
     *
     * @return string
     */
    public function getMobilephone()
    {
        return $this->mobilephone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Userinfo
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
     * @return Userinfo
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
     * @return Userinfo
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
     * @return Userinfo
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
     * @return Userinfo
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
     * Set notes
     *
     * @param string $notes
     *
     * @return Userinfo
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
     * Set changeuserinfo
     *
     * @param string $changeuserinfo
     *
     * @return Userinfo
     */
    public function setChangeuserinfo($changeuserinfo)
    {
        $this->changeuserinfo = $changeuserinfo;

        return $this;
    }

    /**
     * Get changeuserinfo
     *
     * @return string
     */
    public function getChangeuserinfo()
    {
        return $this->changeuserinfo;
    }

    /**
     * Set portalloginpassword
     *
     * @param string $portalloginpassword
     *
     * @return Userinfo
     */
    public function setPortalloginpassword($portalloginpassword)
    {
        $this->portalloginpassword = $portalloginpassword;

        return $this;
    }

    /**
     * Get portalloginpassword
     *
     * @return string
     */
    public function getPortalloginpassword()
    {
        return $this->portalloginpassword;
    }

    /**
     * Set enableportallogin
     *
     * @param integer $enableportallogin
     *
     * @return Userinfo
     */
    public function setEnableportallogin($enableportallogin)
    {
        $this->enableportallogin = $enableportallogin;

        return $this;
    }

    /**
     * Get enableportallogin
     *
     * @return integer
     */
    public function getEnableportallogin()
    {
        return $this->enableportallogin;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return Userinfo
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
     * @return Userinfo
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
     * @return Userinfo
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
     * @return Userinfo
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
