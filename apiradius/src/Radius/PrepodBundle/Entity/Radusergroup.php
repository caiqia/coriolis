<?php
namespace Radius\PrepodBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Radusergroup
 *
 * @ORM\Table(name="radusergroup")
 * @ORM\Entity
 */
class Radusergroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority = '1';
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(name="groupname", type="string", length=64)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $groupname;
    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return Radusergroup
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }
    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }
    /**
     * Set username
     *
     * @param string $username
     *
     * @return Radusergroup
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
     * Set groupname
     *
     * @param string $groupname
     *
     * @return Radusergroup
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
}
