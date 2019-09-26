<?php

namespace src\core;

class Db
{
    private $h = '127.0.0.1';
    private $u = 'root';
    private $p = 'root';
    private $dbname = 'test';
    public $mysql;

    public function __construct()
    {
        $this->mysql = new \mysqli($this->h, $this->u, $this->p, $this->dbname);
    }
    public function __desctuct()
    {
        $this->mysql->close();
    }

    public function addTask($data = [])
    {
        if (!empty($data)) {
            $values = '"' . implode('","', array_values($data)) . '"';
            $cols = implode(',', array_keys($data));
            $sql = 'INSERT INTO task ('.$cols. ') '.'VALUES('.$values.')';
            return $this->mysql->query($sql);
        }
        return false;
    }

    public function editTask($data = [])
    {
        if (!empty($data)) {
            $id = $data['id'];
            unset($data['id']);
            $oldText = $this->q('select text from task where id='.$id)->fetch_assoc();
            if (isset($oldText['text']) && $oldText['text'] !== $data['text']) {
                $data['edited'] = 1;
            }
            $lastKey = array_key_last($data);

            $sql = 'UPDATE task SET ';
            foreach ($data as $k=>$v) {
                $sql.= $k . '="' . $v . '" ';
                if ($k !== $lastKey) {
                    $sql .= ', ';
                }
            }
            $sql.= 'WHERE id=' . $id;

            return $this->mysql->query($sql);
        }
        return false;
    }


    public function q($sql)
    {
        return $this->mysql->query($sql);
    }
}
