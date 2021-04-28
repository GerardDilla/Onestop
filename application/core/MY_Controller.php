<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{


        protected $title;
        // protected $data;

        function __construct()
        {

                parent::__construct();
                $this->load->library('view_directory');
                $this->load->library('sdca_mailer', array('email' => $this->email, 'load' => $this->load));
                $this->load->library('gdrive_uploader', array('folder_id' => '1pqk-GASi0205D9Y8QEi0zGNrEdH8nmap'));
                $this->load->library('session');
                $this->load->database();
                $this->load->model('MainModel', 'mainmodel');
                // $this->load->model('AssesmentModel');
                $this->load->library('encryption');
                $this->load->library('pagination');

                $this->title = 'Default';
        }


        public function default_template($body = array('view' => ''))
        {

                $directory = 'Layout/Default/';
                $this->template['Title'] = $this->data['tab_active'] = $body['title'] ? $body['title'] : $this->title;
                $this->template['Header'] = $this->load->view($directory . 'Header.php', $this->data, true);
                $this->template['Sidenav'] = $this->load->view($directory . 'Sidenav.php', $this->data, true);
                $this->template['Body'] = $this->load->view($body['view'], $this->data, true);
                $this->template['Script'] = $this->load->view($directory . 'Script.php', $this->data, true);
                $this->template['Footer'] = $this->load->view($directory . 'Footer.php', $this->data, true);
                $this->load->view($directory . 'Template', $this->template);
        }

        public function login_template($body = array('view' => ''))
        {
                $directory = 'Layout/Login/';
                $this->template['Title'] = $this->data['tab_active'] = $body['title'] ? $body['title'] : $this->title;
                $this->template['Header'] = $this->load->view($directory . 'Header.php', $this->data, true);
                $this->template['Body'] = $this->load->view($body['view'], $this->data, true);
                $this->template['Script'] = $this->load->view($directory . 'Script.php', $this->data, true);
                // $this->template['Footer'] = $this->load->view($directory . 'Footer.php', $this->data, true);
                $this->load->view($directory . 'Template', $this->template);
        }
}
