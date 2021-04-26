<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class gdrive_uploader
{
    protected $config;
    public function __construct($config){
        $this->config = $config;
    }
	public function index()
	{
        $main_folder_id = $this->config['folder_id'];
        $all_uploadeddata = array('folder_name'=>"my_folder","folder_id"=>$main_folder_id,"data" => array(array('name'=>'sample.pdf','type'=>'application/pdf','rq_name'=>"Sample 1"),array('name'=>'sample2.pdf','type'=>'application/pdf','rq_name'=>"Sample 2")));
        $string = http_build_query($all_uploadeddata);
        $ch = curl_init("http://localhost:4003/gdriveuploader/");
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        return $result;
        curl_close($ch);
    }
}
?>