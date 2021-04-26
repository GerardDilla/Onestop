<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends MY_Controller
{

	public function index()
	{

    }
    public function digital_citizenship()
	{
		$this->default_template($this->view_directory->digitalCitizenship());
	}
    public function id_application()
	{
		$this->default_template($this->view_directory->idApplication());
	}
}
?>