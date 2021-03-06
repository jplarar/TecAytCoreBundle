<?php

namespace Tec\Ayt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="Banners")
 */
class Banner
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
    protected $bannerId;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $fileName;

    /**
     * @var UploadedFile
     */
    protected $file;

    #########################
    ## OBJECT RELATIONSHIP ##
    #########################

    // none.


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

    public function uploadFile($path)
    {
        $file = $this->file;
        $name = sprintf('%s%s%s%s.%s', date('Y'), date('m'), date('d'), uniqid(), $file->getClientOriginalExtension());
        $file->move($path,$name);
        $this->fileName = $name;
    }


    #########################
    ## GETTERS AND SETTERS ##
    #########################

    /**
     * Get bannerId
     *
     * @return integer
     */
    public function getBannerId()
    {
        return $this->bannerId;
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
     * @return Banner
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     * @return Event
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
        return $this;
    }


    #########################
    ##  OBJECT REL: G & S  ##
    #########################

    // none.

}