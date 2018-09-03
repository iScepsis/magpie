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

class MailLogAction extends BaseAction
{

    public function send(Request $request, Response $response, array $args)
    {
        $dql = "SELECT m FROM \src\Entity\MailLog m
                    WHERE (m.attemptNum is null or m.attemptNum < 3) 
                      and (m.mailResult is null or m.mailResult <> 1)
                      ORDER BY m.id DESC
                    ";

        $query = $this->db->createQuery($dql);
        $mailList = $query->getResult();

        foreach ($mailList as $mail) {

        }
    }

}