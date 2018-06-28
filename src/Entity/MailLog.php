<?php

namespace src\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailLog
 *
 * @ORM\Entity
 * @ORM\Table(name="mail_log")
 */
class MailLog
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
     * @var integer
     *
     * @ORM\Column(name="fid_task", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $fidTask;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_to", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $mailTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="send_time", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sendTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="attempt_num", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $attemptNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="mail_result", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $mailResult;


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
     * Set fidTask
     *
     * @param integer $fidTask
     * @return MailLog
     */
    public function setFidTask($fidTask)
    {
        $this->fidTask = $fidTask;

        return $this;
    }

    /**
     * Get fidTask
     *
     * @return integer 
     */
    public function getFidTask()
    {
        return $this->fidTask;
    }

    /**
     * Set mailTo
     *
     * @param string $mailTo
     * @return MailLog
     */
    public function setMailTo($mailTo)
    {
        $this->mailTo = $mailTo;

        return $this;
    }

    /**
     * Get mailTo
     *
     * @return string 
     */
    public function getMailTo()
    {
        return $this->mailTo;
    }

    /**
     * Set sendTime
     *
     * @param integer $sendTime
     * @return MailLog
     */
    public function setSendTime($sendTime)
    {
        $this->sendTime = $sendTime;

        return $this;
    }

    /**
     * Get sendTime
     *
     * @return integer 
     */
    public function getSendTime()
    {
        return $this->sendTime;
    }

    /**
     * Set attemptNum
     *
     * @param integer $attemptNum
     * @return MailLog
     */
    public function setAttemptNum($attemptNum)
    {
        $this->attemptNum = $attemptNum;

        return $this;
    }

    /**
     * Get attemptNum
     *
     * @return integer 
     */
    public function getAttemptNum()
    {
        return $this->attemptNum;
    }

    /**
     * Set mailResult
     *
     * @param integer $mailResult
     * @return MailLog
     */
    public function setMailResult($mailResult)
    {
        $this->mailResult = $mailResult;

        return $this;
    }

    /**
     * Get mailResult
     *
     * @return integer 
     */
    public function getMailResult()
    {
        return $this->mailResult;
    }
}
