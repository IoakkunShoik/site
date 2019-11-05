<?php
    namespace root\model;

    class db_connect{
        function __construct(){
            $connect_data_json = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/model/db_settings.json"); 
            $connect_data = json_decode($connect_data_json);
            $dsn = "mysql:host=$connect_data->db_host;dbname=$connect_data->db_name;charset=utf8";
            $this->$pdo = new \PDO($dsn, $connect_data->db_user, $connect_data->db_password);  
        }
    }