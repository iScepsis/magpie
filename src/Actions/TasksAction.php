<?php


namespace src\Actions;


use Slim\Http\Request;
use Slim\Http\Response;

class TasksAction extends BaseAction
{

    public function index(Request $request, Response $response, array $args){

        $tasks = $this->getTasks();

        $this->view->render($response, 'index.twig', [
            'tasks' => $tasks
        ]);
    }

    protected function getTasks(){
        $dql = "SELECT  t FROM \src\Entity\Tasks t ";

        $query = $this->db->createQuery($dql);
        return $query->getResult();
    }
}