<?php
namespace root\controller;
require_once 'view/instructions.php';
class main_controller{
    function __construct(){ 
        echo "скрипт подгружен";
        echo "<hr>";
        $page = new \root\view\view();
        $page->render('1232');
    }

}