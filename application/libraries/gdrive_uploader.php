<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class gdrive_uploader
{
	public function index()
	{
        $all_uploadeddata = array('folder_name'=>"sample_folder","folder_id"=>"1U1ZBImmoS-W92aj_yw8irn-uUwtQ_mqL","data" => array(array('name'=>'sample.pdf','type'=>'application/pdf','rq_name'=>"Sample 1"),array('name'=>'sample2.pdf','type'=>'application/pdf','rq_name'=>"Sample 2")));
        $string = http_build_query($all_uploadeddata);
        $ch = curl_init("http://localhost:4003/gdriveuploader/");
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        return $result;
        curl_close($ch);
    }
}
?>