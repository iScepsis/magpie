<?php
/**
 * Created by PhpStorm.
 * User: Scepsis
 * Date: 02.09.2018
 * Time: 21:37
 */

namespace src\Mappers;


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
}