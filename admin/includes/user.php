<?php
class User{

    public static $dbtable = "user";
    public $user_id;
    public $user_name;
    public $user_email;
    public $user_pass;
    public $user_img;
    public $user_back_img;

    public function verify_user($email, $pass){
        global $db;
        $db->query('SELECT * FROM users WHERE user_email =:email AND user_pass =:password');
        $db->bindValue(':email', $email, PDO::PARAM_STR);
        $db->bindValue(':password',$pass, PDO::PARAM_STR);   
        $row = $db->fetchobj();
        return $row;
    }

    public function find_byid($id){
        global $db;
        $db->query("SELECT * FROM users WHERE user_id = :id");
        $db->bindValue(':id', $id, PDO::PARAM_STR);
        $row = $db->fetchobj();
        return $row;
    }

    public function check_forarea_grptbl($area){
        global $db;
        $db->query("SELECT * FROM group_tables WHERE area_tbl =:areaname");
        $db->bindValue(':areaname', $area, PDO::PARAM_STR);
        $find_area = $db->fetchSingle();
        return $find_area;
    }

    public function insert_areatbl($area, $fullname){
        global $db;
        $db->query('INSERT INTO group_tables (area_tbl, group_creator) VALUES (:areanme, :creatornme)');
        $db->bindValue(':areanme', $area, PDO::PARAM_STR);
        $db->bindValue(':creatornme', $fullname, PDO::PARAM_STR);
        $area_exec = $db->execute();
    }

    public function check_forstr_grptbl($str){
        global $db;
        $db->query("SELECT * FROM group_tables WHERE area_tbl =:areaname");
        $db->bindValue(':areaname', $str, PDO::PARAM_STR);
        $find_area = $db->fetchSingle();
        return $find_area;
    }

    public function insert_strtbl($str, $fullname){
        global $db;
        $db->query('INSERT INTO group_tables (area_tbl, group_creator) VALUES (:areanme, :creatornme)');
        $db->bindValue(':areanme', $str, PDO::PARAM_STR);
        $db->bindValue(':creatornme', $fullname, PDO::PARAM_STR);
        $area_exec = $db->execute();
    }

    public function area_chat($area, $lga){
        global $db;
        $db->query('SELECT * FROM area_chat WHERE area_name =:name_area AND lga_name =:name_lga');
        $db->bindValue(':name_area', $area, PDO::PARAM_STR);
        $db->bindValue(':name_lga', $lga, PDO::PARAM_STR); 
        $result = $db->fetchobj_all();
        return $result;  
    }

    public function str_chat($street, $area, $lga){
        global $db;
        $db->query('SELECT * FROM street_chat WHERE str_name =:name_str AND area_name =:name_area AND lga_name =:name_lga');
        $db->bindValue(':name_str', $street, PDO::PARAM_STR);
        $db->bindValue(':name_area', $area, PDO::PARAM_STR);
        $db->bindValue(':name_lga', $lga, PDO::PARAM_STR);
        $result = $db->fetchobj_all();
        return $result;  
    }

    public function upd_profilepic($pic_tmp, $pic, $id){
        global $db;
        move_uploaded_file($pic_tmp, "uploaded_image/$pic");
        $db->query('UPDATE users SET user_img=:frt_img WHERE user_id=:id ');
        $db->bindValue(':id', $id, PDO::PARAM_INT);
        $db->bindValue(':frt_img', $pic, PDO::PARAM_STR);  
        $run_picture = $db->execute();
        return $run_picture;
    }

}
?>