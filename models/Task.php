<?

class Task
{

  const SHOW_BY_DEFAULT = 3;

  /**
   * Получает задачу по id
   * @param integer $id
   */
  public static function getTaskById($id)
  {
    if ($id) {
      $db = Db::getConnection();
      $sql = 'SELECT * FROM task WHERE id = :id';
  
      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
  
      $result->setFetchMode(PDO::FETCH_ASSOC);
      $result->execute();
  
      return $result->fetch();
    }
  }

  /**
   * Получает колличество задач
   */
  public static function getTotalTasksCount()
  {
    $db = Db::getConnection();

    $result = $db->query('SELECT * FROM task');
    $count_result = $db->query('SELECT FOUND_ROWS()');

    return $count_result->fetchColumn();
  }

  /**
   * Получает задачи
   * @param integer $count
   * @param integer $page
   * $param string $sort
   * $param string $order
   */
  public static function getTasks($count = self::SHOW_BY_DEFAULT, $page = 1, $sort, $order)
  {
    $page = intval($page);
    $offset = ($page - 1) * $count;
    $tasks = array();

    $db = Db::getConnection();

    $result = $db->query('SELECT * '
      . 'FROM task '
      . 'ORDER BY ' . $sort . ' ' . $order . ' '
      . 'LIMIT ' . $count
      . ' OFFSET ' . $offset);

    $i = 0;
    while($row = $result->fetch()) {
      $tasks[$i]['id'] = $row['id'];
      $tasks[$i]['user_name'] = $row['user_name'];
      $tasks[$i]['user_email'] = $row['user_email'];
      $tasks[$i]['text'] = $row['text'];
      $tasks[$i]['status'] = $row['status'];
      $tasks[$i]['edited'] = $row['edited'];
      $i++;
    }

    return $tasks;
  }

  /**
   * Создает новую задачу
   * @param array $options
   * @return integer id добавленной записи или 0
   * 
   */
  public static function createTask($options)
  {
    $db = Db::getConnection();
    $sql = 'INSERT INTO task (user_email, user_name, text) VALUES (:email, :name, :text)';

    $result = $db->prepare($sql);
    $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
    $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
    $result->bindParam(':text', $options['text'], PDO::PARAM_STR);
    
    if ($result->execute()) {
      return $db->lastInsertId();
    }

    return 0;
  }

  /**
   * Обновляет задачу
   * @param array $options
   * @return integer id обновленной записи или 0
   * 
   */
  public static function updateTaskById($id, $options)
  {
    $db = Db::getConnection();
    $sql = 'UPDATE task
      SET
        user_email = :email,
        user_name = :name,
        text = :text,
        status = :status,
        edited = :edited
      WHERE id = :id';

    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
    $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
    $result->bindParam(':text', $options['text'], PDO::PARAM_STR);
    $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
    $result->bindParam(':edited', $options['edited'], PDO::PARAM_INT);

    return $result->execute();
  }

  /**
   * Обнавляет статус задачи
   * @param integer $id
   * @param integer $status
   * 
   */
  public static function сompletedTaskById($id, $status)
  {
    $db = Db::getConnection();
    $sql = 'UPDATE task
      SET
        status = :status
      WHERE id = :id';

    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':status', $status, PDO::PARAM_INT);

    return $result->execute();
  }

  /**
   * Удаляет задачу
   * @param integer $id
   * @return boolean
   * 
   */
  public static function deleteTaskById($id)
  {
    if ($id) {
      $db = Db::getConnection();
      $sql = 'DELETE FROM task WHERE id = :id';
  
      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      return $result->execute();
    }
  }

}