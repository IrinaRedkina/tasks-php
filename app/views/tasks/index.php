<? include APP . "/views/layouts/header.php" ?>
<?
  $isSortByName = $sort == 'user_name';
  $isSortByEmail = $sort == 'user_email';
  $isSortByStatus = $sort == 'status';
?>

<main class="content">
  <div class="container">
    <div class="tasks">

      <div class="tasks-header row align-items-center justify-content-between">
        <div class="col-md-4">
          <h1 class="page-title">Задачи</h1>
        </div>
        <div class="col-md-8">
          <div class="sort text-right">
            <a
              href="/sort/user_name/<?= $isSortByName && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
              class="sort-button <?= $isSortByName ? 'active' : '' ?>"
            >
              Пользователь
              <?= $isSortByName && $order == 'DESC' ? '&#8593;' : '&#8595;' ?>
            </a>

            <a
              href="/sort/user_email/<?= $isSortByEmail && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
              class="sort-button <?= $isSortByEmail ? 'active' : '' ?>"
            >
              E-mail
              <?= $isSortByEmail && $order == 'DESC' ? '&#8593;' : '&#8595;' ?>
            </a>

            <a
              href="/sort/status/<?= $isSortByStatus && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
              class="sort-button <?= $isSortByStatus ? 'active' : '' ?>"
            >
              Статус
              <?= $isSortByStatus && $order == 'DESC' ? '&#8593;' : '&#8595;' ?>
            </a>
          </div>
        </div>
      </div>

      <? if (count($tasks)) { ?>
        <ul class="tasks-list list-unstyled">
          <? foreach($tasks as $task) { ?>
            <li class="task">
              <div class="task-status">
                <input
                  type="checkbox"
                  class="task-completed"
                  data-id="<?= $task['id'] ?>"
                  id="check-<?= $task['id'] ?>"
                  <?= User::checkAdmin() ? "" : "disabled" ?>
                  <?= $task['status'] ? "checked" : "" ?>
                />
                <label for="check-<?= $task['id'] ?>"></label>
              </div>
              <div class="task-text"><?= $task['text'] ?></div>
              <div class="task-info">
                <div class="task-info-item">
                  <span class="task-user"><?= $task['user_name'] ?></span>
                  <span class="task-email"><?= $task['user_email'] ?></span>
                </div>
                <div class="task-info-item">
                  <b>статус:</b> <?= $task['status'] ? "выполнено" : "не выполнено" ?>
                </div>
                <? if ($task['edited']) { ?>
                  <div class="task-info-item">
                    <?= $task['edited'] ? "отредактировано администратором" : "" ?>
                  </div>
                <? } ?>
                <? if (User::checkAdmin()) { ?>
                  <div class="task-tools">
                    <a href="/tasks/edit/<?= $task['id'] ?>" class="button button-dark extra-small button-no-border">
                      <img src="<?= TEMPLATE ?>/img/edit.svg" width="20" alt="" title="Редактировать">
                    </a>
                    <a href="/tasks/delete/<?= $task['id'] ?>" class="button button-dark extra-small button-no-border">
                    <img src="<?= TEMPLATE ?>/img/delete.svg" width="20" alt="" title="Удалить">
                    </a>
                  </div>
                <? } ?>
              </div>
            </li>
          <? } ?>
        </ul>

        <?= $pagination->get() ?>
      <? } else { ?>
        <br><br>
        <div class="text-center">
          <p class="lead">У вас нет ни одной задачи</p>
          <a href="/tasks/create">Добавить задачу</a>
        </div>
      <? } ?>
    
    </div><!-- / .tasks -->
  </div><!-- / .container -->
</main>

<? include APP . "/views/layouts/footer.php" ?>