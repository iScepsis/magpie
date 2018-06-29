<?php
// DIC configuration

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
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
