<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Main extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//$this->load->view('Body/index');
		// $this->default_template($this->view_directory->assessment());
		// echo 'hello';
		$this->login_template($this->view_directory->login());
		$this->appkey = 'testkey101';
	}
	public function forgotPassword()
	{
		$this->login_template($this->view_directory->forgotPassword());
	}
	public function changePassword()
	{
		$this->login_template($this->view_directory->changePassword());
	}
	public function selfassesment()
	{
		//$this->curl_test();
		$this->data['student_information'] = 'Body/Assessment_Content/Student_Information';
		$this->data['advising'] = 'Body/Assessment_Content/Advising';
		$this->data['payment'] = 'Body/Assessment_Content/Payment';
		$this->default_template($this->view_directory->assessment());
	}
	private function curl_test()
	{

		$url = base_url() . 'index.php/temp_api/test';
		$fields = [
			'name '      => 'gerard',
			'type' => 'admin'
		];
		$fields_string = http_build_query($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		echo $result;
	}
	public function passwordReset()
	{
		$this->default_template($this->view_directory->passwordReset());
	}
	public function logout()
	{
		redirect(base_url('/'));
	}
	public function export_assessmentform()
	{
	}

	public function phpspreadsheettest()
	{

		// $spreadsheet = new Spreadsheet();
		$this->inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv\
		$this->inputFileName = './assets/excel_template/AssessmentForm_Template.xlsx';
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->inputFileName);
		$sheet = $spreadsheet->getActiveSheet();
		// $this->sheet1 = $this->spreadsheet->getSheet(0);
		// $this->sheet2 = $this->spreadsheet->getSheet(1);
		// $this->cell;

		$sheet->setCellValue('E8', '123145');
		$sheet->setCellValue('C9', 'GERARD DILLA');
		$sheet->setCellValue('D10', '12321321312321321321321321321');

		// $sheet->setCellValue('A1', 'Hello World !');

		// $writer = new Xlsx($spreadsheet);
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet);
		$writer->writeAllSheets();
		// header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="teststes.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output'); // download file 
	}
	private function assessmentform_export_data()
	{
		$this->sheet1->setCellValue($data['Cell'], $data['Value']);
	}
}
