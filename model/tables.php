<?php
    namespace root\model;
    require_once "db_connect.php";
    class tables extends db_connect{
        function Articles(){
            $data = $this->$pdo->query('SELECT * FROM articles');
            while( $row = $data->fetch()){
                 $final = $final.$row['discription']."<br>";
            }
            return $final;
        }
    }