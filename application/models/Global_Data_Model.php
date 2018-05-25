<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/16
 * Time: 16:18
 */
class Global_Data_Model extends CI_Model
{
    public $da;
    public function setddata(&$data)
    {
        $da=$data;
    }
    public function getdata()
    {

    }
}