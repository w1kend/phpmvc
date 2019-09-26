<div class="container">
    <div class="row task-container">
            <div class="col-1 task__user-info">
                <div class="row">
                    <p><?=$task['name'] ? htmlentities($task['name']) : 'name'?></p> 
                </div>
                <div class="row">
                    <p><?=$task['email'] ? $task['email'] : 'email'?></p>
                </div>
            </div>
            <div class="col offset-1 task__text">
                <div class="row">
                    <p> <?=$task['text'] ? htmlentities($task['text']) : 'text'?></p>
                </div>
            </div>
            <div class="col-1">
                <?php if ($auth): ?>
                <div class="row edit-task">
                    <a href="/index/edittask?id=<?=$task['id']?>" class="btn btn-primary">Редактировать</a>
                </div>
                <?php endif;?>
                <?php if ($task['edited']) :?>
                <div class="row task__edited-info">
                    <p><em>Отредактирована администратором</em></p>
                </div>
                <?php endif ?>
                <?php if ($task['completed']): ?>
                <div class="row task__edited-info">
                    <p><em>Выполнена</em></p>
                </div>
                <?php endif;?>

            </div>
    </div>
</div>