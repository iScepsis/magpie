<?php


namespace src\Actions;


use Slim\Http\Request;
use Slim\Http\Response;
use src\Entity\Tasks;
use src\Exceptions\TasksValidateException;
use src\Validators\TasksValidator;

class TasksAction extends BaseAction
{

    public function index(Request $request, Response $response, array $args)
    {

        $tasks = $this->getTasks();

        $this->view->render($response, 'tasks/index.twig', [
            'tasks' => $tasks
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function create(Request $request, Response $response, array $args)
    {
        $task = new Tasks();

        if ($request->isPost()) {

            $params = $request->getParam('tasks');

            $task->setTitle($params['title']);
            $task->setDescription($params['description']);
            $task->setTimeToNotify($params['time_to_notify']);
            $task->setIsActual($params['is_actual'] ?? null);

            if (TasksValidator::validate($task)) {
                $this->db->persist($task);
                $this->db->flush();
                return $response->withRedirect('/');
            }
        }

        $this->view->render($response, 'tasks/create.twig', [
            'task' => $task,
            'validate' => TasksValidator::$validateLog
        ]);
    }

    /**
     * Получаем массив со всеми задачами
     * @return array
     */
    protected function getTasks()
    {
        $dql = "SELECT  t FROM \src\Entity\Tasks t ORDER BY t.id DESC";

        $query = $this->db->createQuery($dql);
        return $query->getResult();
    }
}