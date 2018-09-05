<?php

namespace src\Components;


class Mailer
{
    /**
     * Отправка письма
     * @param array $to - массив адресов для отправки
     * @param string $subject - тема письма
     * @param string $body - содержимое письма
     * @return mixed
     */
    public static function send(array $to, string $subject, string $body){
        $mailer = DependenciesProvider::$slim->get('mailer');
        $mailer->Subject = $subject;
        $mailer->MsgHTML($body);
        foreach ($to as $addr) {
            $mailer->AddAddress($addr);
        }
        return $mailer->Send();
    }
}