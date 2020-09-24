<?php 
    namespace root\model;
    require_once "db_connect.php";
    class tables extends db_connect{
        
        function SingleArticle($input){
            $data = $this->$pdo->query("SELECT * FROM articles WHERE `id`='{$_GET['article']}'");
            $data = $data->fetch();

            $input = str_replace('$$$NAME$$$', $data['name'], $input);
            $input = str_replace('$$$DISCRIPTION$$$', $data['discription'], $input);
            $input = str_replace('$$$IMAGE$$$', json_decode($data['image'])->{0}, $input);
            
            for($a=0; json_decode($data['image'])->{$a}; $a++){
                $input = str_replace('$$$IMAGES$$$', '<div style="background-image: url(\''.json_decode($data['image'])->{$a}.'\')" class="imgs"></div>$$$IMAGES$$$', $input);
            }
                
            foreach(json_decode($data['chars']) as $ch){
                $input = str_replace('$$$CHARS$$$', $ch.'<br>$$$CHARS$$$', $input);
            }

            $input = str_replace('$$$IMAGES$$$', '', $input);
            $input = str_replace('$$$CHARS$$$', '', $input);
            return $input;
        }

        function Cart($view){
            if(!$_SESSION['to_cart']){
                return "<style>
                    h1{color: #f9aa44; font-family: 'Philosopher', 'sans-serif'}
                    .shop{display: block;}
                    .filters, .search, .cart{ display:none;}
                </style>
                <h1>Корзина пуста</h1>";
            }
            foreach($_SESSION['to_cart'] as $i){
                if(!$string){
                    $string=$i;
                    continue;
                }
                $string .= ','.$i;
            }
            
            $data = $this->$pdo->query("SELECT * FROM articles WHERE `id` IN ($string)");
            $string = NULL;
            while($i = $data->fetch()){
                $price += $i[6]*array_count_values($_SESSION['to_cart'])[$i[0]];
                $string .= '<tr><td><img height="40vw" src="'.$i[3].'"></img></td>';
                $string .= '<td><div class="td">'.$i[4].'</td></td>';
                $string .= '<td>'.$i[6].'</td>';
                $string .= '<td>'.array_count_values($_SESSION['to_cart'])[$i[0]].'</td>';
                $string .= '</tr>';
                $count[] = $i[0];
            }
            $final = str_replace('$$$CONTENT$$$', $string, $view);
            $final = str_replace('$$$SUM$$$', $price, $final);
            return $final;
        }
        
        function Users(){
            $data = $this->$pdo->query('SELECT * FROM users');
            while($row = $data->fetch()){
                $final = $final.$row['nickName']."<br>";
            }
            return $final;
        }
    }