<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class gdrive_uploader
{
    protected $config;
    public function __construct($config){
        $this->config = $config;
    }
	public function index($data)
	{
        $main_folder_id = $this->config['folder_id'];
        $all_uploadeddata = array('folder_name'=>$data['folder_name'],"folder_id"=>$main_folder_id,"data" => $data['data']);
        $string = http_build_query($all_uploadeddata);
        $ch = curl_init("https://localhost:4003/gdriveuploader/");
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        return $result;
        curl_close($ch);
  }
  // when calling this function you need to pass two parameters (file_name & folder_id) ex: array("folder_name"=>"","folder_id"=>"")
  public function getFileId($data)
	{
        $main_folder_id = $this->config['folder_id'];
        // $all_uploadeddata = array('folder_name'=>"my_folder","folder_id"=>$main_folder_id,"data" => array(array('name'=>'sample.pdf','type'=>'application/pdf','rq_name'=>"Sample 1"),array('name'=>'sample2.pdf','type'=>'application/pdf','rq_name'=>"Sample 2")));
        $all_uploadeddata = array('file_name'=>$data['file_name'],"folder_id"=>$data['folder_id']);
        $string = http_build_query($all_uploadeddata);
        $ch = curl_init("https://localhost:4003/gdriveuploader/get_id");
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        // curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
          $error_msg = curl_error($ch);
          return $error_msg;
        }
        else{
          return $result;
        }
        
        curl_close($ch);
  }
  public function getAllFilesInFolder()
	{
        $all_uploadeddata = array();
        $string = http_build_query($all_uploadeddata);
        $ch = curl_init("https://localhost:4003/gdriveuploader/getjson");
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch,CURLOPT_FRESH_CONNECT,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
          $error_msg = curl_error($ch);
          return $error_msg;
        }
        else{
          return $result;
        }
        
        curl_close($ch);
  }
}
?>