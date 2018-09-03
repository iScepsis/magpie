<?php


namespace src\Actions;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Slim\Container;
use src\Components\DependenciesProvider;

class BaseAction
{

    protected $slim;
    protected $view;
    protected $logger;
    /**
     * @var EntityManager
     */
    protected $db;
    protected $mailer;

    /**
     * BaseAction constructor.
     * @param Container $c
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __construct(Container $c)
    {
        DependenciesProvider::init($c);
        $this->slim = $c;
        $this->view = $c->get('view');
        $this->logger = $c->get('logger');
        $this->db = $c->get('db');
        $this->mailer = $c->get('mailer');
    }

}