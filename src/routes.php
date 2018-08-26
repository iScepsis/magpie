<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', 'src\Actions\TasksAction:index')->setName('index'); //TODO: redirect
$app->get('/tasks/index', 'src\Actions\TasksAction:index')->setName('tasks/index');
$app->get('/tasks/archive', 'src\Actions\TasksAction:archive');
$app->any('/tasks/create', 'src\Actions\TasksAction:create');
$app->any('/tasks/update/{id}', 'src\Actions\TasksAction:update');

$app->post('/tasks/toggle', 'src\Actions\TasksAction:toggle');


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
    /*$db = $this->db;

    $task = new \src\Entity\Tasks();
    $task->setTitle('Тест');
    $task->setDescription('Тест');
    $task->setTimeToNotify(time());
    $task->setIsActual(1);


    $db->persist($task);
    $db->flush();

    echo "Created User with ID " . $task->getId() . "\n";*/


    // Render index view
    return $this->view->render($response, 'index.twig', $args);
});