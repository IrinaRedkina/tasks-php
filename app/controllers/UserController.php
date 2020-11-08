<?

class UserController
{

  const MIN_LOGIN_LENGTH = 2;
  const MIN_PASSWORD_LENGTH = 3;

  private function validateUserData($options)
  {
    $errors = false;

    if (empty($options['login'])) {
      $errors[] = 'Укажите, пожалуйста, ваш логин';
    } else if (strlen($options['login']) < self::MIN_LOGIN_LENGTH) {
      $errors[] = 'Слишком короткий логин';
    }

    if (empty($options['password'])) {
      $errors[] = 'Укажите, пожалуйста, ваш пароль';
    } else if (strlen($options['password']) < self::MIN_PASSWORD_LENGTH) {
      $errors[] = 'Пароль не может быть короче ' . self::MIN_PASSWORD_LENGTH . 'x символов';
    }

    return $errors;
  }

  public function actionLogin()
  {
    $options['login'] = '';
    $options['password'] = '';

    if (isset($_POST['submit'])) {
      $options['login'] = trim($_POST['login']);
      $options['password'] = trim($_POST['password']);

      $errors = self::validateUserData($options);

      // Проверка пользователя
      if (!empty($options['login']) && !empty($options['password'])) {
        $userId = User::checkUserData($options['login'], $options['password']);

        if ($userId == false) {
          $errors[] = 'Неправильные данные для входа на сайт';
        } else {
          User::auth($userId);
        }
      }
    }

    require_once(APP . '/views/user/login.php');
    return true;
  }

  public function actionLogout()
  {
    unset($_SESSION['user']);
    header('Location: /');
  }

}