<?

class TaskController
{

  const COUNT_TO_SHOW = 3;
  const MIN_NAME_LENGTH = 2;
  const MIN_TEXT_LENGTH = 5;

  private function closeNonAdminAccess()
  {
    if (!User::checkAdmin()) {
      header('Location: /user/login');
      die();
    }
  }

  private function validateTaskData($options)
  {
    $errors = false;

    if (empty($options['name'])) {
      $errors[] = 'Вы не заполнили поле Имя';
    } else if (strlen($options['name']) < self::MIN_NAME_LENGTH) {
      $errors[] = 'Имя должно быть не короче ' . self::MIN_NAME_LENGTH . 'х символов';
    }

    if (empty($options['email'])) {
      $errors[] = "Вы не заполнили поле E-mail";
    } elseif ( filter_var($options['email'], FILTER_VALIDATE_EMAIL) === false) { 
      $errors[] = "Некорректный email";
    }

    if (empty($options['text'])) {
      $errors[] = 'Вы не заполнили поле Текст задачи';
    } else if (strlen($options['text']) < self::MIN_TEXT_LENGTH) {
      $errors[] = 'Текст должен содержать от ' . self::MIN_TEXT_LENGTH . 'х символов';
    }

    return $errors;
  }

  public function actionIndex($sort = 'id', $order = 'DESC', $page = 1)
  {
    $tasks = Task::getTasks(self::COUNT_TO_SHOW, $page, $sort, $order);

    $total = Task::getTotalTasksCount();
    $pagination = new Pagination($total, $page, self::COUNT_TO_SHOW, 'page-');

    require_once(APP . '/views/tasks/index.php');
    return true;
  }

  public function actionCreate()
  {
    $options['name'] = '';
    $options['email'] = '';
    $options['text'] = '';
    $isSuccess = false;

    if (isset($_POST['submit'])) {
      $options['name'] = trim(htmlspecialchars($_POST['name']));
      $options['email'] = trim(htmlspecialchars($_POST['email']));
      $options['text'] = trim(htmlspecialchars($_POST['text']));

      $errors = self::validateTaskData($options);

      // Если ошибок нет
      if ($errors == false && Task::createTask($options)) {
        $options['text'] = '';
        $isSuccess = true;
      }
    }

    require_once(APP . '/views/tasks/add.php');
    return true;
  }

  public function actionUpdate($id)
  {
    self::closeNonAdminAccess();

    $task = Task::getTaskById($id);
    $isSuccess = false;

    if (isset($_POST['submit'])) {
      $options['name'] = trim(htmlspecialchars($_POST['name']));
      $options['email'] = trim(htmlspecialchars($_POST['email']));
      $options['text'] = trim(htmlspecialchars($_POST['text']));
      $options['status'] = isset($_POST['status']);
      $options['edited'] = $task['text'] != $options['text'];

      if ($task['text'] == $options['text'] && $task['edited'] == 1) {
        $options['edited'] = 1;
      }

      $errors = self::validateTaskData($options);

      // Если ошибок нет
      if ($errors == false && Task::updateTaskById($id, $options)) {
        $task['user_name'] = $options['name'];
        $task['user_email'] = $options['email'];
        $task['text'] = $options['text'];
        $task['status'] = $options['status'];
        $isSuccess = true;
        header('Location: /');
      }
    }

    require_once(APP . '/views/tasks/edit.php');
    return true;
  }

  public function actionCompleted($id)
  {
    $task = Task::getTaskById($id);
    $status = !$task['status'];

    Task::сompletedTaskById($id, $status);


    echo "<pre>";
    print_r($task);
    echo "</pre>";
  }

  public function actionDelete($id)
  {
    self::closeNonAdminAccess();
    Task::deleteTaskById($id);
    header('Location: /');
  }
}