<?php

namespace Src\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks")
 * @ORM\Entity
 */
class Tasks
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="time_to_notify", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $timeToNotify;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_actual", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isActual;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Tasks
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tasks
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set timeToNotify
     *
     * @param integer $timeToNotify
     * @return Tasks
     */
    public function setTimeToNotify($timeToNotify)
    {
        $this->timeToNotify = $timeToNotify;

        return $this;
    }

    /**
     * Get timeToNotify
     *
     * @return integer 
     */
    public function getTimeToNotify()
    {
        return $this->timeToNotify;
    }

    /**
     * Set isActual
     *
     * @param integer $isActual
     * @return Tasks
     */
    public function setIsActual($isActual)
    {
        $this->isActual = $isActual;

        return $this;
    }

    /**
     * Get isActual
     *
     * @return integer 
     */
    public function getIsActual()
    {
        return $this->isActual;
    }
}
