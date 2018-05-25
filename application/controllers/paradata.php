<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/11
 * Time: 20:29
 */
global $para;
global $x, $y, $x0, $y0, $downflag, $ddata,$genes;
$x=0;$y=0;
$x0=0;$y0=0;
$downflag =0;
$ddata=array();
$genes=array();
$para=array('methodSearchData'=>array(),
    'method3SearchData'=>array(),'InitFinished'=>0,
    'Method'=>1,'RecordNum'=>1,'Sample'=>1,'GeneName'=>array()
    );