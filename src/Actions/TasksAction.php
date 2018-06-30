<?php


namespace src\Actions;


use Slim\Http\Request;
use Slim\Http\Response;

class TasksAction extends BaseAction
{

    public function index(Request $request, Response $response, array $args){
        $this->view->render($response, 'index.twig', $args);
    }
}