<?php


namespace src\Actions;


use Slim\Http\Request;
use Slim\Http\Response;
use src\Entity\Tasks;

class TasksAction extends BaseAction
{

    public function index(Request $request, Response $response, array $args){

        $tasks = $this->getTasks();

        $this->view->render($response, 'tasks/index.twig', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Создание задачи
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function create(Request $request, Response $response, array $args){

        $tasks = $this->getTasks();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $task = new Tasks();
            $task->setTitle($_POST['tasks']['title']);
            $task->setTitle($_POST['tasks']['description']);
            $task->setTitle($_POST['tasks']['time_to_notify']);
            $task->setTitle($_POST['tasks']['is_actual']);
        }

        $this->view->render($response, 'tasks/create.twig', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Получаем массив со всеми задачами
     * @return array
     */
    protected function getTasks(){
        $dql = "SELECT  t FROM \src\Entity\Tasks t ";

        $query = $this->db->createQuery($dql);
        return $query->getResult();
    }
}