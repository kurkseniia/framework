<?php

namespace app\controllers;

class Main extends App{
    // public $layout = 'main';
        // $this->view = 'test';
    public function indexAction(){
        // $this->layout = false;
        // $this ->layout='main';
        // $this->view='test';
        $name= 'Kseniia';
        $this->set(['name'=>$name]);
    }
}