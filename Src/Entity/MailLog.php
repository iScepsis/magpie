<?php

namespace Src\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailLog
 *
 * @ORM\Table(name="mail_log")
 * @ORM\Entity
 */
class MailLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="fid_task", type="integer", nullable=false)
     */
    private $fidTask;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_to", type="text", nullable=false)
     */
    private $mailTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="send_time", type="integer", nullable=false)
     */
    private $sendTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="attempt_num", type="integer", nullable=false)
     */
    private $attemptNum;

    /**
     * @var integer
     *
     * @ORM\Column(name="mail_result", type="integer", nullable=false)
     */
    private $mailResult;


}
