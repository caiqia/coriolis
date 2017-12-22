<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Radiusgroup
 *
 * @ORM\Table(name="radiusgroup", uniqueConstraints={@ORM\UniqueConstraint(name="groupname", columns={"groupname"})})
 * @ORM\Entity
 */
class Radiusgroup
{
    /**
     * @var string
     *
     * @ORM\Column(name="groupname", type="string", length=128, nullable=false)
     */
    private $groupname;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set groupname
     *
     * @param string $groupname
     *
     * @return Radiusgroup
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
