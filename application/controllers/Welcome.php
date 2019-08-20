<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('user_model', 'user_model', TRUE);
	}

	public function index()
	{
		// $this->load->view('welcome_message');
		$this->load->view('login');
	}


	public function checkSession()
	{
		if($this->session->userdata('email') != "")
		{
			// redirect('/welcome/dashboard');
		}
		else
		{
			redirect('/');
		}
	}

	public function login()
	{
		// print_r($_POST);
		// echo md5($_POST['password']);
		$data = array(
			"email" => $_POST['email'],
			"password" => md5($_POST['password']),
		);
		$get = $this->user_model->check_login($data);
		if($get == 1)
		{
			// echo "Login Done";
			$this->session->set_userdata($data);
			redirect('/welcome/dashboard');
		}
		else
		{
			// echo "Login Fail";
			$this->session->set_flashdata('error', 'Username and Password not match');
			redirect('/');
		}
	}

	public function logout()
	{
		session_destroy();
		redirect('/');
	}

	public function dashboard()
	{
		$this->checkSession();
		// $this->load->view('welcome_message');
		$this->load->view('admin/header');
		$this->load->view('admin/side');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
}
