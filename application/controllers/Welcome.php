<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        
        parent::__construct();
        
        $this->load->model('GeneNet_Model');
       

    }
	public function index()
	{
         
        $this->load->helper('url');
		$this->load->view('index');


		/*$file = fopen('File/g.csv','r');
          $row=0; $row1=0; $row2=0;
          //$headervar=fgetcsv($file);
          while ($data1 = fgetcsv($file)) { //每次读取CSV里面的一行内容
               
              $data['outsource'][$row]=$data1[0];
              if($data1[1]==-1)
                 $data['outarget2'][$row1++]=$data1[2];
              else
              	$data['outarget1'][$row2++]=$data1[2];
               $row++;
          }
          fclose($file);
		$this->load->view('Cyto1',$data);*/
		
	}

	public function login()
	{
		$this->load->helper('url');
		$data['email']="";
        $data['password']="";
        $this->load->view('login',$data);
	}

	public function register()
	{
		$this->load->helper('url');
        $this->load->view('register');
	}

	public function login1()
	{
	  
       $data['email']=$this->input->post('email');
       $data['password']=$this->input->post('password');
       $this->load->helper('url');
       //$this->load->model('GeneNet_Model');
       $userinfo=$this->GeneNet_Model->check($data);
       $f=array();
        if($userinfo==false)
        {
            $this->load->view('login',$data);
        }
        else
        {
            $this->session->set_userdata('username',$userinfo->username);
            $this->session->set_userdata('email',$userinfo->email);
            $this->session->set_userdata('password',$userinfo->password);
            /*$_SESSION['username']=$userinfo->username;
            $_SESSION['email']=$userinfo->email;
            $_SESSION['password']=$userinfo->password;*/
            $info['username']=$userinfo->username;
		        $num=0;
		        /*if($userinfo->file1!=NUll)
		       	  $f[$num++]=$userinfo->file1;
		       	if($userinfo->file2!=NUll)
		       	  $f[$num++]=$userinfo->file2;
		       	if($userinfo->file3!=NUll)
		       	  $f[$num++]=$userinfo->file3;
		       	if($userinfo->file4!=NUll)
		       	  $f[$num++]=$userinfo->file4;
		       	if($userinfo->file5!=NUll)
		       	  $f[$num++]=$userinfo->file5;
		       	if($userinfo->file6!=NUll)
		       	  $f[$num++]=$userinfo->file6;
		       	if($userinfo->file7!=NUll)
		       	  $f[$num++]=$userinfo->file7;
		       	if($userinfo->file8!=NUll)
		       	  $f[$num++]=$userinfo->file8;
		       	if($userinfo->file9!=NUll)
		       	  $f[$num++]=$userinfo->file9;
		       	if($userinfo->file10!=NUll)
		       	  $f[$num++]=$userinfo->file10;
		       	$info['files']=$f;*/
		       	$hostdir='./uploads/files/'.$userinfo->username;
		       	$filesnames = scandir($hostdir);
		       	//var_dump($filesnames);
		       	foreach ($filesnames as $name) {
		       		if($name!="."&&$name!=".."&&$name!=".DS_Store")
		       		     {
		       		     	$f[$num++]=$name;//echo $name;
		       		     }
		       	}
		       	$info['files']=$f;
		       	$info['count']=$num;
            $this->load->view('operation',$info);
            //$this->load->view('paper_list',$info);
        }
	}
	public function register1()
	{
		$data['email']=$this->input->post('email');
        $data['password']=$this->input->post('password');
        $data['username']=$this->input->post('username');
        $this->load->helper('url');
        //$this->load->model('GeneNet_Model');
        $bool=$this->GeneNet_Model->register($data);
        if($bool) {
            echo "<script type=\"text/javascript\">alert(\"register successfully!\")</script>";
            $this->load->view('login',$data);
        }
        else{
            echo "<script type=\"text/javascript\">alert(\"register failed,the user exists,try another again!\")</script>";
            $this->load->view('register');
        }
	}

    public function operation()
    {
        $this->load->helper('url');

        $this->load->view('operation1');
        //$this->load->view('test');
    }

    public function intro()
    {
    	 $this->load->helper('url');
        $this->load->view('intro_service');
    }
}
