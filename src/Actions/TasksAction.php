<?php


namespace src\Actions;


use Slim\Http\Request;
use Slim\Http\Response;
use src\Entity\Tasks;
use src\Exceptions\NotFoundException;
use src\Exceptions\TasksValidateException;
use src\Mappers\MailLogMapper;
use src\Validators\TasksValidator;

class TasksAction extends BaseAction
{

    public function index(Request $request, Response $response, array $args)
    {
        $tasks = $this->getTasks(true);

        $mailer = $this->mailer;

        $this->view->render($response, 'tasks/index.twig', [
            'tasks' => $tasks
        ]);
    }

    public function archive(Request $request, Response $response, array $args)
    {
        $tasks = $this->getTasks(false);

        $this->view->render($response, 'tasks/archive.twig', [
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

                if (!empty($task->getTimeToNotify())) {
                    MailLogMapper::createMail($task);
                }

                return $response->withRedirect($request->getUri()->withPath(
                    $this->slim->router->pathFor('tasks/index')
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
                return $response->withRedirect($request->getUri()->withPath(
                    $this->slim->router->pathFor('tasks/index')
                ));
            }
        }

        $this->view->render($response, 'tasks/update.twig', [
            'task' => $task,
            'validate' => TasksValidator::$validateLog
        ]);
    }

    /**
     * Активация/деактивация задачи
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws NotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function toggle(Request $request, Response $response, array $args)
    {
        $task = $this->db->find('src\Entity\Tasks', $request->getParam('id'));
        try {
            if ($task !== null) {
                $task->setIsActual((int)$request->getParam('status'));

                if (TasksValidator::validate($task)) {
                    $this->db->persist($task);
                    $this->db->flush();
                    return $response->withJson(['result' => true]);
                }
            } else  throw new NotFoundException("Task with {$request->getParam('id')} not found!");
        } catch (\Exception $e) {
            return $response->withJson(['result' => false, 'message' => $e->getMessage()]);
        }


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