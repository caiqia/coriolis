<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operators
 *
 * @ORM\Table(name="operators", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class Operators
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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=32, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=32, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=32, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=32, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=32, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=32, nullable=false)
     */
    private $department;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=32, nullable=false)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="phone1", type="string", length=32, nullable=false)
     */
    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=32, nullable=false)
     */
    private $phone2;

    /**
     * @var string
     *
     * @ORM\Column(name="email1", type="string", length=32, nullable=false)
     */
    private $email1;

    /**
     * @var string
     *
     * @ORM\Column(name="email2", type="string", length=32, nullable=false)
     */
    private $email2;

    /**
     * @var string
     *
     * @ORM\Column(name="messenger1", type="string", length=32, nullable=false)
     */
    private $messenger1;

    /**
     * @var string
     *
     * @ORM\Column(name="messenger2", type="string", length=32, nullable=false)
     */
    private $messenger2;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=128, nullable=false)
     */
    private $notes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastlogin", type="datetime", nullable=true)
     */
    private $lastlogin = '1999-10-10 10:10:10';

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

