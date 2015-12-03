<?php

namespace Tec\Ayt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Replies")
 * @ORM\HasLifecycleCallbacks()
 */
class Reply
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
    protected $replyId;

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
     * @ORM\ManyToOne(targetEntity="Topic", inversedBy="replies")
     * @ORM\JoinColumn(name="topicId", referencedColumnName="topicId", nullable=false, onDelete="CASCADE")
     */
    protected $topicId;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="replies")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId", nullable=false)
     */
    protected $userId;


    #########################
    ##     CONSTRUCTOR     ##
    #########################

    // none.

    #########################
    ##    STATIC METHODS   ##
    #########################

    // none.


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


    #########################
    ## GETTERS AND SETTERS ##
    #########################

    /**
     * Get replyId
     *
     * @return integer
     */
    public function getReplyId()
    {
        return $this->replyId;
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
     * @return Topic
     */
    public function getTopicId()
    {
        return $this->topicId;
    }

    /**
     * @param Topic $topicId
     */
    public function setTopicId(Topic $topicId)
    {
        $this->topicId = $topicId;
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