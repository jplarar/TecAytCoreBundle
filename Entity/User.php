<?php

namespace Tec\Ayt\CoreBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="Users", indexes={@ORM\Index(name="user_idx", columns={"username"})})
 * @UniqueEntity("username")
 */
class User implements AdvancedUserInterface, \Serializable
{
    #########################
    ##       METADATA      ##
    #########################

    private static $educations = array (
        1 => 'Primaria',
        2 => 'Secundaria',
        3 => 'Bachillerato',
        4 => 'Licenciatura',
        5 => 'Maestria',
        6 => 'Doctorado'
    );

    private static $roles = array (
        'ROLE_FRIEND' => 'Asociado Amigo',
        'ROLE_ACTIVE' => 'Asociado Activo'
    );

    #########################
    ##      PROPERTIES     ##
    #########################

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", unique=TRUE)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $userId;

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
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="smallint")
     */
    private $gender;

    /**
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $work;

    /**
     * @ORM\Column(type="string")
     */
    private $education;

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
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="userId")
     */
    protected $comments;

    /**
     * @ORM\OneToMany(targetEntity="Reply", mappedBy="userId")
     */
    protected $replies;

    /**
     * @ORM\OneToMany(targetEntity="Topic", mappedBy="userId")
     */
    protected $topics;

    #########################
    ##     CONSTRUCTOR     ##
    #########################

    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->comments = new ArrayCollection();
        $this->replies = new ArrayCollection();
        $this->topics = new ArrayCollection();
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

    /**
     * @return array
     */
    public static function getAvailableEducations()
    {
        return self::$educations;
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
            $this->userId,
        ));
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->userId,
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

    /**
     * @return mixed
     */
    public function getEducationName()
    {
        $educationNames = self::$educations;
        return $educationNames[$this->education];
    }

    #########################
    ## GETTERS AND SETTERS ##
    #########################

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
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

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param mixed $education
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    /**
     * @return mixed
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * @param mixed $work
     */
    public function setWork($work)
    {
        $this->work = $work;
    }




    #########################
    ##  OBJECT REL: G & S  ##
    #########################

    /**
     * Add comments
     *
     * @param \Tec\Ayt\CoreBundle\Entity\Comment $comment
     * @return User
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Tec\Ayt\CoreBundle\Entity\Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add Reply
     *
     * @param \Tec\Ayt\CoreBundle\Entity\Reply $reply
     * @return User
     */
    public function addReply(Reply $reply)
    {
        $this->replies[] = $reply;

        return $this;
    }

    /**
     * Remove Reply
     *
     * @param \Tec\Ayt\CoreBundle\Entity\Reply $reply
     */
    public function removeReply(Reply $reply)
    {
        $this->replies->removeElement($reply);
    }

    /**
     * Get Replies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * Add topic
     *
     * @param \Tec\Ayt\CoreBundle\Entity\Topic $topic
     * @return User
     */
    public function addTopic(Topic $topic)
    {
        $this->replies[] = $topic;

        return $this;
    }

    /**
     * Remove topic
     *
     * @param \Tec\Ayt\CoreBundle\Entity\Topic $topic
     */
    public function removeTopic(Topic $topic)
    {
        $this->replies->removeElement($topic);
    }

    /**
     * Get topics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTopics()
    {
        return $this->topics;
    }

}