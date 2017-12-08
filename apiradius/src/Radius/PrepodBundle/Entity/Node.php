<?php

namespace Radius\PrepodBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Node
 *
 * @ORM\Table(name="node", uniqueConstraints={@ORM\UniqueConstraint(name="mac", columns={"mac"})})
 * @ORM\Entity
 */
class Node
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
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=true)
     */
    private $time = '1999-10-10 10:10:10';

    /**
     * @var integer
     *
     * @ORM\Column(name="netid", type="integer", nullable=false)
     */
    private $netid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=20, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=20, nullable=false)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_name", type="string", length=50, nullable=false)
     */
    private $ownerName;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_email", type="string", length=50, nullable=false)
     */
    private $ownerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_phone", type="string", length=25, nullable=false)
     */
    private $ownerPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_address", type="string", length=100, nullable=false)
     */
    private $ownerAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="approval_status", type="string", length=1, nullable=false)
     */
    private $approvalStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=20, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=20, nullable=false)
     */
    private $mac;

    /**
     * @var string
     *
     * @ORM\Column(name="uptime", type="string", length=100, nullable=false)
     */
    private $uptime;

    /**
     * @var string
     *
     * @ORM\Column(name="robin", type="string", length=20, nullable=false)
     */
    private $robin;

    /**
     * @var string
     *
     * @ORM\Column(name="batman", type="string", length=20, nullable=false)
     */
    private $batman;

    /**
     * @var string
     *
     * @ORM\Column(name="memfree", type="string", length=20, nullable=false)
     */
    private $memfree;

    /**
     * @var string
     *
     * @ORM\Column(name="nbs", type="text", length=16777215, nullable=false)
     */
    private $nbs;

    /**
     * @var string
     *
     * @ORM\Column(name="gateway", type="string", length=20, nullable=false)
     */
    private $gateway;

    /**
     * @var string
     *
     * @ORM\Column(name="gw-qual", type="string", length=20, nullable=false)
     */
    private $gwQual;

    /**
     * @var string
     *
     * @ORM\Column(name="routes", type="text", length=16777215, nullable=false)
     */
    private $routes;

    /**
     * @var string
     *
     * @ORM\Column(name="users", type="string", length=3, nullable=false)
     */
    private $users;

    /**
     * @var string
     *
     * @ORM\Column(name="kbdown", type="string", length=20, nullable=false)
     */
    private $kbdown;

    /**
     * @var string
     *
     * @ORM\Column(name="kbup", type="string", length=20, nullable=false)
     */
    private $kbup;

    /**
     * @var string
     *
     * @ORM\Column(name="hops", type="string", length=3, nullable=false)
     */
    private $hops;

    /**
     * @var string
     *
     * @ORM\Column(name="rank", type="string", length=3, nullable=false)
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="ssid", type="string", length=20, nullable=false)
     */
    private $ssid;

    /**
     * @var string
     *
     * @ORM\Column(name="pssid", type="string", length=20, nullable=false)
     */
    private $pssid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gateway_bit", type="boolean", nullable=false)
     */
    private $gatewayBit;

    /**
     * @var string
     *
     * @ORM\Column(name="memlow", type="string", length=20, nullable=false)
     */
    private $memlow;

    /**
     * @var string
     *
     * @ORM\Column(name="usershi", type="string", length=3, nullable=false)
     */
    private $usershi;

    /**
     * @var float
     *
     * @ORM\Column(name="cpu", type="float", precision=10, scale=0, nullable=false)
     */
    private $cpu = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="wan_iface", type="string", length=128, nullable=true)
     */
    private $wanIface;

    /**
     * @var string
     *
     * @ORM\Column(name="wan_ip", type="string", length=128, nullable=true)
     */
    private $wanIp;

    /**
     * @var string
     *
     * @ORM\Column(name="wan_mac", type="string", length=128, nullable=true)
     */
    private $wanMac;

    /**
     * @var string
     *
     * @ORM\Column(name="wan_gateway", type="string", length=128, nullable=true)
     */
    private $wanGateway;

    /**
     * @var string
     *
     * @ORM\Column(name="wifi_iface", type="string", length=128, nullable=true)
     */
    private $wifiIface;

    /**
     * @var string
     *
     * @ORM\Column(name="wifi_ip", type="string", length=128, nullable=true)
     */
    private $wifiIp;

    /**
     * @var string
     *
     * @ORM\Column(name="wifi_mac", type="string", length=128, nullable=true)
     */
    private $wifiMac;

    /**
     * @var string
     *
     * @ORM\Column(name="wifi_ssid", type="string", length=128, nullable=true)
     */
    private $wifiSsid;

    /**
     * @var string
     *
     * @ORM\Column(name="wifi_key", type="string", length=128, nullable=true)
     */
    private $wifiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="wifi_channel", type="string", length=128, nullable=true)
     */
    private $wifiChannel;

    /**
     * @var string
     *
     * @ORM\Column(name="lan_iface", type="string", length=128, nullable=true)
     */
    private $lanIface;

    /**
     * @var string
     *
     * @ORM\Column(name="lan_mac", type="string", length=128, nullable=true)
     */
    private $lanMac;

    /**
     * @var string
     *
     * @ORM\Column(name="lan_ip", type="string", length=128, nullable=true)
     */
    private $lanIp;

    /**
     * @var string
     *
     * @ORM\Column(name="wan_bup", type="string", length=128, nullable=true)
     */
    private $wanBup;

    /**
     * @var string
     *
     * @ORM\Column(name="wan_bdown", type="string", length=128, nullable=true)
     */
    private $wanBdown;

    /**
     * @var string
     *
     * @ORM\Column(name="firmware", type="string", length=128, nullable=true)
     */
    private $firmware;

    /**
     * @var string
     *
     * @ORM\Column(name="firmware_revision", type="string", length=128, nullable=true)
     */
    private $firmwareRevision;


}

