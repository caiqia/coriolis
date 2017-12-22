<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotspots
 *
 * @ORM\Table(name="hotspots", indexes={@ORM\Index(name="name", columns={"name"}), @ORM\Index(name="mac", columns={"mac"})})
 * @ORM\Entity
 */
class Hotspots
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=200, nullable=true)
     */
    private $mac;

    /**
     * @var string
     *
     * @ORM\Column(name="geocode", type="string", length=200, nullable=true)
     */
    private $geocode;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=200, nullable=true)
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="email_owner", type="string", length=200, nullable=true)
     */
    private $emailOwner;

    /**
     * @var string
     *
     * @ORM\Column(name="manager", type="string", length=200, nullable=true)
     */
    private $manager;

    /**
     * @var string
     *
     * @ORM\Column(name="email_manager", type="string", length=200, nullable=true)
     */
    private $emailManager;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=200, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=200, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="phone1", type="string", length=200, nullable=true)
     */
    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=200, nullable=true)
     */
    private $phone2;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=200, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="companywebsite", type="string", length=200, nullable=true)
     */
    private $companywebsite;

    /**
     * @var string
     *
     * @ORM\Column(name="companyemail", type="string", length=200, nullable=true)
     */
    private $companyemail;

    /**
     * @var string
     *
     * @ORM\Column(name="companycontact", type="string", length=200, nullable=true)
     */
    private $companycontact;

    /**
     * @var string
     *
     * @ORM\Column(name="companyphone", type="string", length=200, nullable=true)
     */
    private $companyphone;

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
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

