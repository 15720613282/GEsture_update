<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
//include 'excel/PHPExcel.php';
//include 'excel/PHPExcel/IOFactory.php';
//include 'paradata.php';
global $para;
global $x, $y, $x0, $y0, $downflag;
$genes=array();
class File extends CI_Controller {

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
       
        

    }


  public function example()
  {
        $this->load->helper('url');
        $this->load->view('example');
  }


    public function fileSU()
    {
      $this->load->helper('url');
      $this->load->view('upload_file');
    
    }

    public function cluster($filelink,$filename,$flag){
       $this->load->helper('url');
       $data['filename']=$filename;//操作的源文件，如yeastexpression.csv
       $data['filelink']=$filelink;
       $flag=intval($flag);
       if($flag==1)
          $this->load->view('cluster_draw',$data);
       else{

           $ldata=array();
           $max=-10000;$min=10000;
           $file_path="File/".$filelink."/gdata.csv";
           if (!file_exists($file_path))
           {
            $prex=$filelink;
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $prex.'_'));
            $row=$this->cache->get('recordNum');
            $column=$this->cache->get('Sample');
            
            $str="Sample=".$row."  Dimension=".$column;
            $da['str']=$str;
            $da['xx']=$column;
            $da['YL']=$this->cache->get('YL');
            $da['YH']=$this->cache->get('YH');
            $da['flag']=0;
            $da['hi']=0;
            $da['file_name']=NULL;
            $da['target']=NULL;
            $da['clusterdata']=NULL;
            $da['cluster']=NULL;
            $da['operafile']=$filename;
            $da['filelink']=$filelink;
            $da['title']="search result";
              $this->load->view('draw_data',$da);
           }
           else{

               $file4=fopen('File/'.$filelink.'/gdata.csv','r');
                $row=0;
                while ($data = fgetcsv($file4)) { //每次读取CSV里面的一行内容
                                                
                    $ldata['gdata'][$row]=$data;
                     $ccount=count($data);// $data的列数
                    for($i=0;$i<$ccount;$i++)
                       { if($max<$data[$i])
                          $max=$data[$i];
                         if($min>$data[$i])
                          $min=$data[$i];
                        }
                     $row++;
            }
              fclose($file4);
              $ldata['count']=$row;//行数
              $ldata['ccount']=$ccount;
               $max=ceil($max);$min=floor($min);
              $ldata['dmax']=$max;
              $ldata['dmin']=$min;
              $ldata['filename']=$filename;
              $ldata['filelink']=$filelink;
               $this->load->view('cluster_draw2',$ldata);
       }
     }

    }

  public function showline($num,$filelink,$filename){ //聚类后显示曲线
  $this->load->helper('url');
  
  echo("<div hidden>$filename</div>");
 if(substr($filelink,0,3)=="WCY")
    $filePath="uploads/WCY/".$filename; 
  else
  $filePath="uploads/".$filelink."/".$filename; 
  $file=fopen($filePath,'r');//读取操作的源文件，如yeastexpression.csv
        $genedata_list=array();
        //$min=0;$max=0;
        $genes=array();
        $row=0;  $column=0;
        $min=100000;$max=-100000;
        while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
                                        //print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
           
            $genedata_list[] =$data;
            $genes[$row]=$genedata_list[$row][0];
             $row++;
        }

      $column=count($genedata_list[0])-1;
       for($i=0;$i<$row;$i++)
        {
          $genedata_list[$i]=array_splice($genedata_list[$i],1);
          for($j=0;$j<$column;$j++)
            {
              if($max<$genedata_list[$i][$j])
                 $max=$genedata_list[$i][$j];

              if($min>$genedata_list[$i][$j]&&$genedata_list[$i][$j]!='')
                 $min=$genedata_list[$i][$j];
            }
        }
        $ml=$min;$mh=$max;
        $max=ceil($max);$min=floor($min);

        fclose($file);
        $prex=$filelink;
        //$prex="WCY";
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $prex.'_'));
        $this->cache->save('filename', $filename,604800);
        $this->cache->save('genes',$genes,604800);
        $this->cache->save('recordNum',$row,604800);
        $this->cache->save('Sample',$column,604800);
        $this->cache->save('YL',$min,604800);
        $this->cache->save('YH',$max,604800);
        $this->cache->save('ml',$ml,604800);
        $this->cache->save('mh',$mh,604800);

  $target=array();
  $file1 = fopen('File/'.$filelink.'/gdata.csv','r');
  //$file1 = fopen('File/gdata.csv','r');
         //$title=fgetcsv($file1);
         
        $row1=0;
        while ($data = fgetcsv($file1)) {
                if($num==$row1){
                  $target=$data;
                  break;
                }
                                   
              $row1++;
        }
        fclose($file1);

  $num=$num+1;
  $clusterd=array();
  $file2 = fopen('File/'.$filelink.'/Kcluster.csv','r');
         //$file2 = fopen('File/Kcluster.csv','r');
         $title=fgetcsv($file2);
         $c=count($title);
         $column=$c-2;
        $row2=0;
        while ($data = fgetcsv($file2)) { //每次读取CSV里面的一行内容
                                    //print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
            if($num==$data[1])
            {  $da['cluster'][$row2]=$data;
                for($i=2;$i<count($data);$i++)
                {
                  $da['clusterdata'][$row2][$i-2]=$data[$i];
                }
                $row2++;
            }
        }
        fclose($file2);

     $fip='File/'.$filelink.'/cluster'.$num.'.csv';//将得到的分类结果保存到文件中去
     $file3 = fopen($fip,'w');
     fclose($file3);
     $file3=fopen($fip,'a');
     for($i=0;$i<$row2;$i++)
        fputcsv($file3, $da['cluster'][$i]);
      fclose($file3);

       // $max=max($target);
       // $min=min($target);
        $str="Sample=".$row."  Dimension=".$column;
        $da['str']=$str;
        $da['xx']=$column;
        $da['YL']=$min;
        $da['YH']=$max;
        $da['target']=$target;
        $da['flag']=0;
        $da['hi']=1;
        $da['file_name']="cluster".$num.".csv";
        $da['operafile']=$filename;
        $da['filelink']=$filelink;
        $da['title']="cluster".$num.".csv";
        $this->load->view('draw_data',$da);


}

public function oneline()
{
  $username="WCY";
  $filelink=$_POST['filelink'];
  $genename=$_POST['genename'];
  $filename=$_POST['filename'];

  $file = fopen('File/'.$filelink.'/'.$filename,'r');
        $headc=fgetcsv($file);
        $ct=count($headc);
        $row=0;
        while ($data1 = fgetcsv($file)) { //每次读取CSV里面的一行内容
             if($data1[0]==$genename)
                 { 
                  for($i=3;$i<$ct;$i++)
                    $da['choosegene'][$row][$i-3]=$data1[$i];
                   break;
                 }
                 
        }
         fclose($file);

        $da['n']=$ct-3;
        echo json_encode($da);
       
}

public function c_oneline()
{
  $username="WCY";
  $filelink=$_POST['filelink'];
  $genename=$_POST['genename'];
  $file = fopen('File/Kcluster.csv','r');
        $headc=fgetcsv($file);
        $ct=count($headc);
        $row=0;
        while ($data1 = fgetcsv($file)) { //每次读取CSV里面的一行内容
             if($data1[0]==$genename)
                 { 
                  for($i=2;$i<$ct;$i++)
                    $da['choosegene'][$row][$i-2]=$data1[$i];
                   break;
                 }
                 
        }
         fclose($file);

        $da['n']=$ct-2;
        echo json_encode($da);
}

 













    public function handraw($filelink,$filename)
    {
     
       
        $this->load->helper('url');
        $sheet=0;
        echo("<div hidden>$filename</div>");
       //$filePath="uploads/".$filelink."/".$filename;

       if(substr($filelink,0,3)=='WCY'){
         if($filename=="yeastExpression.csv"){
          $allRow=6178;
          $totalcol=18;
          $min=-4;
          $max=5;
           
         }
         else{
          $allRow=22746;
          $totalcol=12;
          $min=0;
          $max=16568;
         }

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $filelink.'_'));
        $this->cache->save('filename', $filename,604800);
        $this->cache->save('recordNum',$allRow,604800);
        $this->cache->save('Sample',$totalcol,604800);
        $this->cache->save('YL',$min,604800);
        $this->cache->save('YH',$max,604800);
        //$this->cache->save('ml',-3.01,7200);
        //$this->cache->save('mh',4.95,7200);
       }
       else{
  
       $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $filelink.'_'));
        $allRow=$this->cache->get('recordNum');
        $totalcol=$this->cache->get('Sample');
        $min=$this->cache->get('YL');
        $max=$this->cache->get('YH');
       
 }
        $str="Sample=".$allRow."  Dimension=".$totalcol;
        $da['str']=$str;
        $da['xx']=$totalcol;
        $da['YL']=$min;
        $da['YH']=$max;
        $da['flag']=0;
        $da['hi']=0;
        $da['file_name']=NULL;
        $da['target']=NULL;
        $da['clusterdata']=NULL;
        $da['cluster']=NULL;
        $da['operafile']=$filename;
        $da['filelink']=$filelink;
        $da['title']="search result";
          $this->load->view('draw_data',$da);

    }
    public function file_upload()
    {
        $this->load->helper('url');

        $str="0123456789abcdefghijklmnopqrstuvwxyz";
       $length = strlen($str)-1;
       $start=rand(0,$length);
       $count=5;//字符串截取长度
       $numrandom=substr($str, $start,$count);//随机截取字符串，取其中的一部分字符串
       $name=date('Ymd').$numrandom;
        $file_path='uploads/'.$name.'/';
        $file_path2='File/'.$name.'/';
        if (!is_dir($file_path)) 
            mkdir($file_path); // 如果不存在则创建
         if (!is_dir($file_path2)) 
            mkdir($file_path2); 
        $filename=$_FILES['input_file']['name'];
        move_uploaded_file($_FILES['input_file']['tmp_name'],$file_path.$filename);
        $filep=$file_path.$filename;
        $file=fopen($filep,'r');
        $row_content=fgetcsv($file);
        fclose($file);
        $cc=count($row_content);
        
        if($cc<=2)
         { $data['flag']=0;
           $bool=unlink($filep);
           //$bool=rmdir($file_path2);
         }
        else
        { $str=$row_content[1];
          if(!is_numeric($str))
             $data['flag']=0;
          else
             $data['flag']=1;
        }

        $data['filename']=$filename;
        $data['link']=$name;
        echo  json_encode($data);
    }

    public function delete_files()
    {
      $this->load->helper('url');
      $filelink = $_POST['filelink'];
     // $bool3=false;
      $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $filelink.'_'));
          $count=$this->cache->get('Sample');
          $min=$this->cache->get('YL');
          $max=$this->cache->get('YH');
      $filepa1='File/'.$filelink.'/all_newdata.csv';
      if(file_exists($filepa1)){
        $bool1=unlink($filepa1);
      }
      $filepa2='File/'.$filelink.'/c_all_newdata.csv';
      if(file_exists($filepa2)){
        $bool2=unlink($filepa2);
      }
      $filepa3='File/'.$filelink.'/s_all_newdata.csv';
      if(file_exists($filepa3)){
        $bool3=unlink($filepa3);
      }
      $data['c']=$count;
      $data['max']=$max;
      $data['min']=$min;
      echo json_encode($data);
    }

    public function load_file()
    {
      $this->load->helper('url');
      $username=$this->session->userdata('username');
      $f=array();
      if(!empty($username)){
        $info['username']=$username;
            $num=0;
        $hostdir='uploads/'.$username;
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
      }
      else
        $this->load->view('operation1');
        

    }

    public function line_change()//将过滤的数据保存到文件中去
    {
      $this->load->helper('url');
      $filename=$_POST['filename'];
      $filelink=$_POST['filelink'];
      $corr=$_POST['corr'];
      $flag=$_POST['flag'];
      $row=0;
      if($flag==1){
       // $lc_tabledata=$_POST['lc_tabledata'];
       // $row=count($lc_tabledata);
        
        $fp0='File/'.$filelink.'/filter_gene.csv';
         $file0=fopen($fp0,'w');
         fclose($file0);
        $fp='File/'.$filelink.'/'.$filename;
         $file1=fopen($fp,'r');
         $header=fgetcsv($file1);
         while ($data1 = fgetcsv($file1)) {
             if($corr<=$data1[2]){
                for($i=0;$i<count($data1);$i++)
                   $filter_gene[$row][$i]=$data1[$i];
                   $row++;
             }
         }
         fclose($file1);
        
         $file2=fopen($fp0,'a');
         fputcsv($file2,$header); 
         for($i=0; $i<$row;$i++)
          fputcsv($file2,$filter_gene[$i]); 
         fclose($file2);

         echo json_encode(true);
        }
        else{
          echo json_encode(false);
        }
 
    }

  public function select_gename()
  {
    $this->load->helper('url');
    $filelink=$_POST['filelink'];
    $filename=$_POST['filename'];
    $gname=$_POST['gname'];
    $max_h=-100000;
    $min_l=100000;
    $t=0;         
          $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $filelink.'_'));
          //$filename=$this->cache->get('filename');
          $count=$this->cache->get('Sample');
          $genes=$this->cache->get('genes');
          if (substr($filelink,0,3)=="WCY") 
            $filepath='uploads/WCY/'.$filename;
          else
          $filepath='uploads/'.$filelink.'/'.$filename;

          
         
  
          if(file_exists($filepath)){

            $file=fopen($filepath,'r');
            while ($data = fgetcsv($file)) {                                      
                if($gname==$data[0])
                  {$glist=$data;$t=1;break;}
                  
            }
            fclose($file);
            if($t==1){
             $glist=array_splice($glist,1);
             $data['geney']=$glist;
                for($i=0;$i<count($glist);$i++)
               {
                  if($glist[$i]!=""){
                   if($max_h<$glist[$i])
                      $max_h=$glist[$i];
                  if($min_l>$glist[$i])
                     $min_l=$glist[$i];
                   }
               }  
              $data['gmax']=ceil($max_h);
              $data['gmin']=floor($min_l);
             $data['flag']=1;
             $data['n']=$count;}
            else{
                $data['flag']=0;
                }
             echo json_encode($data);
           
        
    }
}

   public function random_selected()
       {
          
          $this->load->helper('url');
          $filelink=$_POST['filelink'];
          //$username=$this->session->userdata('username');
          //$username="WCY";
         // $genes=array();
          $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $filelink.'_'));
          $filename=$this->cache->get('filename');
          $count=$this->cache->get('Sample');
          //$genes=$this->cache->get('genes');
          $co=$this->cache->get('recordNum');
          if($co<10000)
          $range=$co;
          else if($co<50000)
          $range=round($co/100);
          else
          $range=round($co/500);

          $rg=rand(0,$range);
       // var_dump($rg); 
        $min_l=100000;$max_h=-100000;
        $row=0;
        $genedata_list=array();
        $filepath1=$filename;
        if (substr($filelink,0,3)=="WCY")
            $filepath2='uploads/WCY/'.$filename;
          else
            $filepath2='uploads/'.$filelink.'/'.$filename;
          if(file_exists($filepath1)){

            $file1=fopen($filepath1,'r');
            while ($data = fgetcsv($file1)) {                                      
                if($row==$rg)
                  {$genedata_list=$data;break;}
                  $row++;
            }
            fclose($file1);
      }else{

           $file2=fopen($filepath2,'r');
           // $genedata_list=fgetcsv($file2);
             while ($data2 = fgetcsv($file2)) { 
                if($row==$rg)
                  {$genedata_list=$data2;break;}
                  $row++;
            }
            fclose($file2);
      }
          // var_dump($genedata_list);
           $data['randomgene']= $genedata_list[0];
          $genedata_list=array_splice($genedata_list,1);
             $data['random_y']=$genedata_list;
            for($i=0;$i<count($genedata_list);$i++)
               {
                  if($genedata_list[$i]!=""){
                   if($max_h<$genedata_list[$i])
                      $max_h=$genedata_list[$i];
                  if($min_l>$genedata_list[$i])
                     $min_l=$genedata_list[$i];
                   }
               }
            
              
              $data['rmax']=ceil($max_h);
              $data['rmin']=floor($min_l);
             $data['flag']=1;
             $data['n']=$count;
             echo json_encode($data);
           
         
           
           
        }

  public function random_new()//随机产生一个线段
  {
        $this->load->helper('url');
         $filelink=$_POST['filelink'];
          
        
         
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $filelink.'_'));
        //$filename=$this->cache->get('filename');
        $count=$this->cache->get('Sample');
        $max=$this->cache->get('YH');
        $min=$this->cache->get('YL');
        $sum=0;
        $ay=array();
        
        while($sum<$count){
          $ay[$sum]=$min+mt_rand()/mt_getrandmax()*($max-$min);
          $sum++;

        }
       $d['max']=$max;
       $d['min']=$min;
       $d['ay']=$ay;
       $d['n']=$count;
       $da['flag']=1;
       echo json_encode($d);

  }

  public function compute()
  {
       $this->load->helper('url');
       $len=$_POST['len'];
       $ax=$_POST['ax'];    
       $ay=$_POST['ay'];
 
       $corr=$_POST['corr'];
       $operafile=$_POST['operafile'];
       $filelink=$_POST['filelink'];
       
         
       //  $username='WCY';
       $filepat='File/'.$filelink.'/';
       if(!is_dir($filepat)) 
          mkdir($filepat); // 如果不存在则创建
        $file1 = fopen($filepat.'/write1.csv','w');     
        fputcsv($file1,$ax);    
        fclose( $file1); 

        $file2 = fopen($filepat.'/write2.csv','w');     
        fputcsv($file2,$ay);   
        fclose( $file2);
system("unset DISPLAY");//删除DISPLAY环境变量
$text="brush(".$corr.','.'\''.$operafile.'\''.','.'\''.$filelink.'\''.")";
 $a=shell_exec("matlab -nodisplay -nojvm -r "."\"".$text."\" &");

$fps='File/'.$filelink.'/newy.csv';

           

        if(file_exists($fps)){
        $newdata=array();
        $file3 = fopen($fps,'r');
        $newdata['newy'] = fgetcsv($file3);
        fclose($file3);

        $ymin=100000;
        $ymax=-100000;
        $file5 = fopen($filepat.'all_newdata.csv','r');
        $headc=fgetcsv($file5);
        $row1=0; $row=0;
        $ct=count($headc);
        while ($data1 = fgetcsv($file5)) { //每次读取CSV里面的一行内容
         // var_dump(empty($data1));
           if(($row1==0)&&empty($data1)){
              break;
            }
            else{        
            for($i=0;$i<$ct;$i++)
          {

                $newdata['selected_genes'][$row1][$i]=$data1[$i];
                if($i>=3)
                  { 
                      if($ymin>$data1[$i])
                        $ymin=$data1[$i];
                      if($ymax<$data1[$i])
                        $ymax=$data1[$i];
                      $newdata['newda'][$row][$i-3]=$data1[$i];
                  }
          }
             $row1++;
             $row++;
        }
       }
        fclose($file5);
       if($row1==0)
         {
           $newdata['flag']=110;
          echo json_encode($newdata);
         }
       else{
        $newdata['file_name']='all_newdata.csv';
        $newdata['flag']=1;
        $newdata['title']="search result";
        $newdata['ymax']=ceil($ymax);
        $newdata['ymin']=floor($ymin);
        $newdata['c']=$ct-3;
        echo json_encode($newdata);
       }
    }else{
          $newdata['flag']=3;
          echo json_encode($newdata);
         }
  
 }

 public function readoperfile1()
  {
    $this->load->helper('url');
   $filelink=$_POST['filelink'];
 $filepat='File/'.$filelink.'/';
$fps='File/'.$filelink.'/newy.csv';
        
          if(file_exists($fps)){
             
        $newdata=array();
        $file3 = fopen($fps,'r');
        $newdata['newy'] = fgetcsv($file3);
        fclose($file3);

        
        $ymin=100000;
        $ymax=-100000;
        $file5 = fopen($filepat.'all_newdata.csv','r');
        $headc=fgetcsv($file5);
        $row1=0; $row=0;
        $ct=count($headc);
        while ($data1 = fgetcsv($file5)) { //每次读取CSV里面的一行内容
           if(($row1==0)&&empty($data1)){
              break;
            }
            else{     
            for($i=0;$i<$ct;$i++)
          {

                $newdata['selected_genes'][$row1][$i]=$data1[$i];
                if($i>=3)
                  { 
                      if($ymin>$data1[$i])
                        $ymin=$data1[$i];
                      if($ymax<$data1[$i])
                        $ymax=$data1[$i];
                      $newdata['newda'][$row][$i-3]=$data1[$i];
                  }
          }
             $row1++;
             $row++;
        }
        }
        fclose($file5);
       if($row1==0)
         {
           $newdata['flag']=110;
          echo json_encode($newdata);
         }
       else{
        $newdata['file_name']='all_newdata.csv';
        $newdata['flag']=1;
        $newdata['title']="search result";
        $newdata['ymax']=ceil($ymax);
        $newdata['ymin']=floor($ymin);
        $newdata['c']=$ct-3;
        echo json_encode($newdata);
       }
}else{
        $newdata['flag']=4;
        echo json_encode($newdata);
     }

  }


    public function contrast()
    {
      
           $this->load->helper('url');
           $ax = array();
           $ay = array();
           $c_ay = array();
           $corr=$_POST['corr'];
          
           $ax=$_POST['ax'];
           $ay=$_POST['ay'];
           $filelink=$_POST['filelink'];
           $max=$_POST['max_y'];
           $min=$_POST['min_y'];
           $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $filelink.'_'));
           $filename=$this->cache->get('filename');
        //   $min=$this->cache->get('YL');
         //  $max=$this->cache->get('YH');
           $count=$this->cache->get('Sample');
           $filepath1='File/'.$filelink;
           for($i=0;$i<$count;$i++)
             $ax_b[$i]=$i+1;  
       $file6 = fopen($filepath1.'/write1.csv','w');
          fputcsv($file6,$ax);
          fclose( $file6);

          $file7 = fopen($filepath1.'/write2.csv','w');
          fputcsv($file7,$ay);
          fclose( $file7);        


           $middle=($max+$min)/2;
           
           for($i=0;$i<count($ay);$i++)
              $c_ay[$i]=$middle*2-$ay[$i];
            
         
         
         // $filepath1='File/'.$filelink;

           if (!is_dir($filepath1)) 
                mkdir($filepath1); // 如果不存在则创建
          $file1 = fopen($filepath1.'/write3.csv','w');     
          fputcsv($file1,$ax);    
          fclose( $file1); 

          $file2 = fopen($filepath1.'/write4.csv','w');     
          fputcsv($file2,$c_ay);   
          fclose( $file2); 

         system("unset DISPLAY");//删除DISPLAY环境变量
          $text="contrast(".$corr.','.'\''.$filename.'\''.','.'\''.$filelink.'\''.")";
         $sc= shell_exec("matlab -nodisplay -nojvm -r "."\"".$text."\" &");

        
         $fps='File/'.$filelink.'/c_newy.csv';
        
          if(file_exists($fps)){
          $file8=fopen('File/'.$filelink.'/newy.csv','r');
           $data['ay']=fgetcsv($file8);
          fclose($file8);
          
            $dmax=max($data['ay']);
             $dmin=min($data['ay']);
             
          $file3 = fopen($fps,'r');
          $data['c_newy'] = fgetcsv($file3);
          fclose($file3);
           $max_h2=max($data['c_newy']);
             $min_l2=min($data['c_newy']);
             if($dmax<$max_h2)
              $dmax=$max_h2;
             if($dmin>$min_l2)
              $dmin=$min_l2;           
             // var_dump($min_l1);
          $data['max']=ceil($dmax); /*确定最大最小值来改变第一个坐标图的坐标*/
           $data['min']=floor($dmin);

         $data['c']=count($data['c_newy']);
         if(count($ay)!=$data['c']&&$data['ay'][$count-1]!=$ay[count($ay)-1])
           {
             for($i=1;$i<=$data['c'];$i++)
             { $data['ax'][$i-1]=$i;
              $data['c_ay'][$i-1]=$data['c_newy'][$i-1];
             }
           }
         else{
              $data['ax']=$ax;
             // $data['ay']=$ay;
             $data['c_ay']=$c_ay;
            }
        
$cmax=-100000;
$cmin=100000;
          $file5 = fopen('File/'.$filelink.'/c_all_newdata.csv','r');
          $headc=fgetcsv($file5);
          $row1=0;
          while ($data1 = fgetcsv($file5)) { //每次读取CSV里面的一行内容
               if(($row1==0)&&empty($data1)){
              break;
            }
            else{
              for($i=0;$i<count($data1);$i++)
                {
                     if($i>2)
                    {if($cmin>$data1[$i])
                        $cmin=$data1[$i];
                      if($cmax<$data1[$i])
                        $cmax=$data1[$i];
                      $data['c_newda'][$row1][$i-3]=$data1[$i];
                    }
                  $data['c_selected_genes'][$row1][$i]=$data1[$i];
                }
               $row1++;
          }}
          fclose($file5);
           if($row1==0)
           {
             $data['flag']=110;
           // $data['max']=ceil($dmax);//确定最大最小值来改变第一个坐标图的坐标
          // $data['min']=floor($dmin);
            echo json_encode($data);
           }
          else{
           $data['file_name']='c_all_newdata.csv';
           $data['filename']=$filename;
           $data['title']="contrast result";
           $data['cmax']=ceil($cmax);
           $data['cmin']=floor($cmin);
          // $data['max']=ceil($dmax);//确定最大最小值来改变第一个坐标图的坐标
          // $data['min']=floor($dmin);
           $data['flag']=1;
             echo json_encode($data);
          }
     }else{
           $data['flag']=2;
            echo json_encode($data);
          }

   }

   public function readoperfile2()
  {
    $this->load->helper('url');
    $filelink=$_POST['filelink'];
     $file10=fopen('File/'.$filelink.'/newy.csv');
     $data['ay']=fgetcsv($file10);
     fclose($file10);
     $dmax=max($data['ay']);
             $dmin=min($data['ay']);
    
     $fps='File/'.$filelink.'/c_newy.csv';

          if(file_exists($fps)){

          $file3 = fopen($fps,'r');
          $data['c_newy'] = fgetcsv($file3);
          fclose($file3);
         $max_h2=max($data['c_newy']);
             $min_l2=min($data['c_newy']);
             if($dmax<$max_h2)
              $dmax=$max_h2;
             if($dmin>$min_l2)
              $dmin=$min_l2;
              $data['max']=ceil($dmax);//确定最大最小值来改变第一个坐标图的坐标
           $data['min']=floor($dmin);

       $file4=fopen('File/'.$filelink.'/write3.csv','r');
          $ax=fgetcsv($file4);
         fclose($file4);
	$file6=fopen('File/'.$filelink.'/write4.csv','r');
          $c_ay=fgetcsv($file6);
         fclose($file6);
        
        $data['c']=count($data['c_newy']);
         if(count($data['c_ay'])!=$data['c'])
           {
             for($i=1;$i<=$data['c'];$i++)
             { $data['ax'][$i-1]=$i;
              $data['c_ay'][$i-1]=$data['c_newy'][$i-1];
             }
           }
         else{
             $data['ax']=$ax;
         // $data['ay']=$ay;
          $data['c_ay']=$c_ay;
           }
        /* $file4 = fopen('File/'.$filelink.'/c_newData.csv','r');
          $row=0;
          while ($data1 = fgetcsv($file4)) { //每次读取CSV里面的一行内容
          
              for($i=0;$i<count($data1);$i++)
                  $data['c_newda'][$row][$i]=$data1[$i];
               $row++;
          }
          fclose($file4);*/
$cmax=-100000;
$cmin=100000;
          $file5 = fopen('File/'.$filelink.'/c_all_newdata.csv','r');
          $headc=fgetcsv($file5);
          $row1=0;
          while ($data1 = fgetcsv($file5)) { //每次读取CSV里面的一行内容
                if(($row1==0)&&empty($data1)){
                         break;
            }
            else{
              for($i=0;$i<count($data1);$i++)
                {
                     if($i>2)
                    {if($cmin>$data1[$i])
                        $cmin=$data1[$i];
                      if($cmax<$data1[$i])
                        $cmax=$data1[$i];
                    $data['c_newda'][$row1][$i-3]=$data1[$i];
                    }
                  $data['c_selected_genes'][$row1][$i]=$data1[$i];
                }
               $row1++;
          }}
          fclose($file5);
          if($row1==0)
           {
             $data['flag']=110;
            // $data['max']=ceil($dmax);//确定最大最小值来改变第一个坐标图的坐标
          // $data['min']=floor($dmin);
            echo json_encode($data);
           }
          else{
           $data['file_name']='c_all_newdata.csv';
           $data['filename']=$filename;
           $data['title']="contrast result";
           $data['cmax']=ceil($cmax);
           $data['cmin']=floor($cmin);
          // $data['max']=ceil($dmax);//确定最大最小值来改变第一个坐标图的坐标
          // $data['min']=floor($dmin);
           $data['flag']=1;
             echo json_encode($data);
          }
        }else{
             $data['flag']=2;
              echo json_encode($data);
             }
    
  }


    public function shift()
    {
          $this->load->helper('url');
    
          $corr=$_POST['corr'];
          $gL=intval($_POST['L']);
          $gR=intval($_POST['R']);
          $ay = array();
          $ax = array();
           $ax=$_POST['ax'];
           $ay=$_POST['ay'];
           $filelink=$_POST['filelink'];
           $filename=$_POST['filename'];

           if($ay==NULL)
             return 0;
          else if($gL==0&&$gR==0){
        $sdata['ax']=$ax;
        $sdata['ay']=$ay; 
        $sdata['n']=count($ay); 
        $smin_l=100000;
        $smax_h=-100000;

        $file5 = fopen('File/'.$filelink.'/all_newdata.csv','r');
        $headc=fgetcsv($file5);
        $row1=0; $row=0;
        $ct=count($headc);
        while ($data1 = fgetcsv($file5)) { //每次读取CSV里面的一行内容
            if(($row1==0)&&empty($data1)){
              break;
            }
            else{
            for($i=0;$i<=$ct;$i++)
          {     if($i<=2)
                  $sdata['selected_shiftgenes'][$row1][$i]=$data1[$i];
                else if($i==3)
                  $sdata['selected_shiftgenes'][$row1][$i]=0;
                else
                  $sdata['selected_shiftgenes'][$row1][$i]=$data1[$i-1];

               /* if($i>=4)
                  { 
                      if($smin>$data1[$i-1])
                        $smin=$data1[$i-1];
                      if($smax<$data1[$i-1])
                        $smax=$data1[$i-1];
                      $sdata['snewy'][$row][$i-4]=$data1[$i-1];
                      
                  }*/
          }
           $sdata['snewy'][$row]=array_splice($data1,3);
           $smax_h=max($sdata['snewy'][$row]);
             $smin_l=min($sdata['snewy'][$row]);
              if($smax<$smax_h)
              $smax=$smax_h;
             if($smin>$smin_l)
              $smin=$smin_l;
             $row1++;
             $row++;
        }}
        fclose($file5);
        if($row1==0)
           {
             $sdata['flag']=110;
            echo json_encode($sdata);
           }
          else{
            // $smax=max($sdata['snewy']);
            // $smin=min($sdata['snewy']);
        $sdata['file_name']='all_newData.csv';
        $sdata['title']="shift result";
        $sdata['smax']=ceil($smax);
        $sdata['smin']=floor($smin);
        $sdata['flag']=1;
            echo json_encode($sdata);
         } }
          
        else{
      system("unset DISPLAY");//删除DISPLAY环境变量
      $text="shift(".$corr.','.'\''.$filename.'\''.','.'\''.$filelink.'\''.','.$gL.','.$gR.")";
       $sca= shell_exec("matlab -nodisplay -nojvm -r "."\"".$text."\" &");

      for($i=0;$i<count($ay);$i++)
          $ax[$i]=$i+1;
        $c1=count($ay)-$gR;
        $c2=count($ay)+$gL;
        for($i=0;$i<$c1;$i++)
          {
            $ax_b[$i]=$ax[$i+$gR];
            $ay_b[$i]=$ay[$i];
          }
        for($i=0;$i<$c2;$i++)
          {
            $ax_c[$i]=$ax[$i];
            $ay_c[$i]=$ay[$i-$gL];
          }
        $sdata['ax']=$ax;
        $sdata['ay']=$ay; 
        $sdata['n']=count($ay); 
        $sdata['ax_b']=$ax_b;
        $sdata['ay_b']=$ay_b;
        $sdata['ax_c']=$ax_c;
        $sdata['ay_c']=$ay_c;
        $sdata['nb']=count($ax_b); 
        $sdata['nc']=count($ax_c); 
        


        $filerr='File/'.$filelink.'/outData_r.csv';
        if(file_exists($filerr)) {
        $filer = fopen($filerr,'r');
        $headc=fgetcsv($filer);
        $rowr=0;
        while ($datar = fgetcsv($filer)) { //每次读取CSV里面的一行内容
             
            for($i=0;$i<count($datar);$i++)
            $sdata['snewy_r'][$rowr][$i]=$datar[$i];
            $rowr++;
        }
        fclose($filer);

        $filell='File/'.$filelink.'/outData_l.csv';
        
        $filel = fopen($filell,'r');
        $headc=fgetcsv($filel);
        $rowl=0;
        while ($datal = fgetcsv($filel)) { //每次读取CSV里面的一行内容

            for($i=0;$i<count($datal);$i++)
            $sdata['snewy_l'][$rowl][$i]=$datal[$i];
            $rowl++;
        }
        fclose($filel);
     
      $smax=-100000;
      $smin=100000;
        $files = fopen('File/'.$filelink.'/s_all_newdata.csv','r');
        $headc=fgetcsv($files);
        $row1=0;
        while ($data1 = fgetcsv($files)) { //每次读取CSV里面的一行内容
             if(($row1==0)&&empty($data1)){
              break;
            }
            else{
            for($i=0;$i<count($data1);$i++){
                $sdata['selected_shiftgenes'][$row1][$i]=$data1[$i];
                     /* if($i>3)
                     { if($smin>$data1[$i])
                        $smin=$data1[$i];
                      if($smax<$data1[$i])
                        $smax=$data1[$i];
                    }*/
            }

             $sdata['snewy'][$row1]=array_splice($data1,4);
             $smax_h=max($sdata['snewy'][$row1]);
             $smin_l=min($sdata['snewy'][$row1]);
              if($smax<$smax_h)
              $smax=$smax_h;
             if($smin>$smin_l)
              $smin=$smin_l;    
            $row1++;
        }}
        fclose($files);
       if($row1==0)
           {
             $data['flag']=110;
            echo json_encode($data);
           }
          else{
       // $smax=max($sdata['snewy']);
            // $smin=min($sdata['snewy']);
        $sdata['file_name']='s_all_newdata.csv';
        $genelist=[];
        $sdata['title']="shift result";
        $sdata['smax']=ceil($smax);
        $sdata['smin']=floor($smin);
        $sdata['flag']=1;
        echo json_encode($sdata);
        }
       }else{
               $sdata['flag']=3;
               echo json_encode($sdata);
            }
      }
           
    }

   public function readoperfile3()
  {
    $this->load->helper('url');
    $filelink=$_POST['filelink'];
     $filerr='File/'.$filelink.'/outData_r.csv';
        if (file_exists($filerr)) {
        $filer = fopen($filerr,'r');
        $headc=fgetcsv($filer);
        $rowr=0;
        while ($datar = fgetcsv($filer)) { //每次读取CSV里面的一行内容

            for($i=0;$i<count($datar);$i++)
            $sdata['snewy_r'][$rowr][$i]=$datar[$i];
            $rowr++;
        }
        fclose($filer);

        $filell='File/'.$filelink.'/outData_l.csv';
        
        $filel = fopen($filell,'r');
        $headc=fgetcsv($filel);
        $rowl=0;
        while ($datal = fgetcsv($filel)) { //每次读取CSV里面的一行内容

            for($i=0;$i<count($datal);$i++)
            $sdata['snewy_l'][$rowl][$i]=$datal[$i];
            $rowl++;
        }
        fclose($filel);

      $smax=-100000;
      $smin=100000;
        $files = fopen('File/'.$filelink.'/s_all_newdata.csv','r');
        $headc=fgetcsv($files);
        $row1=0;
        while ($data1 = fgetcsv($files)) { //每次读取CSV里面的一行内容
                 
           
            for($i=0;$i<count($data1);$i++){
                $sdata['selected_shiftgenes'][$row1][$i]=$data1[$i];
                     /* if($i>3)
                     { if($smin>$data1[$i])
                        $smin=$data1[$i];
                      if($smax<$data1[$i])
                        $smax=$data1[$i];
                    }*/
            }

             $sdata['snewy'][$row1]=array_splice($data1,4);
             $smax_h=max($sdata['snewy'][$row1]);
             $smin_l=min($sdata['snewy'][$row1]);
              if($smax<$smax_h)
              $smax=$smax_h;
             if($smin>$smin_l)
              $smin=$smin_l;
                 
            $row1++;
        }
        fclose($files);
        $sdata['file_name']='s_all_newdata.csv';
        $genelist=[];
        $sdata['title']="shift result";
        $sdata['smax']=ceil($smax);
        $sdata['smin']=floor($smin);
        $sdata['flag']=1;
        echo json_encode($sdata);
}else{
       $sdata['flag']=3;
       echo json_encode($sdata);
     }
  }

    public function save_file()
    {
      $this->load->helper('url');  
      $this->load->helper('download');
      $filelink=$_POST['filelink'];
     // $num=$_POST['num'];
      $filename=$_POST['filename'];
     /* if($num==1)
        $filep='File/'.$filelink.'/all_newdata.csv';
      else if($num==2)
        $filep='File/'.$filelink.'/c_all_newdata.csv';
      else if($num==3)
        $filep='File/'.$filelink.'/s_all_newdata.csv';
      else if($num==4)
        $filep='File/'.$filelink.'/filter_gene.csv';
      else*/
         $filep='File/'.$filelink.'/'.$filename;
     // $str="012wx34lst5cd6e7mnohijkpqr89abfguvyz";
         //  $length = strlen($str)-1;
        if (file_exists($filep)) {
          // $start=rand(0,$length);
         // $count=6;//字符串截取长度
         // $rand_file=substr($str, $start,$count).'.csv';
        $file_content=file_get_contents($filep);
        force_download($filename, $file_content);
       
        } 


    }

    public function cyto1()
    {
       $this->load->helper('url');
       $slide=$_POST['slide'];
       $filelink=$_POST['filelink'];
       $max=-100000;$min=100000;

       $file=fopen('File/'.$filelink.'/all_newdata.csv','r');
          $rows1=0;
          $rows2=0;
          $rows3=0;
          $rows4=0;
          $headervar=fgetcsv($file);
          while ($data1 = fgetcsv($file)) { //每次读取CSV里面的一行内容
                                          //print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
              if($data1[2]>=$slide||$rows1==0)
                {
                  if($rows1==0)
                     { $data['outsource']=$data1[0];$data['sR']=$data1[2];}
                   else
                    { $data['outarget1'][$rows1-1]=$data1[0];$data['out1R'][$rows1-1]=$data1[2];}
                  $rows1++;
                }
                for($i=3;$i<count($data1);$i++){
                    if($max<$data1[$i])
                       $max=$data1[$i];
                    if($min>$data1[$i])
                       $min=$data1[$i];
                 }
          }
          fclose($file);
           $ff='File/'.$filelink.'/c_all_newdata.csv';
           if(file_exists($ff)) {
                 $files = fopen($ff,'r');
                $headervar=fgetcsv($files);
                
                 while ($data2 = fgetcsv($files)) {
                   if($data2[2]>=$slide){
                    { $data['outarget2'][$rows2]=$data2[0];$data['out2R'][$rows2]=$data2[2];}
                    $rows2++;
                   }
                   for($i=3;$i<count($data2);$i++){
                    if($max<$data2[$i])
                       $max=$data2[$i];
                    if($min>$data2[$i])
                       $min=$data2[$i];
                    }

                 }

              fclose($files);   
          }else{
            $data['outarget2']=null;
            $data['out2R']=null;
          }

         $fff='File/'.$filelink.'/s_all_newdata.csv';
           if(file_exists($fff)) {
                 $files = fopen($fff,'r');
                $headervar=fgetcsv($files);
                
                 while ($data3 = fgetcsv($files)) {
                   if($data3[3]==1){
                         if($data3[2]>=$slide){
                            { $data['outarget3'][$rows3]=$data3[0];$data['out3R'][$rows3]=$data3[2];}
                              $rows3++;
                           }
                  }else{
                        if($data3[2]>=$slide){
                            { $data['outarget4'][$rows4]=$data3[0];$data['out4R'][$rows4]=$data3[2]; }
                             $rows4++;
                           }
                      }

                for($i=4;$i<count($data3);$i++){
                    if($max<$data3[$i])
                       $max=$data3[$i];
                    if($min>$data3[$i])
                       $min=$data3[$i];
                 }
               
             }

              fclose($files);   
          }else{
            $data['outarget3']=null;
            $data['outarget4']=null;
           $data['out3R']=null;
            $data['out4R']=null;
          }
       
          $data['max']=$max;
          $data['min']=$min;
          $data['count']=$rows1+$rows2+$rows3+$rows4-1;
      echo json_encode($data);
    }


    public function cyto2()
    {
       $this->load->helper('url');
       $filelink=$_POST['filelink'];
      // $corr=$_POST['corr'];
      $filename=$_POST['filename'];
       $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $filelink.'_'));
           $sample=$this->cache->get('Sample');
       
       // var_dump($corr);
        $max=-10000;$min=10000;
         $row=0;
        if(strpos($filename, "cluster") !== false)//存在就是true
          {
            $fil=fopen('File/'.$filelink.'/'.$filename,'r');
           
            while ($da = fgetcsv($fil)) {
                $data['genes'][$row]=$da[0];
                $r=count($da)-2;
               
               for($i=2;$i<count($da);$i++)
              {
                if($max<$da[$i])
                  $max=$da[$i];
                if($min>$da[$i])
                  $min=$da[$i];
              }
               $data['genedata'][$row][]=array_splice($da,2); 
                $row++;
            }
             fclose($fil);

          }
        else{
           $file = fopen('File/'.$filelink.'/'.$filename,'r');
          $headervar=fgetcsv($file);
          if(strcmp($filename,"s_all_newdata.csv")!=0){
            $r=count($headervar)-3;
             $start=3;
             if($r!=$sample)
             { $r=count($headervar)-4;
               $start=4;
             }
          
           while ($data1 = fgetcsv($file)) { //每次读取CSV里面的一行内容
             // if($corr<=$data1[2]){
              $data['genes'][$row]=$data1[0];
              for($i=$start;$i<count($data1);$i++)
              {
                if($max<$data1[$i])
                  $max=$data1[$i];
                if($min>$data1[$i])
                  $min=$data1[$i];
              }
               $data['genedata'][$row][]=array_splice($data1,$start); 
               $row++;
          }
         // fclose($file);
          }
          else{
               $r=count($headervar)-4;
           while ($data2 = fgetcsv($file)) { //每次读取CSV里面的一行内容
              // if($corr<=$data2[2]){                               
              $data['genes'][$row]=$data2[0];

              for($i=4;$i<count($data2);$i++)
              {
                if($max<$data2[$i])
                  $max=$data2[$i];
                if($min>$data2[$i])
                  $min=$data2[$i];
              }
               $data['genedata'][$row][]=array_splice($data2,4);
               $row++;
          }
         // fclose($file);
                
              }
        fclose($file);
        }
          $max=ceil($max);
         $min=floor($min);
          $data['minc']=$min;
          $data['maxc']=$max;
          $data['count']=$row;
          $data['recordnum']=$r;
          echo json_encode($data);
       
    }

    function line()
    {
      $this->load->helper('url');
      $method=$_POST['method'];
      $kinds=$_POST['kinds'];
      $operafile=$_POST['filename'];
      $filelink=$_POST['filelink'];
      $filepp="File/".$filelink.'/';
      if(!file_exists($filepp)){
          mkdir($filepp);
      }
      $max=-10000;$min=10000;
       system("unset DISPLAY");//删除DISPLAY环境变量
      $text="ClusterK(".$kinds.','.'\''.$filelink.'\''.','.'\''.$operafile.'\''.")";
     $ck= shell_exec("matlab -nodisplay -nojvm -r "."\"".$text."\" &");
      
    $filepp='File/'.$filelink.'/gdata.csv';
    if(file_exists($filepp)){
      $ldata=array();
      $file4=fopen($filepp,'r');
        $row=0;
        while ($data = fgetcsv($file4)) { //每次读取CSV里面的一行内容
                                        //print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
            $ldata['gdata'][$row]=$data;
            $ccount=count($data);
            for($i=0;$i<$ccount;$i++)
               { if($max<$data[$i])
                  $max=$data[$i];
                 if($min>$data[$i])
                  $min=$data[$i];
                }
             $row++;
        }
        fclose($file4);
    $ldata['count']=$row;
    $ldata['ccount']=$ccount;//dimension
     $max=ceil($max);$min=floor($min);
    $ldata['dmax']=$max;
    $ldata['dmin']=$min;
    $ldata['flag']=1;
    echo json_encode($ldata);
}else{
      $ldata['flag']=6;
     echo json_encode($ldata);
     }
    }

   public function readclusterfile()
{
   $this->load->helper('url');
   $filelink=$_POST['filelink'];
   $filepp='File/'.$filelink.'/gdata.csv';
    if(file_exists($filepp)){
    $ldata=array();
      $file4=fopen($filepp,'r');
        $row=0;
        while ($data = fgetcsv($file4)) { //每次读取CSV里面的一行内容
                                        //print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
            $ldata['gdata'][$row]=$data;
            $ccount=count($data);
            for($i=0;$i<$ccount;$i++)
               { if($max<$data[$i])
                  $max=$data[$i];
                 if($min>$data[$i])
                  $min=$data[$i];
                }
             $row++;
        }
        fclose($file4);
    $ldata['count']=$row;
    $ldata['ccount']=$ccount;//dimension
     $max=ceil($max);$min=floor($min);
    $ldata['dmax']=$max;
    $ldata['dmin']=$min;
    $ldata['flag']=1;
    echo json_encode($ldata);
}else{
       $ldata['flag']=6;
    echo json_encode($ldata);
     }
}
    public function process()
    {
        $filelink=$_POST['filelink'];
        $filename=$_POST['filename'];
        $flag1=$_POST['flag1'];
        $sheet=0;$min=100000;$max=-100000;
        $filePath="uploads/".$filelink."/".$filename;
        if($flag1=='1')
        {
         system("unset DISPLAY");//删除DISPLAY环境变量
        $text="Normalize_file(".'\''.$filelink.'\''.','.'\''.$filename.'\''.")";
        $cok= shell_exec("matlab -nodisplay -nojvm -r "."\"".$text."\" &");
        }
        $file_size=filesize($filePath);
        $file_size/=pow(1024,2);
         if($file_size<=7){
         $file=fopen($filePath,'r');//读取操作的源文件，如yeastexpression.csv
        $genedata_list=array();
        $genes=array();
        $row=0;  $column=0;
        $max=-100000; $min=100000;
        while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
                                        //print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
           $gedata=array_splice($data,1);
           // $genedata_list[$row] =$data;
           // $genes[$row]=$genedata_list[$row][0];
               for($i=0;$i<count($gedata);$i++)
        {
          
            
             if($gedata[$i]!=""){
              if($max<$gedata[$i])
                 $max=$gedata[$i];

              if($min>$gedata[$i])
                 $min=$gedata[$i];
            
             }
        }
             $row++;
        }
        fclose($file);

      // $column=count($genedata_list[0])-1;
        $column=count($gedata);
     /* for($i=0;$i<$row;$i++)
        {
          $genedata_list[$i]=array_splice($genedata_list[$i],1);
          for($j=0;$j<$column;$j++)
            {
             if($genedata_list[$i][$j]!=""){
              if($max<$genedata_list[$i][$j])
                 $max=$genedata_list[$i][$j];

              if($min>$genedata_list[$i][$j])
                 $min=$genedata_list[$i][$j];
            }
             }
        }*/
       // $ml=$min;$mh=$max;
       // $max=ceil($max);$min=floor($min);

        unset($gedata);
        // $prex=$filelink;
      }else{
        system("unset DISPLAY");//删除DISPLAY环境变量
        $text="Read_file(".'\''.$filelink.'\''.','.'\''.$filename.'\''.")";
        $ck= shell_exec("matlab -nodisplay -nojvm -r "."\"".$text."\" &");
        if(file_exists('File/'.$filelink.'/filesize.csv')){ 
         $fi=fopen('File/'.$filelink.'/filesize.csv','r');
         $header=fgetcsv($fi);
         $df=fgetcsv($fi);
         fclose($fi);
         $max=$df[0];
         $min=$df[1];
         $row=$df[2];
         $column=$df[3];
        }
      }
       $ml=$min;$mh=$max;
        $max=ceil($max);$min=floor($min);
         $prex=$filelink;
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => $prex.'_'));
        $this->cache->save('filename', $filename,604800);
        $this->cache->save('recordNum',$row,604800);
        $this->cache->save('Sample',$column,604800);
        $this->cache->save('YL',$min,604800);
        $this->cache->save('YH',$max,604800);
        $this->cache->save('mh',$mh,604800);
        $this->cache->save('ml',$ml,604800);
        $data['flag']=1;
        $data['YH']=$max;
        $data['row']=$row;
       // unset($gedata);
        echo json_encode($data);
    }





  



}
