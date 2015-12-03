<?php

namespace Tec\Ayt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="Topics")
 * @ORM\HasLifecycleCallbacks()
 */
class Topic
{
    #########################
    ##       METADATA      ##
    #########################

    // none.

    #########################
    ##      PROPERTIES     ##
    #########################

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", unique=TRUE)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $topicId;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
     */
    protected $content;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $timestamp;

    #########################
    ## OBJECT RELATIONSHIP ##
    #########################

    /**
     * @ORM\OneToMany(targetEntity="Reply", mappedBy="topicId")
     */
    protected $replies;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="topics")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId", nullable=false)
     */
    protected $userId;

    #########################
    ##     CONSTRUCTOR     ##
    #########################

    public function __construct()
    {
        $this->replies = new ArrayCollection();
    }


    #########################
    ##    STATIC METHODS   ##
    #########################

    //none.


    #########################
    ##   SPECIAL METHODS   ##
    #########################

    /**
     * @ORM\PrePersist
     */
    public function setTimestampValue()
    {
        $this->timestamp = new \Datetime("now");;
    }

    public function getRepliesCount()
    {
        return $this->replies->count();
    }

    #########################
    ## GETTERS AND SETTERS ##
    #########################

    /**
     * Get topicId
     *
     * @return integer
     */
    public function getTopicId()
    {
        return $this->topicId;
    }

    /**
     * Get Title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Title
     * @param string $title
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }



    #########################
    ##  OBJECT REL: G & S  ##
    #########################

    /**
     * Add Reply
     *
     * @param \Tec\Ayt\CoreBundle\Entity\Reply $reply
     * @return Topic
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
     * @return User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param User $userId
     */
    public function setUserId(User $userId)
    {
        $this->userId = $userId;
    }

}