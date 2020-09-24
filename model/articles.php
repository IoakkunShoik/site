<?php
    namespace root\model;
    require_once "db_connect.php";
class Articles extends db_connect{
            #search

            #filters: 
            #   categories+
            #   price
            #   newist
            #   standard(like to base)
        function filters($names_array){
            #select by categories
            if($_GET['category']){
                $category = $_GET['category'];
                if(!in_array($category, $names_array)) return;
                $current_category = $this->$pdo->query("SELECT * FROM `categories` WHERE `name`='$category'");
                
                $query_array = json_decode($current_category->fetch()['ids'])->{0};

                foreach($query_array as $tmp){
                    if(!$str){
                        $str = $tmp;
                        continue;
                    }
                    $str .= ','.$tmp;
                }
                $query_string[0] = " WHERE `id` IN ($str) ";
                $query_string[1] = $category;   
            }
            #select by price
            if(is_numeric($_GET['price_from']) || is_numeric($_GET['price_to'])){
                $from                                  = $_GET['price_from'];
                $to                                    = $_GET['price_to'  ];

                if(!$from) $from                       = 0;
                if(!$to)   $to                         = 1000000;
                if($query_string[0]) $query_string[0] .= " AND price ";
                if(!$query_string[0])$query_string[0] .= " WHERE price ";

                $query_string[0]                      .= " BETWEEN $from AND $to ";
                $query_string[2]                       = $_GET['price_from'];
                $query_string[3]                       = $_GET['price_to'];
            }
            #search
            if($_GET['search']){
                if($query_string[0]) $query_string[0] .= " AND ";
                if(!$query_string[0])$query_string[0] .= " WHERE ";
                $string = $_GET['search'];
                $string = str_replace(array("'", '"', "`", "%"), "", $string);
                $query_string[0] .= " `name` LIKE '%$string%' ";
                $query_string[4] = $string;
            }
            #select order by...
            if(is_numeric($_GET['order'])){
                #1 - price up, 2 - price down, 3 - date up, 4 - date down;
                if($_GET['order'] == 1 ) $query_string[0] .= " ORDER BY `price` ASC ";
                if($_GET['order'] == 2 ) $query_string[0] .= " ORDER BY `price` DESC ";
                if($_GET['order'] == 3 ) $query_string[0] .= " ORDER BY `date` ASC ";
                if($_GET['order'] == 4 ) $query_string[0] .= " ORDER BY `date` DESC ";
            }
            return $query_string;
            #[0] - final request, [1] - current category, [2] - price from, [3] - price to, [4] - search
        }
        
        function articles(){
            #setup article view
            #echo $this->filters();
            $categories    = $this->$pdo->query("SELECT * FROM `categories`");
            while($tmp = $categories->fetch()[1]){
                $names_categories[] = $tmp;
            }
            $apply_filters = $this->filters($names_categories)[0];
            $design_style  = "<style>".file_get_contents($_SERVER["DOCUMENT_ROOT"].'/view/Articles/Articles.css')."</style>";
            $design_style  = str_replace('$$$MORE$$$', 'http://'.$_SERVER['HTTP_HOST'].'/view/Articles/more.png', $design_style);
            $design_style  = str_replace('$$$TCART$$$', 'http://'.$_SERVER['HTTP_HOST'].'/view/Articles/tcart.png', $design_style);
            $design        = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/view/Articles/Articles.html');
            #queries
            $data          = $this->$pdo->query("SELECT * FROM articles $apply_filters ");
            $count         = $this->$pdo->query("SELECT COUNT(*) FROM articles $apply_filters")->fetch()[0];
            #adding data from db
            $numpage = 1;
            if($_GET['numpage'])
                $numpage = $_GET['numpage'];

            $amt_art   = 12;                                                //amount articles
            
            $amt_pages = ($count) / $amt_art;     //amount pages

            #sys
            $incr      = 0;
            $continue  = 0;
            $start_art = $amt_art*$numpage-$amt_art-1;

            while($incr<$amt_art && $row = $data->fetch()){
                if($continue<=$start_art){
                    $continue++;
                    continue;
                }

                $design_local = str_replace('$$$DISCRIPTION$$$',$row['discription'],$design);
                $design_local = str_replace('$$$PRICE$$$',      $row['price'],      $design_local);
                $design_local = str_replace('$$$IMG$$$',        $row['preview'],    $design_local);
                $design_local = str_replace('$$$NAME$$$',       $row['name'],       $design_local);
                $design_local = str_replace('$$$ID$$$',         $row['id'],         $design_local);
                $final .= $design_local;
                $incr++;
            }
            $final .= '<div class="pages" align="center">';
            $category_in_numpage = $this->filters($names_categories);
            for($i=1;$i<$amt_pages+1;$i++){

                #page=test&numpage=3
                
                $more_info = "<input type='hidden' value='".$category_in_numpage[1]."' name=category>";
                if($_GET['price_from'])
                    $more_info .="<input type='hidden' value='".$category_in_numpage[2]."' name='price_from'>";
                if($_GET['price_to'])
                    $more_info .="<input type='hidden' value='".$category_in_numpage[3]."' name='price_to'> ";
                if($_GET['order'])
                    $more_info .="<input type='hidden' value='".$_GET['order']."' name='order'>";
                if($_GET['search'])
                    $more_info .="<input type='hidden' value='".$category_in_numpage[4]."' name='search'>";
                $final .= "<form  method='get' style='display:inline-block; margin:1vw'>
                    $more_info
                    <input type='hidden' name='page' value='shop'>
                    <input type='submit' name='numpage' value='$i'>
                    </form>";
            }
            $final .= '</div>';
            #end
            return $design_style.$final;
        }
    }