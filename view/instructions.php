<?php 
namespace root\view;

class view{
    function __construct(){
        $page = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/view/shop-page.html');
        $page = str_replace('$$$WHEREAMI$$$', 'http://'.$_SERVER['HTTP_HOST'].'/view', $page);
        $page = str_replace('$$$CONTENT$$$', 'http://'.$_SERVER['HTTP_HOST'].'/view', $page);
        echo $page;
    }
}