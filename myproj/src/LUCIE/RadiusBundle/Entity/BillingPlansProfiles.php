<?php

namespace LUCIE\RadiusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillingPlansProfiles
 *
 * @ORM\Table(name="billing_plans_profiles")
 * @ORM\Entity
 */
class BillingPlansProfiles
{
    /**
     * @var string
     *
     * @ORM\Column(name="plan_name", type="string", length=128, nullable=false)
     */
    private $planName;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_name", type="string", length=256, nullable=true)
     */
    private $profileName;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

