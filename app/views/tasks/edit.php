<? include APP . "/views/layouts/header.php" ?>

<main class="content">
  <div class="container">

    <h1 class="page-title text-center">Редактирование задачи</h1>
    <form class="user-form" method="post">

      <? if (isset($errors) && is_array($errors)) { ?>
        <ul class="errors list-unstyled">
          <? foreach($errors as $error) { ?>
            <li><?= $error ?></li>
          <? } ?>
        </ul>
      <? } ?>

      <? if ($isSuccess) { ?>
        <div class="alert alert-success" role="alert">
          Задача успешно отредактирована!
        </div>
      <? } ?>

      <div class="form-group">
        <label for="name-control">Имя</label>
        <input name="name" type="text" class="form-control" id="name-control" value="<?= $task['user_name'] ?>">
      </div>
      <div class="form-group">
        <label for="email-control">E-mail</label>
        <input name="email" type="text" class="form-control" id="email-control" value="<?= $task['user_email'] ?>">
      </div>
      <div class="form-group">
        <label for="text-control">Текст задачи</label>
        <textarea name="text" class="form-control" id="text-control"><?= $task['text'] ?></textarea>
      </div>
      <div class="form-check">
        <input name="status" class="form-check-input" type="checkbox" <?= $task['status'] ? 'checked' : '' ?> id="task-checked">
        <label class="form-check-label" for="task-checked">
          Выполнено
        </label>
      </div>
      <div class="text-right">
        <br>
        <button type="submit" name="submit" class="button button-dark button-big">Сохранить</button>
      </div>
    </form>

  </div><!-- / .container -->
</main>

<? include APP . "/views/layouts/footer.php" ?>