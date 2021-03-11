<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class view_directory 
{
	protected $body = 'Body/';

	public function assessment()
	{
		$data['view'] = $this->body.'Assessment';
		$data['title'] = 'Self Assessment';
		return $data;
	}
	

}