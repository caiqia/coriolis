<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperatorsAcl
 *
 * @ORM\Table(name="operators_acl")
 * @ORM\Entity
 */
class OperatorsAcl
{
    /**
     * @var integer
     *
     * @ORM\Column(name="operator_id", type="integer", nullable=false)
     */
    private $operatorId;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=128, nullable=false)
     */
    private $file;

    /**
     * @var boolean
     *
     * @ORM\Column(name="access", type="boolean", nullable=false)
     */
    private $access = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

