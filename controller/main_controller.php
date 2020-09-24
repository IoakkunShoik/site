<?php
namespace root\controller;
require_once 'view/instructions.php';
require_once 'model/tables.php';
require_once 'model/admin.php';
require_once 'controller/admin_controller.php';
use root\controller;

class main_controller{
    #####################################################
                ##          admin            ##
    #####################################################
    private function page_admin_panel($page){              
        if( $_SESSION['success_for_admin']!='228822' && ($_POST['login'] != 'admin' || $_POST['password']!='admin'))
        {
            header("Location: http://".$_SERVER['HTTP_HOST']."/?page=admin_panel_login"); #check login
            return;
        } 
        else 
        {
            $_SESSION['success_for_admin']='228822';
        }
        $template = "admin";
        $admin_data = new \root\model\Admin;
        switch($_POST['add-category']){
            case 28: $row = admin_page_add_category ($admin_data->Categories())[0]; $template = "admin_category";break;
            case 36: $row = admin_page_add_category ($admin_data->Categories())[0]; $template = "admin_category";break;
            default: $row = admin_page_display      ($admin_data->Articles()); break;
        }
         #display articles, and control panel
        $display_result = $row;
        switch($row['5']){
            case 'add'      : $admin_data->Add_Articles     ($row); $display_result = $row[7]; break; #added articles to data base
            case 'change'   : $admin_data->Change_Article   ($row); $display_result = $row[8]; break;
            case 'delete'   : $admin_data->Delete_Article   ($row); $display_result = $row[4]; break;
            case 'addimage' : $admin_data->Add_Image        ($row); $display_result = $row[0]; break;
        }
        
        return $page->render($display_result."<hr>", $template);
    }

    private function page_admin_panel_login($page){
        require_once($_SERVER['DOCUMENT_ROOT'].'/controller/admin_login_page.php');
        return;
    }

    #####################################################
                ##          user            ##
    #####################################################
    private function page_index($page){                    
        $output = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/view/main-page.html');
        return $page->render($output, 'base');
    }

    private function page_shop($page){
        require_once 'model/articles.php';
        $output = new \root\model\Articles();
        return $page->render($output->articles(), "base");
    }

    private function page_article($page){
        $view  = file_get_contents          ($_SERVER['DOCUMENT_ROOT'].'/view/article-page.html');
        $view .= '<style>'.file_get_contents($_SERVER['DOCUMENT_ROOT'].'/view/style-article.css').'</style>';
        $output = new \root\model\tables();
        return $page->render($output->SingleArticle($view), 'base');
    }

    private function page_hidden($page){
        require_once 'model/articles.php';
        
        
        if($_GET['to_cart'])
            $_SESSION['to_cart'][] = $_GET['to_cart'];

        $output = $_SESSION['to_cart'];
        print_r($output);
        return $page->render($output, 'empty');
    }

    private function page_cart($page){
        $view = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/view/Articles/article_table.php');
        $output = new \root\model\tables();
        
        return $page->render($output->Cart($view), 'base');
    }
    #####################################################
                ##          display            ##
    #####################################################

    function __construct(){                               #section of display
        $page = new \root\view\view();  
        $call = "page_".$_GET['page'];
        if(!$_GET['page']){
            $this->page_index($page);                     #display mainpage when empty request
            return;
        }
        
        foreach(get_class_methods($this) as $i){
            if($i == 'page_'.$_GET['page']){
                $this->$call($page);                        #called method by name. "$call" contain method name, constructed by $_GET['page]
                return;
            }           
        }
        echo "404 страница не найдена :(";
        
        
    }

}