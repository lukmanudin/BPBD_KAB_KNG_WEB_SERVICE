<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

	public $URL_INPUT_FORM = "input";
	public $URL_EDIT_FORM = "edit";

	function __construct(){
		parent::__construct();
		$this->load->model('mod_infobencana');
	}

	public function index(){
		$cfg["judul_halaman"] = "Dashboard";
		$this->load->view('apps/header');
		$this->load->view('apps/body_template');
		$this->load->view('apps/footer');
	}

	public function login(){
		if($this->session->userdata("session_appssystem_code")){
			header('location:'. site_url().'/apps/dashboard/');
        }else{
			$this->load->view('apps/header');
			$this->load->view('apps/nav_login');
			$this->load->view('apps/body_login');
			$this->load->view('apps/footer');
			echo $this->session->userdata("session_appssystem_code");
        }
	}

	public function dashboard(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "Dashboard";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			$this->load->view('apps/body_template');
			$this->load->view('apps/footer');
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function peringatan_dini(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "Peringatan Dini";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			if($this->uri->segment(3) != null){
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-arrow-left";
				$cfg["btn_text"] = "Kembali";
				if($this->uri->segment(3) == $this->URL_INPUT_FORM){
					$this->load->view('apps/body_peringatan_dini_input',$cfg);
				}else
				if($this->uri->segment(3) == $this->URL_EDIT_FORM){
					$this->load->view('apps/body_peringatan_dini_edit',$cfg);
				}
			}else{
				$cfg["judul_section_tabel"] = "Tabel Peringatan Dini";
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->URL_INPUT_FORM."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-plus-sign";
				$cfg["btn_text"] = "Input";
				$this->load->view('apps/body_peringatan_dini',$cfg);
			}
			$this->load->view('apps/footer');
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function info_bencana(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "Info Bencana";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			if($this->uri->segment(3) != null){
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-arrow-left";
				$cfg["btn_text"] = "Kembali";
				$cfg['ref_bencana'] = $this->mod_infobencana->ref_bencana();
				if($this->uri->segment(3) == $this->URL_INPUT_FORM){
					$this->load->view('apps/body_info_bencana_input',$cfg);
				}else
				if($this->uri->segment(3) == $this->URL_EDIT_FORM){
					$this->load->view('apps/body_info_bencana_edit',$cfg);
				}
			}else{
				$cfg["judul_section_tabel"] = "Tabel Peringatan Dini";
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->URL_INPUT_FORM."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-plus-sign";
				$cfg["btn_text"] = "Input";
				$this->load->view('apps/body_info_bencana',$cfg);
			}
			$this->load->view('apps/footer');
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function laporan_masyarakat(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "Laporan Masyarakat";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			if($this->uri->segment(3) != null){
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-arrow-left";
				$cfg["btn_text"] = "Kembali";
				$cfg['ref_bencana'] = $this->mod_infobencana->ref_bencana();
				if($this->uri->segment(3) == $this->URL_INPUT_FORM){
					$this->load->view('apps/body_laporan_masyarakat_input',$cfg);
				}else
				if($this->uri->segment(3) == $this->URL_EDIT_FORM){
					$this->load->view('apps/body_laporan_masyarakat_edit',$cfg);
				}
			}else{
				$cfg["judul_section_tabel"] = "Tabel Laporan Masyarakat";
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->URL_INPUT_FORM."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-plus-sign";
				$cfg["btn_text"] = "Input";
				$this->load->view('apps/body_laporan_masyarakat',$cfg);
			}
			$this->load->view('apps/footer');
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function user(){
		if($this->session->userdata("session_appssystem_code")){
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function chat_group(){
		if($this->session->userdata("session_appssystem_code")){
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function logout(){
        if($this->session->userdata("session_appssystem_code")){
            $this->session->sess_destroy();
            $return = array(
                "code" => null,
                "message" => "Anda baru saja logout.",
                "message" => "success",
                "data_user" => null
            );
        }else{
            $return = array(
                "code" => null,
                "message" => "Silahkan login",
                "message" => "info",
                "data_user" => null
            );
        }
		header('location:'. site_url().'/apps/login/');
	}
}
