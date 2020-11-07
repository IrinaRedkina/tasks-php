<? include ROOT . "/views/layouts/header.php" ?>

<main class="content">
  <div class="container">
    
    <? if (User::checkLogged()) { ?>
      <br><br>
      <div class="text-center">
        <p class="lead">Вход успешно выполнен!</p>
        <a href="/">Перейти к задачам</a>
      </div>
    <? } else { ?>
      <h1 class="page-title text-center">Вход для администратора</h1>
      <form class="user-form" method="post">

        <? if (isset($errors) && is_array($errors)) { ?>
          <ul class="errors list-unstyled">
            <? foreach($errors as $error) { ?>
              <li><?= $error ?></li>
            <? } ?>
          </ul>
        <? } ?>

        <div class="form-group">
          <label for="login-control">Логин</label>
          <input name="login" type="text" class="form-control" id="login-control" value="<?= $options['login'] ?>">
        </div>
        <div class="form-group">
          <label for="pass-control">Пароль</label>
          <input name="password" type="password" class="form-control" id="pass-control" value="<?= $options['password'] ?>">
        </div>
        <div class="text-right">
          <br>
          <button type="submit" name="submit" class="button button-dark button-big">Войти</button>
        </div>
      </form>
    <? } ?>

  </div><!-- / .container -->
</main>


<? include ROOT . "/views/layouts/footer.php" ?>