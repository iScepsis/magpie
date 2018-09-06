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
$app->get('/mail-log/index', 'src\Actions\MailLogAction:index');
$app->get('/mail-log/send', 'src\Actions\MailLogAction:send');