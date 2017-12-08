<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Radhuntgroup
 *
 * @ORM\Table(name="radhuntgroup", indexes={@ORM\Index(name="nasipaddress", columns={"nasipaddress"})})
 * @ORM\Entity
 */
class Radhuntgroup
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
     * @ORM\Column(name="groupname", type="string", length=64, nullable=false)
     */
    private $groupname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nasipaddress", type="string", length=15, nullable=false)
     */
    private $nasipaddress = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nasportid", type="string", length=15, nullable=true)
     */
    private $nasportid;


}

