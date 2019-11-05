<?php
namespace root\controller;
require_once 'view/instructions.php';
require_once 'model/tables.php';
class main_controller{

    private function page_index($page){

        return $page->render('это главная страница');
    }
    private function page_shop($page){
        $output = new \root\model\tables();
        
        return $page->render($output->Articles());
    }

    function __construct(){
        $page = new \root\view\view();  
        $call = "page_".$_GET['page'];
        if(!$_GET['page']){
            $this->page_index($page);
            return;
        }
        
        foreach(get_class_methods($this) as $i){
            if($i == 'page_'.$_GET['page']){
                $this->$call($page);
                return;
            }           
        }
        echo "404 страница не найдена :(";
        
        
    }

}