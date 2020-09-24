<?php
namespace  root\model;

require_once "db_connect.php";

class Migrate extends db_connect{
    function migrate(){
        $connect_data_json = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/model/db_settings.json"); 
        $response = $this->$pdo->query("SHOW TABLES");
        $check_db = [];
        while($a = $response->fetch()){
                $check_db[] = $a[0];
        }
        if(!in_array("categories",$check_db)){
            echo 1;
        }
        if(!in_array("articles",$check_db)){
            $this->$pdo->query("CREATE TABLE `articles` (
                `id` int(10) UNSIGNED AUTO_INCREMENT NOT NULL,
                `name` text NOT NULL,
                `image` text NOT NULL,
                `preview` text NOT NULL,
                `discription` text NOT NULL,
                `chars` text NOT NULL,
                `price` text NOT NULL,
                `date` datetime NOT NULL,
                PRIMARY KEY(`id`)
              )");
        }
    }
}