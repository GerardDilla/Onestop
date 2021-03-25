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
	

	public function login()
	{
		$data['view'] = $this->body.'Login/Login';
		$data['title'] = 'Login';
		return $data;
	}
	public function forgotPassword()
	{
		$data['view'] = $this->body.'Login/ForgotPassword';
		$data['title'] = 'Forgot Password';
		return $data;
	}
	public function changePassword()
	{
		$data['view'] = $this->body.'Login/ChangePassword';
		$data['title'] = 'Change Password';
		return $data;
	}

	public function setupUserPass()
	{
		$data['view'] = $this->body.'Login/ChangeUserPass';
		$data['title'] = 'Setup your Username & Password';
		return $data;
	}
	public function passwordReset()
	{
		$data['view'] = $this->body.'PasswordReset';
		$data['title'] = 'Password Reset';
		return $data;
	}
}