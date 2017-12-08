<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillingNotificationsSettings
 *
 * @ORM\Table(name="billing_notifications_settings")
 * @ORM\Entity
 */
class BillingNotificationsSettings
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
     * @ORM\Column(name="notification_name", type="string", length=128, nullable=true)
     */
    private $notificationName;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_delay", type="string", length=128, nullable=true)
     */
    private $notificationDelay;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_limittype", type="string", length=128, nullable=true)
     */
    private $notificationLimittype;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_softlimit", type="string", length=128, nullable=true)
     */
    private $notificationSoftlimit;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_hardlimit", type="string", length=128, nullable=true)
     */
    private $notificationHardlimit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=true)
     */
    private $creationdate = '0000-00-00 00:00:00';

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
    private $updatedate = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="updateby", type="string", length=128, nullable=true)
     */
    private $updateby;


}

