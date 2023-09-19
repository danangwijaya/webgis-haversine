<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel','Model');
		if($this->session->logged!==true){
			redirect('auth');
		  }
		if($this->session->level!=='Admin'){
			redirect('user');
		  }
	}

	public function index()
	{
		$datacontent['url']='user';
		$datacontent['title']='Tabel Pengguna';
		$datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('user/userView',$datacontent,TRUE);
		$data['title']='WebGIS';
		$this->load->view('layouts/html',$data);
	}

	public function form($parameter='',$id='')
	{
		$datacontent['url']='user';
		$datacontent['parameter']=$parameter;
		$datacontent['id_pengguna']=$id;
		$datacontent['title']='Tabel Pengguna';
		$data['content']=$this->load->view('user/formUserView',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('layouts/html',$data);
	}
	
	public function simpan(){
    if ($this->input->post('simpan')) {
        $data = array(
            'id_pengguna' => $this->input->post('id_pengguna'),
            'nm_user' => $this->input->post('nm_user'),
            'pwd' => password_hash($this->input->post('pwd'), PASSWORD_BCRYPT), // Hash password
            'level' => $this->input->post('level'),
        );

        if ($_POST['parameter'] == "tambah") {
            $exec = $this->Model->insert($data);
        } else {
            $this->Model->update($data, array('id_pengguna' => $this->input->post('id_pengguna')));
        }
    }

    redirect('user');
}

	public function hapus($id=''){
		$this->db->where('id_pengguna',$id);
		$get=$this->Model->get()->row();
		$this->Model->delete(["id_pengguna"=>$id]);
		redirect('user');
	}

}
