<?php


namespace src\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mail_log")
 **/
class MailLog
{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $fid_task;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $mail_to;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $send_time;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $attempt_num;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $mail_result;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getFidTask(): int
    {
        return $this->fid_task;
    }

    /**
     * @param int $fid_task
     */
    public function setFidTask(int $fid_task)
    {
        $this->fid_task = $fid_task;
    }

    /**
     * @return string
     */
    public function getMailTo(): string
    {
        return $this->mail_to;
    }

    /**
     * @param string $mail_to
     */
    public function setMailTo(string $mail_to)
    {
        $this->mail_to = $mail_to;
    }

    /**
     * @return int
     */
    public function getSendTime(): int
    {
        return $this->send_time;
    }

    /**
     * @param int $send_time
     */
    public function setSendTime(int $send_time)
    {
        $this->send_time = $send_time;
    }

    /**
     * @return int
     */
    public function getAttemptNum(): int
    {
        return $this->attempt_num;
    }

    /**
     * @param int $attempt_num
     */
    public function setAttemptNum(int $attempt_num)
    {
        $this->attempt_num = $attempt_num;
    }

    /**
     * @return int
     */
    public function getMailResult(): int
    {
        return $this->mail_result;
    }

    /**
     * @param int $mail_result
     */
    public function setMailResult(int $mail_result)
    {
        $this->mail_result = $mail_result;
    }
}