<?php


namespace src\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="TaskRepository")
 * @ORM\Table(name="tasks")
 */
class Task
{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $time_to_notify;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $is_actual;

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getTimeToNotify(): int
    {
        return $this->time_to_notify;
    }

    /**
     * @param int $time_to_notify
     */
    public function setTimeToNotify(int $time_to_notify)
    {
        $this->time_to_notify = $time_to_notify;
    }

    /**
     * @return int
     */
    public function getIsActual(): int
    {
        return $this->is_actual;
    }

    /**
     * @param int $is_actual
     */
    public function setIsActual($is_actual)
    {
        $this->is_actual = (int)$is_actual;
    }
}