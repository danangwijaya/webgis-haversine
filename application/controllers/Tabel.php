<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('DestinasiModel','Model');
		if($this->session->logged!==true){
			redirect('auth');
		  }
		if($this->session->level!=='Admin'){
			redirect('tabel');
		  }
	}

	public function index()
	{
		$datacontent['url']='tabel';
		$datacontent['title']='Tabel Destinasi';
		$datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('tabel/tabelView',$datacontent,TRUE);
		$data['title']='WebGIS';
		$this->load->view('layouts/html',$data);
	}

	public function form($parameter='',$id='')
	{
		$datacontent['url']='tabel';
		$datacontent['parameter']=$parameter;
		$datacontent['id']=$id;
		$datacontent['title']='Form Destinasi';
		$data['content']=$this->load->view('tabel/formView',$datacontent,TRUE);
		// $data['js']=$this->load->view('tabel/js/formJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('layouts/html',$data);
	}
	
	public function simpan()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Proses unggah gambar
			$config['upload_path'] = './assets/unggah/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
	
			if ($this->upload->do_upload('gambar')) {
				$upload_data = $this->upload->data();
				$gambar = $upload_data['file_name'];
			} else {
				$gambar = null;
				// Handle error jika unggah gambar gagal
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			$data = array(
				'id' => $this->input->post('id'),
				'nama' => $this->input->post('nama'),
				'lokasi' => $this->input->post('lokasi'),
				'lat' => $this->input->post('lat'),
				'lng' => $this->input->post('lng'),
				'keterangan' => $this->input->post('keterangan'),
				'gambar' => $gambar // Simpan nama file gambar ke database
			);

			if($_POST['parameter']=="tambah"){
				$exec=$this->Model->insert($data);
			}
			else{
				$this->Model->update($data,['id'=>$this->input->post('id')]);	
			}  
		}
		redirect('tabel');
	}

	public function hapus($id=''){
		$this->db->where('id',$id);
		$get=$this->Model->get()->row();
		$this->Model->delete(["id"=>$id]);
		redirect('tabel');
	}

}
