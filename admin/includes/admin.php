<?php

class Admin extends User{

    public $admin_name;
    public $admin_area;
    public $admin_lga;
    public $admin_heading;
    public $admin_msg;
    public $post_pic;
    public $post_pic_tmp;
    
    public function verify_admin($email, $pass){
        global $db;
        $db->query('SELECT * FROM admin WHERE admin_email =:email AND admin_pass =:password');
        $db->bindValue(':email', $email, PDO::PARAM_STR);
        $db->bindValue(':password',$pass, PDO::PARAM_STR);   
        $row = $db->fetchobj();
        return $row;
    }

    public function find_byid($id){
        global $db;
        $db->query("SELECT * FROM admin WHERE admin_id = :id");
        $db->bindValue(':id', $id, PDO::PARAM_STR);
        $row = $db->fetchobj();
        return $row;
    }

    public function post(){
        global $db;
        move_uploaded_file($this->post_pic_tmp, "uploaded_image/$this->post_pic");

        $db->query('INSERT INTO admin_post (admin_name, admin_area, admin_lga, admin_heading, admin_msg, admin_postpic, time) VALUES (:name_admin, :area_admin, :lga_admin, :heading, :message, :image, NOW())');
    
        $db->bindValue(':name_admin', $this->admin_name, PDO::PARAM_STR);
        $db->bindValue(':area_admin', $this->admin_area, PDO::PARAM_STR);
        $db->bindValue(':lga_admin', $this->admin_lga, PDO::PARAM_STR);
        $db->bindValue(':heading', $this->admin_heading, PDO::PARAM_STR);
        $db->bindValue(':message', $this->admin_msg, PDO::PARAM_STR);
        $db->bindValue(':image', $this->post_pic, PDO::PARAM_STR);
    
        $db->execute();
        return true;
    }
}

?>

