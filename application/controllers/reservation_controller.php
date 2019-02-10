<?php
class Reservation_Controller extends CI_Controller
{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library("pagination");
			//$this->load->model("hotelInfoModel");
			$this->load->model("common");
			$this->load->model("room_model");

        }

        public function index(){

            $this->load->view('admin/header');
            $this->load->view('reservation/new');
            $this->load->view('admin/footer');



        }
        
}