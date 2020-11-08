<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= TEMPLATE ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= TEMPLATE ?>/css/style.css">
  <title>Tasks</title>
</head>
<body>
  <header class="site-header">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-sm-3">
          <a href="/" class="logo">
            <img class="logo-img" src="<?= TEMPLATE ?>/img/check.svg" width="30" alt="">
            <span class="logo-text">ToDo</span>
          </a>
        </div>
        <div class="col-sm-9 text-right header-buttons">
          <div class="buttons">
            <a href="/tasks/create" class="button add-button">
              <img src="<?= TEMPLATE ?>/img/add-file.svg" width="15" class="button-icon" alt="">
              Новая задача
            </a>
            <? if (User::isGuest()) { ?>
              <a href="/user/login" class="button login-link">
                <img src="<?= TEMPLATE ?>/img/user.svg" width="15" class="button-icon" alt="">
                Вход
              </a>
            <? } else { ?>
              <a href="/user/logout" class="button login-link">
                <img src="<?= TEMPLATE ?>/img/user.svg" width="15" class="button-icon" alt="">
                <?= User::getUserLogin() ?> | Выход
              </a>
            <? } ?>
          </div>
        </div>
      </div>
    </div>
  </header>