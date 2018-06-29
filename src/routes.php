<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/test/{name}', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    var_dump($request);
    // Render index view
    return $this->renderer->render($response, 'test.phtml', $args);
});

$app->get('/create-schema/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    /**
     * $db Doctrine\ORM\EntityManager
     */
    $db = $this->db;

    $task = new \src\Entity\Tasks();
    $task->setTitle('Тест');
    $task->setDescription('Тест');
    $task->setTimeToNotify(time());
    $task->setIsActual(1);


    $db->persist($task);
    $db->flush();

    echo "Created User with ID " . $task->getId() . "\n";


    // Render index view
    return $this->renderer->render($response, 'test.phtml', $args);
});