<?php

namespace src\core;

class View
{
    public $template = 'default.php';

    public function render($view, $params = [])
    {
        extract($params);
        include 'src/views/' . $this->template;
    }
}
