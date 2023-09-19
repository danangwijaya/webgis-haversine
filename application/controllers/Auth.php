<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$datacontent['title']='Form Login';
		$this->load->view('auth/authView',$datacontent);
	}
	public function check(){
		if($this->input->post()){
			$nm_user=$this->input->post('nm_user');
		    $pwd=$this->input->post('pwd');
		    $this->db->where("nm_user",$nm_user);
		    $data=$this->db->get("pengguna");
		    if($data->num_rows()>0){
		      // jika username ada
		      $row=$data->row();
		      $hash = $row->pwd;
		      if (password_verify($pwd, $hash)) {
		          $this->session->set_userdata("logged",true);
		          $this->session->set_userdata("nm_user",$row->nm_user);
		          $this->session->set_userdata("id_pengguna",$row->id_pengguna);
		          $this->session->set_userdata("level",$row->level);
		          $this->session->set_flashdata("info",'<div class="alert alert-success alert-dismissible">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                    <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Selamat Datang <b>'.$row->nm_user.'</b> di Dashboard Aplikasi
		                  </div>');
		          redirect("tabel");
		      } else {
		         $this->session->set_userdata("logged",false);
		         $this->session->set_flashdata("info",'<div class="alert alert-danger alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-ban"></i> Error!</h4> Nama Pengguna atau Kata Sandi Salah
		              </div>');
		        redirect("auth");
		      }
		    }
		    else{
		      $this->session->set_userdata("logged",false);
	    	  $this->session->set_flashdata('info','<div class="alert alert-danger alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-ban"></i> Error!</h4> Nama Pengguna atau Kata Sandi Salah
		              </div>');
		      redirect("auth");
		    }
		}
		else{
			redirect("auth");
		}
	}
	public function out(){
		$this->session->sess_destroy();
		redirect("auth");
	}
}
