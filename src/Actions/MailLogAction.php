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
use src\Components\DependenciesProvider;
use src\Components\Mailer;
use src\Mappers\MailLogMapper;

class MailLogAction extends BaseAction
{
    /**
     * Отправка сообщений по задачам, для которых пришло время нотификации
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return bool
     */
    public function send(Request $request, Response $response, array $args)
    {
        $mailList = MailLogMapper::getMailsForSend();

        if (empty($mailList)) return false;

        foreach ($mailList as $mail) {
            try {
                $result = Mailer::send(unserialize($mail['mailTo']), $mail['title'], $mail['description']);
                if ($result) {
                    MailLogMapper::markAsSent($mail['id']);
                } else {
                    throw new \Exception('Mail not sent');
                }
            } catch (\Exception $e) {
                MailLogMapper::markAsUnsent($mail['id']);
                DependenciesProvider::$logger->addInfo( date('d.m.Y H:i:s') . ': Mail with ID ' . $mail['id'] .
                    ' did not send. Reason: ' . $e->getMessage());
            }

        }
    }


    public function index(Request $request, Response $response, array $args)
    {
        $this->view->render($response, 'mail-log/index.twig', [
            'mails' => MailLogMapper::getAllMails(),
        ]);
    }

}