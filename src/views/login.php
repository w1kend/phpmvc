<?php
$errors = isset($errors) ? $errors : [];
?>
<div class="container">
    <div class="row login-form">
        <form action="/auth/login" method='POST' id='login-form'>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class='form-control' name="email" placeholder='Введите email' required>
            </div>
            <div class="form-group">
                <label for="text">Пароль</label>
                <input type="password" class='form-control' name="password" placeholder='Введите пароль' required>
            </div>
            <div class="help-block">
                <div class="row error-block">
                    <?php 
                        foreach ($errors as $er) {
                            echo '<p>' . $er . '</p>';
                        }
                    ?>
                </div>
            </div>
            <div class="form-group">
            <button type='submit' id='add-task-button' class='btn btn-primary'>
                Вход
            </button>
            </div>

        </form>
    </div>
</div>
