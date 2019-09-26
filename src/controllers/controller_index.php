<?php

use src\core\Controller;
use src\core\Db;
use src\core\Authm;

class Controller_Index extends Controller
{
    public function action_index()
    {
        $db = new Db();
        $res = $db->q('SELECT * from task');
        $this->view->render('index.php', ['tasks' => $res->fetch_all(MYSQLI_ASSOC)]);
    }

    public function action_addtask()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new Db();
            $res = $db->addTask($_POST);
        }
        header('Location: /');
    }

    public function action_edittask()
    {
        $db = new Db();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $res = $db->editTask($_POST);
            header('Location: /');
        } else {
            $auth = (new Authm())->getAuth()->isLoggedIn();
            if ($auth) {
                $id = $_GET['id'];
                $res = $db->q('SELECT * FROM task WHERE id='.$id);
                $this->view->render('editTask.php', ['task' => $res->fetch_assoc()]);
            } else {
                header('Location: /');
            }
        }
    }
}
