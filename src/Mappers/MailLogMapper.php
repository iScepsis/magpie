<?php
/**
 * Created by PhpStorm.
 * User: Scepsis
 * Date: 02.09.2018
 * Time: 21:37
 */

namespace src\Mappers;


use Doctrine\ORM\Query\ResultSetMapping;
use src\Components\DependenciesProvider;
use src\Entity\MailLog;
use src\Entity\Tasks;

class MailLogMapper
{
    /**
     * Помещаем письмо в очередь отправки
     * @param Tasks $task
     */
    public static function createMail(Tasks $task){
        $mailLog = new MailLog();

        $mailLog->setFidTask($task->getId());
        $mailLog->setMailTo(serialize(DependenciesProvider::$settings['userMails']));
        DependenciesProvider::$db->persist($mailLog);
        DependenciesProvider::$db->flush();
    }

    /**
     * Отбираем все сообщения требующие отправки
     * @return mixed
     */
    public static function getMailsForSend(){
        $rsm = new ResultSetMapping();
        // $rsm->addEntityResult('\src\Entity\MailLog', 'm');
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('fid_task', 'fid_task');
        $rsm->addScalarResult('mail_to', 'mailTo');
        $rsm->addScalarResult('send_time', 'sendTime');
        $rsm->addScalarResult('attempt_num', 'attemptNum');
        $rsm->addScalarResult('mail_result', 'mailResult');
        //   $rsm->addJoinedEntityResult('\src\Entity\Tasks' , 'fid_task');
        $rsm->addScalarResult('task_id', 'task_id');
        $rsm->addScalarResult('title', 'title');
        $rsm->addScalarResult('description', 'description');
        $rsm->addScalarResult('time_to_notify', 'timeToNotify');
        $rsm->addScalarResult('is_actual', 'isActual');

        $sql = 'SELECT m.id
                      , m.fid_task
                      , m.mail_to
                      , m.send_time
                      , m.attempt_num
                      , m.mail_result
                      , t.id as task_id
                      , t.title
                      , t.description
                      , t.time_to_notify
                      , t.is_actual
                    FROM mail_log m
                    JOIN tasks t ON t.ID = m.fid_task
                    WHERE (m.attempt_num is null or m.attempt_num < 3) 
                      and (m.mail_result is null or m.mail_result <> 1)
                      and t.is_actual = 1
                      and t.time_to_notify < ?
                      ORDER BY m.id DESC
                    ';

        $query = DependenciesProvider::$db->createNativeQuery($sql, $rsm);
        $query->setParameter(1, time());
        return $query->getResult();
    }

    /**
     * Помечаем сообщение как успешно отправленное
     * @param int $id
     */
    public static function markAsSent(int $id){
        $mail = DependenciesProvider::$db->find('\src\Entity\MailLog', $id);
        $mail->setSendTime(time());
        $mail->setAttemptNum(($mail->getAttemptNum ?? 0) + 1);
        $mail->setMailResult(1);
        DependenciesProvider::$db->persist($mail);
        DependenciesProvider::$db->flush();
    }

    /**
     * Помечаем сообщение как не отправленное
     * @param int $id
     */
    public static function markAsUnsent(int $id){
        $mail = DependenciesProvider::$db->find('\src\Entity\MailLog', $id);
        $mail->setSendTime(null);
        $mail->setAttemptNum(($mail->getAttemptNum ?? 0) + 1);
        $mail->setMailResult(0);
        DependenciesProvider::$db->persist($mail);
        DependenciesProvider::$db->flush();
    }

    public static function getAllMails(){
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('fid_task', 'fid_task');
        $rsm->addScalarResult('mail_to', 'mailTo');
        $rsm->addScalarResult('send_time', 'sendTime');
        $rsm->addScalarResult('attempt_num', 'attemptNum');
        $rsm->addScalarResult('mail_result', 'mailResult');

        $rsm->addScalarResult('task_id', 'task_id');
        $rsm->addScalarResult('title', 'title');
        $rsm->addScalarResult('time_to_notify', 'timeToNotify');
        $rsm->addScalarResult('is_actual', 'isActual');

        $sql = "SELECT m.id
                      , m.fid_task
                      , m.mail_to
                      , m.send_time
                      , m.attempt_num
                      , m.mail_result
                      , t.id as task_id
                      , t.title
                      , t.description
                      , t.time_to_notify
                      , CASE t.is_actual
                          WHEN 1 THEN 'Yes'
                          ELSE 'No'
                        END as is_actual  
                    FROM mail_log m
                    JOIN tasks t ON t.ID = m.fid_task
                    ORDER BY t.time_to_notify DESC
                    ";

        $query = DependenciesProvider::$db->createNativeQuery($sql, $rsm);
        return $query->getResult();
    }
}