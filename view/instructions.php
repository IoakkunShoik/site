<?php 
namespace root\view;
//antiquar
class view{
    function base_template(){
        $page = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/view/shop-page.html');
        $page = str_replace('$$$WHEREAMI$$$', 'http://'.$_SERVER['HTTP_HOST'].'/view', $page);
        return $page;
    }
    function admin_template(){
        $page = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/view/Admin/admin_panel.php');
        return $page; 
    }

    function admin_category_template(){
        $page    = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/view/Admin/admin_panel.php');
        $content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/view/Admin/admin_panel_categories.php');
        $page    = str_replace('$$$CONTENT$$$', $content, $page);
        return $page;
    }
    function empty_template(){
        return '$$$CONTENT$$$';
    }
    
    function render($input, $template){
        $template .= "_template";
        $page = $this->$template();
        $page = str_replace('$$$CONTENT$$$', $input, $page);
        echo $page;
    }
}