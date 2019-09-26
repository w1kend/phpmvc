<?php

require 'vendor/autoload.php';

use JasonGrimes\Paginator;

$auth = isset($auth) ? $auth : false;
$urlPattern = '/page?p=(:num)';

if (isset($_GET['sortBy'])) {
  $sortBy = $_GET['sortBy'];
  $sortType = $_GET['sortType'] ?? 'asc';
  $urlPattern .= '&sortBy=' . $sortBy. '&sortType=' . $sortType; 
}

$paginator = new Paginator($totalCount,$range,$page,$urlPattern);
$paginator->setMaxPagesToShow(11);
?>

<div class="container">
      <div class="row sort-links">
        <a href="#" id="sort_name" class="sort-link btn btn-primary btn-sm">name</a>
        <a href="#" id="sort_email" class="sort-link btn btn-primary btn-sm">email</a>
        <a href="#" id="sort_text" class="sort-link btn btn-primary btn-sm">text</a>
        <?php if (!$auth):?>
        <a href="/auth" class="login btn btn-primary btn-sm">Вход</a>
        <?php else : ?>
        <a href="/auth/logout" class="login btn btn-primary btn-sm">Выход</a>
        <?php endif;?>
      </div>
    <div class="row">
        <?php
            foreach ($tasks as $task) {
                include 'src/views/task.php';
            }
        ?>
    </div>
    <div class="row">
      <div class="col-1 addtask-button">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTask">
              +
          </button>
      </div>
      <div class="col-4">
        <div class="row paginator">
            <?php
              echo $paginator;
            ?>
        </div>
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="addTaskTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTaskLongTitle">Добавление задачи</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- FORM -->
      <form action="/index/addtask" method='POST' id='add-task-form'>
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class='form-control' name="name" placeholder='Введите имя' required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class='form-control' name="email" placeholder='Введите email' required>
        </div>
        <div class="form-group">
            <label for="text">Тест задачи</label>
            <input type="text" class='form-control' name="text" placeholder='Введите текст задачи' required>
        </div>
        <button type='submit' id='add-task-button' class='btn btn-primary'>
            Добавить задачу
        </button>
        </form>
        <!-- End form -->
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
<!-- End Modal -->
</div>
</div>
