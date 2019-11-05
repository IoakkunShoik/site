<?php 
namespace root\view;
//antiquar
class view{
    function base_template(){
        $page = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/view/shop-page.html');
        $page = str_replace('$$$WHEREAMI$$$', 'http://'.$_SERVER['HTTP_HOST'].'/view', $page);
        return $page;
    }
    function render($input){
        $page = $this->base_template();
        $page = str_replace('$$$CONTENT$$$', $input, $page);
        echo $page;
    }
}