<?php
/**
 * Created by PhpStorm.
 * User: Scepsis
 * Date: 27.08.2018
 * Time: 11:32
 */

namespace src\Actions;


use Slim\Http\Request;
use Slim\Http\Response;
use src\Mappers\MailLogMapper;

class MailLogAction extends BaseAction
{

    public function send(Request $request, Response $response, array $args)
    {
        $mailList = MailLogMapper::getMailsForSend();

        if (!empty($mailList)) return false;

        foreach ($mailList as $mail) {

        }
    }

}