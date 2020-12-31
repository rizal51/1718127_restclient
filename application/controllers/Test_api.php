<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller {

	function index()
	{
		$this->load->view('view_pelanggan');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				$api_url = "http://localhost/1718127_rest_client/api/delete";

				$form_data = array(
					'id'		=>	$this->input->post('user_id')
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
				$api_url = "http://localhost/1718127_rest_client/api/update";

				$form_data = array(
					'id'			=>	$this->input->post('user_id'),
					'nama_pel'		=>	$this->input->post('nama_pel'),
					'alamat'		=>	$this->input->post('alamat'),
					'jenis_mobil'	=>	$this->input->post('jenis_mobil'),
					'tgl_sewa'		=>	$this->input->post('tgl_sewa'),
					'tgl_kembali'	=>	$this->input->post('tgl_kembali')
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
				$api_url = "http://localhost/1718127_rest_client/api/fetch_single";

				$form_data = array(
					'id'		=>	$this->input->post('user_id')
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
				$api_url = "http://localhost/1718127_rest_client/api/insert";
				$form_data = array(
					'id'			=>	$this->input->post('user_id'),
					'nama_pel'		=>	$this->input->post('nama_pel'),
					'alamat'		=>	$this->input->post('alamat'),
					'jenis_mobil'	=>	$this->input->post('jenis_mobil'),
					'tgl_sewa'		=>	$this->input->post('tgl_sewa'),
					'tgl_kembali'	=>	$this->input->post('tgl_kembali')
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
				$api_url = "http://localhost/1718127_rest_client/api";

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
							<td>'.$row->nama_pel.'</td>
							<td>'.$row->alamat.'</td>
							<td>'.$row->jenis_mobil.'</td>
							<td>'.$row->tgl_sewa.'</td>
							<td>'.$row->tgl_kembali.'</td>
							<td><butto type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Edit</button></td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Delete</button></td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">Tidak ada data</td>
					</tr>
					';
				}
				echo $output;
			}
		}
	}
}
?>