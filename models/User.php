<?

class User
{

  /**
   * Получает информацию о пользовтеле по id
   * @param integer id
   */
  public static function getUserById($id)
  {
    if ($id) {
      $db = Db::getConnection();
      $sql = 'SELECT * FROM user WHERE id = :id';

      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      
      $result->setFetchMode(PDO::FETCH_ASSOC);
      $result->execute();
      
      return $result->fetch();
    }
  }

  /**
   * Проверяет существует ли пользователь с заданными $login и $password
   * @param string $login
   * @param string $password
   * @return mixed : integer user id or false
   */
  public static function checkUserData($login, $password)
  {
    $db = Db::getConnection();
    $sql = 'SELECT id FROM user WHERE password = :password AND login = :login';

    $result = $db->prepare($sql);
    $result->bindParam(':password', $password, PDO::PARAM_STR);
    $result->bindParam(':login', $login, PDO::PARAM_STR);

    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    $user = $result->fetch();

    if ($user) {
      return $user['id'];
    }

    return false;
  }

  /**
   * Получает логин пользовтеля
   * @return string $user['login']
   */
  public static function getUserLogin()
  {
    $userId = self::checkLogged();
    $user = self::getUserById($userId);

    return $user['login'];
  }

  /**
   * Запоминает пользователя
   * @param integer $userId
   */
  public static function auth($userId)
  {
    $_SESSION['user'] = $userId;
  }

  /**
   * Проверяет авторизован ли пользователь
   * @return integer user id
   */
  public static function checkLogged()
  {
    if (isset($_SESSION['user'])) {
      return $_SESSION['user'];
    }

    return false;
  }

  /**
   * Проверяет, является ли пользовтель гостем
   */
  public static function isGuest()
  {
    if (isset($_SESSION['user'])) {
      return false;
    }

    return true;
  }

  /**
   * Проверяет, является ли пользовтель админом
   */
  public static function checkAdmin()
  {
    $userId = self::checkLogged();
    $user = self::getUserById($userId);

    return $user['is_admin'];
  }

}