<?php

namespace src\core;

class Controller
{
    public $model;
    public $view;

    function __construct($post = [])
    {
        $this->view = new View();
        $this->post = $post;
    }
}