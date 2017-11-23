<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperatorsAclFiles
 *
 * @ORM\Table(name="operators_acl_files")
 * @ORM\Entity
 */
class OperatorsAclFiles
{
    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=128, nullable=false)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=128, nullable=false)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="section", type="string", length=128, nullable=false)
     */
    private $section;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

