<?php
class GeneNet_Model extends CI_Model{
    public function check($data)
    {
        $email=$data['email'];
        $password=$data['password'];
        $sql="select * from User where email='$email'";
        $res=$this->db->query($sql);
        //var_dump($p);
        $p=$res->row();
        //var_dump($p);
        if($p==NULL)
        {
            echo "<script type=\"text/javascript\">alert(\"sorry,the user does not exit!\")</script>";
            return false;
        }
        else
        {
            if($password==$p->password)
                return $p;
            else
            {
                echo "<script type=\"text/javascript\">alert(\"sorry,the password is wrong,try again!\")</script>";
                return false;
            }
        }
    }

    public function register($data)
    {
    	$email=$data['email'];
    	$username=$data['email'];
        $sql="select * from User where email='$email'";
        $sql2="select * from User where username='$username'";
        $res=$this->db->query($sql);
        $res2=$this->db->query($sql2);
        $d=$res->row();
        $d1=$res2->row();
        //var_dump($d);
        if($d==NULL&&($d1==NULL)){
            $bool=$this->db->insert('User',$data);
            return $bool;
        }
        else
            return false;
    }

    public function update_fileinfo($gene_db,$prex)
    {
        $where = array('username' => $prex);
        $bool=$this->db->update('User', $gene_db,$where);
        //return $this->db->affected_rows();
        return $bool;
    }

    public function file_info($username)
    {
        $this->db->select('file_name,file_sample,file_recordnum,file_gene,file_max,file_min');
        $this->db->from('User');
        $this->db->where('username',$username);
        $data=$this->db->get()->result_array();
        
        return $data;
    }

}