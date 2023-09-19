<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('DestinasiModel');
	}
	public function index()
	{

		$datacontent['title']='Peta';
		$data['content']=$this->load->view('peta/petaView',$datacontent,TRUE);
		$data['title']='WebGIS';
		$this->load->view('peta/layouts/html',$data);
	}
}
