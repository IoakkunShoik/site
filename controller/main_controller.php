<?php
namespace root\controller;
require_once 'view/instructions.php';

class main_controller{
    private function page_index($page){
        return $page->render('это главная страница');
    }
    private function page_shop($page){
        return $page->render('Это страница магазина');
    }

    function __construct(){
        $page = new \root\view\view();         
        switch ($_GET["page"])
        {
            case 'index': $this->page_index($page);break;
            case  'shop': $this->page_shop($page);break;
            default:{echo $_GET['page'];
                $this->page_index();}
            
        }
        
    }

}