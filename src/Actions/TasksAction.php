<?php


namespace src\Actions;


use Slim\Http\Request;
use Slim\Http\Response;
use src\Entity\Tasks;
use src\Exceptions\NotFoundException;
use src\Exceptions\TasksValidateException;
use src\Validators\TasksValidator;

class TasksAction extends BaseAction
{

    public function index(Request $request, Response $response, array $args)
    {
        $tasks = $this->getTasks(false);

        $this->view->render($response, 'tasks/index.twig', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Создание задачи
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
                return $response->withRedirect( $request->getUri()->withPath(
                    $this->slim->router->pathFor('index')
                ));
            }
        }

        $this->view->render($response, 'tasks/create.twig', [
            'task' => $task,
            'validate' => TasksValidator::$validateLog
        ]);
    }

    /**
     * Обновление задачи
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function update(Request $request, Response $response, array $args)
    {
        $task = $this->db->find('src\Entity\Tasks', $request->getAttribute('id'));

        if ($request->isPost()) {

            $params = $request->getParam('tasks');

            $task->setTitle($params['title']);
            $task->setDescription($params['description']);
            $task->setTimeToNotify($params['time_to_notify']);
            $task->setIsActual($params['is_actual'] ?? null);

            if (TasksValidator::validate($task)) {
                $this->db->persist($task);
                $this->db->flush();
                return $response->withRedirect( $request->getUri()->withPath(
                    $this->slim->router->pathFor('index')
                ));
            }
        }

        $this->view->render($response, 'tasks/create.twig', [
            'task' => $task,
            'validate' => TasksValidator::$validateLog
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws NotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function toggle(Request $request, Response $response, array $args){
        $task = $this->db->find('src\Entity\Tasks', $request->getParam('id'));
        if ($task !== null) {
            $task->setIsActual($request->getParam('status'));

            if (TasksValidator::validate($task)) {
                $this->db->persist($task);
                $this->db->flush();
                return $response->withJson(true);
            }
        } else  throw new NotFoundException("Task with {$request->getParam('id')} not found!");
        return $response->withJson(false);
    }

    /**
     * Получаем массив со всеми задачами
     * @return array
     */
    protected function getTasks($activeOnly = true)
    {
        $where = "";

        if ($activeOnly) $where .= " WHERE t.isActual = 1 ";

        $dql = " SELECT t FROM \src\Entity\Tasks t " . $where . " ORDER BY t.id DESC ";

        $query = $this->db->createQuery($dql);
        return $query->getResult();
    }
}