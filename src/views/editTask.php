<div class="container">
    <div class="row">
        <form action="/index/edittask" method='POST' id='edit-task-form'>
            <input type="hidden" name='id' value='<?=$task['id']?>'>
            <input type="hidden" id='complete-input' name='completed' value='<?=$task['completed']?>'>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class='form-control' name="name" value='<?=$task['name']?>' disabled>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class='form-control' name="email" value='<?=$task['email']?>' disabled>
            </div>
            <div class="form-group">
                <label for="text">Текст задачи</label>
                <input type="text" class='form-control' name="text" value='<?=$task['text']?>' required>
            </div>
            <div class="form-group">
                <label for="completed">Выполнена</label>
                <input type="checkbox" <?=$task['completed'] ? 'checked' : ''?>>
            </div>
            <button type='submit' id='edit-task-button' class='btn btn-primary'>
                Сохранить
            </button>
        </form>
    </div>
</div>
