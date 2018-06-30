<?php


namespace src\Actions;

use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

class BaseAction
{

    protected $view;
    protected $logger;

    public function __construct(Twig $view, LoggerInterface $logger)
    {
        $this->view = $view;
        $this->logger = $logger;
    }

}