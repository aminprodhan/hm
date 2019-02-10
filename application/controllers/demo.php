<?php
/**
 * dashboard
 */
class Demo extends CI_Controller
{
	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin');
		$this->load->view('admin/footer');
	}
	public function blank_page(){
		$this->load->view('admin/header');
		$this->load->view('demo/blank-page');
		$this->load->view('admin/footer');
	}
	public function form_basic_inputs(){
		$this->load->view('admin/header');
		$this->load->view('demo/form-basic-inputs');
		$this->load->view('admin/footer');
	}
	public function form_horizontal(){
		$this->load->view('admin/header');
		$this->load->view('demo/form-horizontal');
		$this->load->view('admin/footer');
	}
	public function form_input_groups(){
		$this->load->view('admin/header');
		$this->load->view('demo/form-input-groups');
		$this->load->view('admin/footer');
	}
	public function form_vertical(){
		$this->load->view('admin/header');
		$this->load->view('demo/form-vertical');
		$this->load->view('admin/footer');
	}
	public function invoice_view(){
		$this->load->view('admin/header');
		$this->load->view('demo/invoice_view');
		$this->load->view('admin/footer');
	}
	public function tables_basic(){
		$this->load->view('admin/header');
		$this->load->view('demo/tables-basic');
		$this->load->view('admin/footer');
	}
	public function tables_datatables(){
		$this->load->view('admin/header');
		$this->load->view('demo/tables-datatables');
		$this->load->view('admin/footer');
	}
	public function tabs(){
		$this->load->view('admin/header');
		$this->load->view('demo/tabs');
		$this->load->view('admin/footer');
	}
	public function uikit(){
		$this->load->view('admin/header');
		$this->load->view('demo/uikit');
		$this->load->view('admin/footer');
	}
	public function login(){
		$this->load->view('demo/login');
	}
	public function fortgot_password(){
		$this->load->view('demo/forgot-password');
	}
}