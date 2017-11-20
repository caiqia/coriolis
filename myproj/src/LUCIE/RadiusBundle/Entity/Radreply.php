<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Jms;

/**
 * Radreply
 *
 * @ORM\Table(name="radreply")
 * @ORM\Entity
 */
class Radreply
{
    /**
      * @var integer
      *
      * @ORM\Column(name="id", type="integer", nullable=false)
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="IDENTITY")
      * @Jms\Exclude()
      */
    private $id;

    /**
      * @var string
      *
      * @ORM\Column(name="username", type="string", nullable=false)
      */
    private $username;

    /**
      * @var string
      *
      * @ORM\Column(name="attribute", type="string", nullable=false)
      */
    private $attribute;

    /**
      * @var string
      *
      * @ORM\Column(name="op", type="string", nullable=false, options={"default":":="})
      */
    private $op;

    /**
      * @var string
      *
      * @ORM\Column(name="value", type="string", nullable=false)
      */
    private $value;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Radreply
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
     * Set attribute
     *
     * @param string $attribute
     *
     * @return Radreply
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set op
     *
     * @param string $op
     *
     * @return Radreply
     */
    public function setOp($op)
    {
        $this->op = $op;

        return $this;
    }

    /**
     * Get op
     *
     * @return string
     */
    public function getOp()
    {
        return $this->op;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Radreply
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
