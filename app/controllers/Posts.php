<?php

namespace app\controllers;

use vendor\core\base\Conteroller;

class Posts extends Conteroller{

    public function indexAction(){
        echo "Post::index";
    }
    public function testAction(){
        debug($this->route);
        echo "Posts::test";
    }
}