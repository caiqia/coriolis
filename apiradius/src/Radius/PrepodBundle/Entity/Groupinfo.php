<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupinfo
 *
 * @ORM\Table(name="groupinfo", uniqueConstraints={@ORM\UniqueConstraint(name="groupname", columns={"groupname"})})
 * @ORM\Entity
 */
class Groupinfo
{
    /**
     * @var string
     *
     * @ORM\Column(name="groupname", type="string", length=64, nullable=false)
     */
    private $groupname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Radius\PrepodBundle\Entity\Userinfo", mappedBy="groupname")
     */
    private $username;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->username = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set groupname
     *
     * @param string $groupname
     *
     * @return Groupinfo
     */
    public function setGroupname($groupname)
    {
        $this->groupname = $groupname;

        return $this;
    }

    /**
     * Get groupname
     *
     * @return string
     */
    public function getGroupname()
    {
        return $this->groupname;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Groupinfo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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

    /**
     * Add username
     *
     * @param \Radius\PrepodBundle\Entity\Userinfo $username
     *
     * @return Groupinfo
     */
    public function addUsername(\Radius\PrepodBundle\Entity\Userinfo $username)
    {
        $this->username[] = $username;

        return $this;
    }

    /**
     * Remove username
     *
     * @param \Radius\PrepodBundle\Entity\Userinfo $username
     */
    public function removeUsername(\Radius\PrepodBundle\Entity\Userinfo $username)
    {
        $this->username->removeElement($username);
    }

    /**
     * Get username
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsername()
    {
        return $this->username;
    }
}
