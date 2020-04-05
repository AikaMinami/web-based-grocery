<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller {

	function index()
	{
		$this->load->view('api_view');
	}
 
	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				$api_url = "http://localhost/tutorial/codeigniter/api/delete";

				$form_data = array(
					'admin_username'		=>	$this->input->post('admin_username')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;




			}

			if($data_action == "Edit")
			{
				$api_url = "http://localhost/tutorial/codeigniter/api/update";

				$form_data = array(
					'admin_username'		=>	$this->input->post('admin_username'),
					'admin_password'		=>	$this->input->post('admin_password'),
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;







			}

			if($data_action == "fetch_single")
			{
				$api_url = "http://localhost/tutorial/codeigniter/api/fetch_single";

				$form_data = array(
					'admin_username'		=>	$this->input->post('admin_username')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;






			}

			if($data_action == "Insert")
			{
				$api_url = "http://localhost/tutorial/codeigniter/api/insert";
			

				$form_data = array(
					'admin_username'		=>	$this->input->post('admin_username'),
					'admin_password'		=>	$this->input->post('admin_password')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;


			}





			if($data_action == "fetch_all")
			{
				$api_url = "http://localhost/tutorial/codeigniter/api";

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
					foreach($result as $row)
					{
						$output .= '
						<tr>
							<td>'.$row->admin_username.'</td>
							<td>'.$row->admin_password.'</td>
							<td><butto type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->admin_username.'">Edit</button></td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->admin_username.'">Delete</button></td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}

				echo $output;
			}
		}
	}
	
}

?>