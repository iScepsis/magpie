<?php
// DIC configuration

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$container = $app->getContainer();

$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    $view->offsetSet('appUri', $settings['appUri']);
    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//Doctrine
$container['db'] = function ($c) {
    $isDevMode = $c->get('settings')['mode'] != 'production';
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    $conn = array(
        'driver' => 'pdo_sqlite',
        'path' => __DIR__ . '/../src/db/db.sqlite',
    );

// obtaining the entity manager
    return EntityManager::create($conn, $config);
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------
$container['src\Actions\TasksAction'] = function ($c) {
    return new src\Actions\TasksAction($c);
};

$container['mailer'] = function ($c) {
    $settings = $c->get('settings')['mailSettings'];
    $mailer = new \PHPMailer\PHPMailer\PHPMailer();
    $mailer->Username = $settings['mailBox'];
    $mailer->Password = $settings['mailPassword'];
    $mailer->IsSMTP(); // enable SMTP
    $mailer->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mailer->SMTPAuth = true; // authentication enabled
    $mailer->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mailer->Host = "smtp.gmail.com";
    $mailer->Port = 465; // or 587
    $mailer->CharSet = 'UTF-8';
    $mailer->IsHTML(true);
    $mailer->SetFrom($settings['mailBox']);
/*    $mail->Subject = "Test";
    $mail->Body = "hello";
    $mail->AddAddress("email@gmail.com");*/
    return $mailer;
};