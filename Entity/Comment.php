<?php

namespace Tec\Ayt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Comments")
 * @ORM\HasLifecycleCallbacks()
 */
class Comment
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
    protected $commentId;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
     */
    protected $content;

    #########################
    ## OBJECT RELATIONSHIP ##
    #########################

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="postId", referencedColumnName="postId", nullable=false)
     */
    protected $postId;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId", nullable=false)
     */
    protected $userId;

    #########################
    ##     CONSTRUCTOR     ##
    #########################

    //none.


    #########################
    ##    STATIC METHODS   ##
    #########################

    //none.


    #########################
    ##   SPECIAL METHODS   ##
    #########################

    //none.


    #########################
    ## GETTERS AND SETTERS ##
    #########################

    /**
     * Get commentId
     *
     * @return integer
     */
    public function getCommentId()
    {
        return $this->commentId;
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


    #########################
    ##  OBJECT REL: G & S  ##
    #########################

    /**
     * @return Post
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param Post $postId
     */
    public function setPostId(Post $postId)
    {
        $this->postId = $postId;
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