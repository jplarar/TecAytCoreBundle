<?php

namespace Tec\Ayt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="ActionLogs")
 */
class ActionLog {

    #########################
    ##       METADATA      ##
    #########################

    private static $actions = array (
        1 => 'Create',
        2 => 'Edit',
        3 => 'Delete',
        4 => 'View'
    );

    #########################
    ##      PROPERTIES     ##
    #########################
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", unique=TRUE)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $actionLogId;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $timestamp;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    protected $action;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $userAgent;

    #########################
    ## OBJECT RELATIONSHIP ##
    #########################

    /**
     * @ORM\ManyToOne(targetEntity="Admin", inversedBy="actionLogs")
     * @ORM\JoinColumn(name="adminId", referencedColumnName="adminId", nullable=true)
     */
    protected $adminId;
    

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

    /**
     * @return mixed
     */
    public function getActionName()
    {
        $actions = self::$actions;
        return $actions[$this->action];
    }


    #########################
    ## GETTERs AND SETTERs ##
    #########################

    /**
     * Get logId
     *
     * @return integer
     */
    public function getActionLogId()
    {
        return $this->actionLogId;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $action
     * @return ActionLog
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
    

    /**
     * @param string $userAgent
     * @return ActionLog
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    #########################
    ##  OBJECT REL: G & S  ##
    #########################

    /**
     * Get AdminId
     * @return \Tec\Ayt\CoreBundle\Entity\Admin
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * Set AdminId
     * @param \Tec\Ayt\CoreBundle\Entity\Admin $adminId
     * @return ActionLog
     */
    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
        return $this;
    }

}