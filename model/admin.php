<?php
namespace root\model;
require_once "db_connect.php";
require_once "migrate.php";
class Admin extends db_connect{
    function Articles(){
        #display
        $a = new Migrate();
        $a->migrate();
        
        $data = $this->$pdo->query('SELECT * FROM articles');
        while ($req = $data->fetch()){
            $row[0] = $req["id"];
            $row[1] = $req["name"];
            $row[2] = $req["image"];
            $row[3] = $req["discription"];
            $row[4] = $req["chars"];
            $row[5] = $req["price"];
            $row[6] = $req["preview"];
            $row[7] = $req["date"];
            $final[] = $row;
        }

        
        return $final;
    }
    
    function Categories(){

        if($_POST['mode'] == 'add'){ #add
            $id = $_POST['id'];
            $moddata = $this->$pdo->query("SELECT * FROM `categories` WHERE `id`= '$id'");
            foreach($check = json_decode($moddata->fetch()[2])->{0} as $i){
                foreach($_POST['modificate'] as $n){
                    error_reporting(~E_WARNING && ~E_NOTICE);
                    if(!in_array($n, $check))
                        $check[]=$n;
                       // $reqstring            .= $n.' ';
            }
            
            }
            echo $instr = json_encode($check);
            $this->$pdo->query("UPDATE `categories` SET `ids`='{\"0\" : $instr}' WHERE `id`='$id'");
            print_r($check);
            echo $reqstring;
            return 'complete';
        }
        if($_POST['mode'] == 'delete'){
            $id = $_POST['id'];
            $moddata = $this->$pdo->query("SELECT * FROM `categories` WHERE `id`= '$id'");
            foreach(json_decode($moddata->fetch()[2])->{0} as $i){
                $enable = false;
                foreach($_POST['modificate'] as $n){
                    if($i==$n) $enable = true;
                }
                if($enable == false) $check[] = $i;
            }
            echo $instr = json_encode($check);
            $this->$pdo->query("UPDATE `categories` SET `ids`='{\"0\" : $instr}' WHERE `id`='$id'");
            return "complete";
        }
        $data = $this->$pdo->query('SELECT * FROM `categories`');
        while ($req = $data->fetch()){
            $row[0] = $req['id'];
            $row[1] = $req['name'];
            $row[2] = $req['ids'];
            $item[]= $row;
        }
        $final[] = $item;
        $data = $this->$pdo->query('SELECT * FROM `articles`');
        while ($req = $data->fetch()){
            $row[0] = $req["id"];
            $row[1] = $req["name"];
            $row[2] = $req["image"];
            $row[3] = $req["discription"];
            $row[4] = $req["chars"];
            $row[5] = $req["price"];
            $row[6] = $req["preview"];
            $row[7] = $req["date"];
            $item2[] = $row;
        }
        $final[] = $item2;
        return $final;
    }

    function Add_Articles($request){
        $name           = $request[0];
        $image          = $request[1];
        $preview        = $request[2];
        $discription    = $request[3];
        $price          = $request[4];
        #trigger        = $request[5];
        $date           = $request[6];
        #display_result = $request[7];
        $image = '{"0":"'.$image.'"}';

        $prpr = $this->$pdo->prepare("INSERT INTO `articles` (`name`, `image`, `preview`, `discription`,`chars`, `price`, `date`) VALUES ('$name', '$image', '$preview', '$discription','1', '$price', '$date');
        INSERT INTO `images` (`name`, `url`, `category`) VALUES ('$name','$image','1')");
        $prpr->execute();
        echo 123;
    }

    function Change_Article($request){
        $id             = $request[0];
        $name           = $request[1];
        $preview        = $request[2];
        $image          = $request[7];
        $discription    = $request[3];
        $price          = $request[4];
        $date           = $request[6];
        $chars          = $request[9];
        $this->$pdo->query("UPDATE `articles` SET `name`='$name', `image`='$image', `preview`='$preview', `discription`='$discription',`chars`='$chars', `price`='$price', `date`='$date' WHERE `id`='$id'");
        print_r($request);
    }

    function Delete_Article($request){
        $request = $request[0];
        $this->$pdo->query("DELETE FROM `articles` WHERE id='$request'");
        echo 'ok :(';
    }

    function Add_Image($request){
        $name     = $request[1];
        $image    = $request[2];
        $category = $request[3];
        $check    = $this->$pdo->query("SELECT * FROM `images` WHERE `url`='$image'");
        echo $check->fetch()['id'];
        $this->$pdo->query("INSERT INTO `images` (`name`, `url`, `category`) VALUES ('$name', '$image', '$category')");
        return $request;
    }
###
    function Users(){
            $data = $this->$pdo->query('SELECT * FROM users');
            while($row = $data->fetch()){
                $final .=$row['nickName'];
            }
            return $final;
        }
    }