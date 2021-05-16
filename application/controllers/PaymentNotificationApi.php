<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentNotificationApi extends CI_Controller
{
    
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Request-Headers: Content-Type');
    }
    public function index(){
        
    }
}