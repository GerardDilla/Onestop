<?php
defined('BASEPATH') or exit('No direct script access allowed');


class view_directory
{
	protected $body = 'Body/';

	public function assessment()
	{
		$data['view'] = $this->body . 'Assessment';
		$data['title'] = 'Self Enrollment';
		return $data;
	}

	public function digitalCitizenship()
	{
		$data['view'] = $this->body.'CitizenshipAndId/DigitalCitizenship';
		$data['title'] = 'Digital Citizenship';
		return $data;
	}

	public function idApplication()
	{
		$data['view'] = $this->body.'CitizenshipAndId/IdApplication';
		$data['title'] = 'ID Application';
		return $data;
	}
	

	public function login()
	{
		$data['view'] = $this->body . 'Login/Login';
		$data['title'] = 'Login';
		return $data;
	}
	public function forgotPassword()
	{
		$data['view'] = $this->body . 'Login/ForgotPassword';
		$data['title'] = 'Forgot Password';
		return $data;
	}
	public function changePassword()
	{
		$data['view'] = $this->body . 'Login/ChangePassword';
		$data['title'] = 'Change Password';
		return $data;
	}

	public function setupUserPass()
	{
		$data['view'] = $this->body . 'Login/ChangeUserPass';
		$data['title'] = 'Setup your Username & Password';
		return $data;
	}
	public function passwordReset()
	{
		$data['view'] = $this->body . 'PasswordReset';
		$data['title'] = 'Password Reset';
		return $data;
	}
	public function dataTable()
	{
		$data['view'] = $this->body . 'Component/DataTable';
		$data['title'] = 'Data Table';
		return $data;
	}
	public function validationOfDocuments()
	{
		$data['view'] = $this->body . 'ValidationDocuments';
		$data['title'] = 'Validation of Documents';
		return $data;
	}
	public function ValidationOfTobeFollowedDocuments()
	{
		$data['view'] = $this->body . 'ValidationOfTobeFollowedDocuments';
		$data['title'] = 'Submission of To be Followed Requirements';
		return $data;
	}
}
