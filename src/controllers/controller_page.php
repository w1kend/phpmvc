<?php

use src\core\Controller;
use src\core\Db;
use src\core\Authm;

class Controller_page extends Controller
{
    private $curPage = 1;
    private $maxPage;
    private $range = 3;
    private $totalCount;

    public function action_index()
    {
        $this->curPage = !isset($_GET['p']) ? 1 : $_GET['p'];
        $db = new Db();
        $this->totalCount = $db->q('select count(*) as count from task')->fetch_assoc()['count'];
        $this->maxPage = floor($this->totalCount/$this->range) + 1;
        if ($this->curPage > $this->maxPage) {
            header('Location: /');
            die();
        }
        $from = ($this->curPage - 1) * $this->range;
        $sort = '';
        if (isset($_GET['sortBy'])) {
            $sort = ' ORDER BY ' . $_GET['sortBy'] . ' ';
            $sort .= isset($_GET['sortType']) ? $_GET['sortType'] : 'asc';
        }

        $res = $db->q('SELECT * FROM task' . $sort . ' LIMIT ' . $from . ',' . $this->range);
        $auth = (new Authm())->getAuth()->isLoggedIn();
        $this->view->render('index.php', [
            'tasks' => $res->fetch_all(MYSQLI_ASSOC),
            'page' => $this->curPage,
            'range' => $this->range,
            'totalCount' => $this->totalCount,
            'auth' => $auth ]);
    }

}
