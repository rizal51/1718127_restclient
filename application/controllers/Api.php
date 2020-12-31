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
		$this->form_validation->set_rules('nama_pel', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('jenis_mobil', 'jenis_mobil', 'required');
		$this->form_validation->set_rules('tgl_sewa', 'tgl_sewa', 'required');
		$this->form_validation->set_rules('tgl_kembali', 'tgl_kembali', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'nama_pel'      =>  $this->input->post('nama_pel'),
				'alamat'        =>  $this->input->post('alamat'),
				'jenis_mobil'   =>  $this->input->post('jenis_mobil'),
				'tgl_sewa'      =>  $this->input->post('tgl_sewa'),
				'tgl_kembali'   =>  $this->input->post('tgl_kembali')
			);

			$this->api_model->insert_api($data);

			$array = array(
				'success'       =>  true
			);
		}
		else
		{
			$array = array(
				'error'             =>  true,
				'nama_pel_error'    =>  form_error('nama_pel'),
				'alamat_error'      =>  form_error('alamat'),
				'jenis_mobil_error' =>  form_error('jenis_mobil'),
				'tgl_sewa_error'    =>  form_error('tgl_sewa'),
				'tgl_kembali_error' =>  form_error('tgl_kembali')
			);
		}
		echo json_encode($array);
	}

	function fetch_single()
	{
		if($this->input->post('id'))
		{
			$data = $this->api_model->fetch_single_user($this->input->post('id'));

			foreach($data as $row)
			{
				$output['nama_pel'] = $row['nama_pel'];
				$output['alamat'] = $row['alamat'];
				$output['jenis_mobil'] = $row['jenis_mobil'];
				$output['tgl_sewa'] = $row['tgl_sewa'];
				$output['tgl_kembali'] = $row['tgl_kembali'];
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('nama_pel', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('jenis_mobil', 'jenis_mobil', 'required');
		$this->form_validation->set_rules('tgl_sewa', 'tgl_sewa', 'required');
		$this->form_validation->set_rules('tgl_kembali', 'tgl_kembali', 'required');
		if($this->form_validation->run())
		{   
			$data = array(
				'nama_pel'      =>  $this->input->post('nama_pel'),
				'alamat'        =>  $this->input->post('alamat'),
				'jenis_mobil'   =>  $this->input->post('jenis_mobil'),
				'tgl_sewa'      =>  $this->input->post('tgl_sewa'),
				'tgl_kembali'   =>  $this->input->post('tgl_kembali')
			);
			$this->api_model->update_api($this->input->post('id'), $data);
			$array = array(
				'success'       =>  true
			);
		}
		else
		{
			$array = array(
				'error'             =>  true,
				'nama_pel_error'    =>  form_error('nama_pel'),
				'alamat_error'      =>  form_error('alamat'),
				'jenis_mobil_error' =>  form_error('jenis_mobil'),
				'tgl_sewa_error'    =>  form_error('tgl_sewa'),
				'tgl_kembali_error' =>  form_error('tgl_kembali')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('id'))
		{
			if($this->api_model->delete_single_user($this->input->post('id')))
			{
				$array = array(

					'success'   =>  true
				);
			}
			else
			{
				$array = array(
					'error'     =>  true
				);
			}
			echo json_encode($array);
		}
	}

}
?>