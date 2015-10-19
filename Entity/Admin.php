<?php

namespace Tec\Ayt\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity
 * @ORM\Table(name="Admins", indexes={@ORM\Index(name="user_idx", columns={"username"})})
 * @UniqueEntity("username")
 */
class Admin implements AdvancedUserInterface, \Serializable
{
    #########################
    ##       METADATA      ##
    #########################

    private static $roles = array (
        'ROLE_SUPER_ADMIN' => 'Super Admin'
    );

    #########################
    ##      PROPERTIES     ##
    #########################

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", unique=TRUE)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $adminId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $role;

    /**
     * @ORM\Column(type="string")
     */
    private $fullName;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="is_account_non_expired", type="boolean")
     */
    private $isAccountNonExpired = true;

    /**
     * @ORM\Column(name="is_account_non_locked", type="boolean")
     */
    private $isAccountNonLocked = true;

    /**
     * @ORM\Column(name="is_credential_non_expired", type="boolean")
     */
    private $isCredentialsNonExpired = true;


    #########################
    ## OBJECT RELATIONSHIP ##
    #########################

    /**
     * @ORM\OneToMany(targetEntity="ActionLog", mappedBy="adminId")
     */
    protected $actionLogs;

    #########################
    ##     CONSTRUCTOR     ##
    #########################

    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->actionLogs = new ArrayCollection();
    }


    #########################
    ##  INTERFACE METHODS  ##
    #########################

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->role);
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {

    }

    /**
     * @inheritDoc
     */
    public function isAccountNonExpired()
    {
        return $this->isAccountNonExpired;
    }

    /**
     * @inheritDoc
     */
    public function isAccountNonLocked()
    {
        return $this->isAccountNonLocked;
    }

    /**
     * @inheritDoc
     */
    public function isCredentialsNonExpired()
    {
        return $this->isCredentialsNonExpired;
    }

    /**
     * @inheritDoc
     */
    public function isEnabled()
    {
       return $this->isActive;
    }

    #########################
    ##    STATIC METHODS   ##
    #########################

    /**
     * @return array
     */
    public static function getAvailableRoles()
    {
        return self::$roles;
    }


    #########################
    ##   SPECIAL METHODS   ##
    #########################

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->adminId,
        ));
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->adminId,
            ) = unserialize($serialized);
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        $roleNames = self::$roles;
        return $roleNames[$this->role];
    }

    #########################
    ## GETTERS AND SETTERS ##
    #########################

    /**
     * Get adminId
     *
     * @return integer
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    #########################
    ##  OBJECT REL: G & S  ##
    #########################

    /**
     * Add actionLog
     *
     * @param \Tec\Ayt\CoreBundle\Entity\ActionLog $actionLog
     * @return User
     */
    public function addActionLog(ActionLog $actionLog)
    {
        $this->actionLogs[] = $actionLog;

        return $this;
    }

    /**
     * Remove actionLog
     *
     * @param \Tec\Ayt\CoreBundle\Entity\ActionLog $actionLog
     */
    public function removeActionLog(ActionLog $actionLog)
    {
        $this->actionLogs->removeElement($actionLog);
    }

    /**
     * Get actionLogs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActionLogs()
    {
        return $this->actionLogs;
    }


}