<?php 
    namespace root\controller;
    require_once "model/admin.php";
    function admin_page_display($array)
    {
        $row='<table><tr ><td><strong>id</strong></td><td><strong>name</strong></td><td><strong>images</strong></td><td><strong>/discription<strong></td><td><strong>characteristics</strong></td><td><strong>price</strong></td><td><strong>preview</strong></td><td><strong>date</strong></td></tr>';
        $a_i = 0;
        foreach($array as $i)
        {
            $row .= "<tr>";

            foreach ($i as $j)
            {
                $row .= "<td>$j</td>";
            }

            $row .= "<td><form method='post' action='http://".$_SERVER['HTTP_HOST']."/?page=admin_panel'>
                            <input type='hidden' name='add-article' value='60'>
                            <input type='hidden' name='delete-id'   value='".$i[0]."'>
                            <input type='submit' value='DELETE'>
                         </form>
                         <form method='post' action='http://".$_SERVER['HTTP_HOST']."/?page=admin_panel'>
                            <input type='hidden' name='add-article'   value='44'>
                            <input type='hidden' name='id-on-page'    value='$a_i'>
                            <input type='hidden' name='change-for-id' value='".$i[0]."'>
                            <input type='submit' value='CHANGE'>
                         </form></td></tr>";
            $a_i++;
        }

        $row .= "</table>";
        #local routing:

        switch ($_POST['add-article'])
        {
            case 28: return admin_page_add_article   ();
            case 36: return admin_page_request_add   ();
            case 44: return admin_change_article     ($array);
            case 52: return admin_page_request_change();
            case 60: return admin_delete_article     ();
            case 68: return admin_page_request_delete();
        }
        switch ($_POST['add-image']){
            case 28: return admin_page_add_image();
            case 36: return admin_request_add_image();
            case 44: return admin_page_show_images();
        }
       
        return $row;
    }

    function admin_page_add_category($array){
        foreach ($array[0] as $item){
            $row .= '<tr><td>'.$item['1'].'</td><td>'.$item['2']."</td><td><form method='post'><select name='modificate[]' multiple='multiple'>";/*<option value =''></option></select></td></tr>"*/
            foreach ($array[1] as $article){
                $added = json_decode($item['2'])->{0};
                
                foreach($added as $i){
                    
                    if($article[0]==$i){
                        
                        $article[1] = "*$article[1]*";
                    break;
                    }
                }
                $row  .= "<option value='$article[0]'>$article[1]</option>";
            }
            $row .= "</select>
            <input type='hidden' name='id' value='$item[0]'>
            <input type='hidden' name='add-category' value='36'>
            <input name='mode' type='submit' value='delete'>
            <input name='mode' type='submit' value='add'></form></td></tr>";
        }
        $final[] = $row;

        return $final;
    }

    function admin_page_add_category_request($request){
        echo $_POST['modificate'].", ".$_POST['delete'].", ".$_POST['add'];
    }

    function admin_page_add_image(){
        $result = '<form enctype="multipart/form-data" method="post">
        <table>
            <input name="add-image" type="hidden" value="36">
            <tr><td> Add name         </td><td> <input required name="add-name"      type="text"></td></tr>
            <tr><td> Select image:    </td><td> <input required name="add-image"     type="file"></tr></td>
            <tr><td> Add category     </td><td> <input required name="add-category"  type="text"></td></tr>
            <tr><td>                  </td><td> <input                           type="submit">        </td></tr>
        </table>
        </form>';
        return $result;
    }
    function admin_request_add_image(){
        $upload_dir     = $_SERVER['DOCUMENT_ROOT'].'/article_files/'.$_FILES['add-image']['name'];
        $download_dir   = "http://".$_SERVER['HTTP_HOST'].'/article_files/'.$_FILES['add-image']['name'];
        $added_file     = $_FILES['add-image']['tmp_name'];
        $preview        = resize_added_image($_FILES['add-image'], $upload_dir, $download_dir);

        if(!move_uploaded_file($added_file, $upload_dir)) return 'error';
        return array("ok<a href='?page=admin_panel'><button>Cancel</button></a>," ,$_POST['add-name'], $download_dir, $_POST['add-category'], null, 'addimage' );
    }
    function admin_page_show_images(){
        return "here will be images";
    }


    function admin_change_article($row)
    {   
        print_r($row[$_POST['id-on-page']]);
        $request       = $_POST['change-for-id'];
        $name          = $row[$_POST['id-on-page']][1];
        $image         = $row[$_POST['id-on-page']][2];
        $discription   = $row[$_POST['id-on-page']][3];
        $chars         = $row[$_POST['id-on-page']][4];
        $price         = $row[$_POST['id-on-page']][5];
        $preview       = $row[$_POST['id-on-page']][6];
        $date          = $row[$_POST['id-on-page']][7];
        return "
        <form method='post'>
            <input type='hidden' name='change-for-id' value=$request>
            <input type='hidden' name='add-article' value='52'>
            <table>
                <tr><td> Enter the name:        </td><td> <input    required value='$name'          name='change-name'          ></td></tr>
                <tr><td> Select image:          </td><td> <textarea required name='change-image'        >$image</textarea></tr></td>
                <tr><td> Select preview:        </td><td> <textarea required name='change-preview'      >$preview</textarea></tr></td>
                <tr><td> Paste discription:     </td><td> <textarea required name='change-discription'  >$discription</textarea></tr></td>
                <tr><td> Paste characteristics: </td><td> <textarea required name='change-chars'        >$chars</textarea></tr></td>
                <tr><td> Fantasize price:       </td><td> <input    required value='$price'         name='change-price'         ></tr></td>
                <tr><td> Fantasize date:        </td><td> <input    required value='$date'          name='change-date'          ></tr></td>
            <tr><td></td><td><input type='submit'></td></tr>
            </table>
            <input type='submit' value='ok'>
        </form>
        <a href='?page=admin_panel'><button>Cancel</button></a>";
    }
    function admin_page_request_change()
    {
        $return = "ok<a href='?page=admin_panel'><button>Cancel</button></a>";
    #                0                        1                      2                         3                             4                       5         6                      7
        return array($_POST['change-for-id'], $_POST['change-name'], $_POST['change-preview'], $_POST['change-discription'], $_POST['change-price'], 'change', $_POST['change-date'], $_POST['change-image'], $return, $_POST['change-chars']);
    }


    function admin_delete_article()
    {
        $request = $_POST['delete-id'];
        return "
        Are you shure that want to delete article #$request<hr>
        <form method='post'>
            <input type='hidden' name='add-article' value='68'>
            <input type='hidden' name='delete-id' value='$request'>
            <input type='submit' value='yes, kill this!'>
        </form>
        <a href='?page=admin_panel'><button>No, have mercy on him</button></a>
        ";
    }
    function admin_page_request_delete()
    {
        return array($_POST['delete-id'], null, null, null, /*4*/'ok, this shit was killed <a href="?page=admin_panel"><button>return on main</button></a>', 'delete');
    }


    function admin_page_add_article()
    {
        $row = 
        '<form enctype="multipart/form-data" method="post">
        <table>
            <input name="add-article" type="hidden" value="36">
            <tr><td> Enter the name:    </td><td> <input required name="add-name">                       </td></tr>
            <tr><td> Select preview:    </td><td> <input required name="add-image" type="file">          </tr></td>
            <tr><td> Paste discription: </td><td> <textarea required name="add-discription"></textarea>  </tr></td>
            <tr><td> Fantasize price:   </td><td> <input required name="add-price">                      </tr></td>
            <tr><td>                    </td><td> <input                           type="submit">        </td></tr>
        </table>
        </form>';
        
        return $row;
    }

    function admin_page_request_add()
    {
        $upload_dir     = $_SERVER['DOCUMENT_ROOT'].'/article_files/'.$_FILES['add-image']['name'];
        $download_dir   = "http://".$_SERVER['HTTP_HOST'].'/article_files/'.$_FILES['add-image']['name'];
        $added_file     = $_FILES['add-image']['tmp_name'];
        $preview        = resize_added_image($_FILES['add-image'], $upload_dir, $download_dir);

        if(!move_uploaded_file($added_file, $upload_dir)) return 'error';

        return array(
                     $_POST['add-name'],  $download_dir, $preview, $_POST['add-discription'],
                     $_POST['add-price'],       'add',      date('Y-m-d G:i:s'),
                     'article added <a href="?page=admin_panel"><button>return on main</button></a>'
                    );
    }

    function resize_added_image($image, $tmp_path, $showing_path){
        switch ($image['type'])
        {
            case 'image/jpeg': echo "ЖЫПЕГ"; $source = imagecreatefromjpeg($image['tmp_name']);
                $type = 'jpg'; break;
            case 'image/png' : echo "ПЫНЕГ"; $source = imagecreatefrompng ($image['tmp_name']);
                $type = 'png'; break;
            default: break;
        }

        $source_height = imagesy($source);
        $source_width  = imagesx($source);
        $ratio         = $source_width/500;
        $w_dest        = round($source_width/$ratio);
        $h_dest        = round($source_height/$ratio);
        $dest          = imagecreatetruecolor($w_dest, $h_dest);

        imagecopyresampled($dest, $source, 0, 0, 0, 0, $w_dest, $h_dest, $source_width, $source_height);
        imagejpeg         ($dest, $tmp_path.'preview.'.$type, 75);
        imagedestroy      ($dest);
        imagedestroy      ($source);

        return $showing_path.'preview.'.$type;
    }