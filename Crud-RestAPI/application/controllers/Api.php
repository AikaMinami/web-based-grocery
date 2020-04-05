<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->api_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('admin_username', 'admin_username', 'required');
		$this->form_validation->set_rules('admin_password', 'admin_username', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'admin_username'	=>	$this->input->post('admin_username'),
				'admin_password'	=>	$this->input->post('admin_password')
			);

			$this->api_model->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'admin_username_error'		=>	form_error('admin_username'),
				'admin_password_error'		=>	form_error('admin_password')
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('admin_username'))
		{
			$data = $this->api_model->fetch_single_user($this->input->post('id'));

			foreach($data as $row)
			{
				$output['admin_username'] = $row['admin_username'];
				$output['admin_password'] = $row['admin_password'];
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('admin_username', 'admin_username', 'required');

		$this->form_validation->set_rules('admin_password', 'admin_password', 'required');
		if($this->form_validation->run())
		{	
			$data = array(
				'admin_username'		=>	$this->input->post('admin_username'),
				'admin_password'			=>	$this->input->post('admin_password')
			);

			$this->api_model->update_api($this->input->post('admin_username'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'				=>	ture,
				'admin_username_error'	=>	form_error('admin_username'),
				'admin_password_error'	=>	form_error('admin_password')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('admin_username'))
		{
			if($this->api_model->delete_single_user($this->input->post('admin_username')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}

}


?>