<?php

namespace Tec\Ayt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Documents")
 * @ORM\HasLifecycleCallbacks()
 */
class Document
{
    #########################
    ##       METADATA      ##
    #########################

    private static $roles = array (
        1 => 'Amigo',
        2 => 'Activo',
        3 => 'Libre'
    );


    #########################
    ##      PROPERTIES     ##
    #########################

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", unique=TRUE)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $documentId;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    protected $description;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     * @Assert\NotBlank()
     */
    protected $role;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    protected $fileName;

    #########################
    ## OBJECT RELATIONSHIP ##
    #########################

    // none.

    #########################
    ##     CONSTRUCTOR     ##
    #########################

    public function __construct()
    {

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
     * Get documentId
     *
     * @return integer
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * Get Name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Name
     * @param string $name
     * @return Document
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }



    #########################
    ##  OBJECT REL: G & S  ##
    #########################

    // none.

}