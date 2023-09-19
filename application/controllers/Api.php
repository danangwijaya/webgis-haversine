<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
	    $this->load->model('DestinasiModel');
	}

	public function data($jenis='destinasi',$type='point',$id='')
	{
		header('Content-Type: application/json');
		$response=[];
		if($jenis=='destinasi'){
			if($type=='point'){
				if($id!=''){
					$this->db->where('id',$id);
				}
				$getDestinasi=$this->DestinasiModel->get();
				foreach ($getDestinasi->result() as $row) {
					$data=null;
					// $data['type']="Feature";
					$data[]=[
												"name"=>$row->nama,
												"lokasi"=>$row->lokasi,
												"lat"=>$row->lat,
												"lng"=>$row->lng,
												"keterangan"=>$row->keterangan,
												"popUp"=>"Nama : ".$row->nama."<br>Lokasi : ".$row->lokasi
												];
					// $data['geometry']=[
					// 							"type" => "Point",
					// 							"coordinates" => [$row->lng,$row->lat ] 
					// 							];	

					$response[]=$data;
				}
				echo "var dataDestinasi=".json_encode($response,JSON_PRETTY_PRINT);	
			}
		}
		elseif($jenis=='pointDestinasi'){
			if($type=='point'){
				if($id!=''){
					$this->db->where('id',$id);
				}
				$getPointDest=$this->DestinasiModel->get();
				foreach ($getPointDest->result() as $row) {
					$data=null;
					$data['type']="Feature";
					$data['properties']=[
												"name"=>$row->nama,
												"lokasi"=>$row->lokasi,
												"keterangan"=>$row->keterangan,
												"gambar"=>$row->gambar,
												];
					$data['geometry']=[
												"type" => "Point",
												"coordinates" => [$row->lng,$row->lat ] 
												];	

					$response[]=$data;
				}
				echo json_encode($response,JSON_PRETTY_PRINT);	
			}
		
	}
}
}