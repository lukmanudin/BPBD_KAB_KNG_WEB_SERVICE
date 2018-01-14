<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

	public $URL_INPUT_FORM = "input";
	public $URL_EDIT_FORM = "edit";

	function __construct(){
		parent::__construct();
		$this->load->model('mod_infobencana');
		$this->load->model('mod_peringatandini');
		$this->load->model('mod_laporanmasyarakat');
		$this->load->model('mod_peta');
		
	}

	public function index(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "Dashboard";
			$cfg["page_icon"] = "glyphicon glyphicon-th-large";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			$this->load->view('apps/body_dashboard',$cfg);
			$this->load->view('apps/footer');
		}else{
			header('location:'. site_url().'/apps/login/');
		}
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
			$cfg["page_icon"] = "glyphicon glyphicon-th-large";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			$this->load->view('apps/body_dashboard',$cfg);
			$this->load->view('apps/footer');
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function peringatan_dini(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "Peringatan Dini";
			$cfg["page_icon"] = "glyphicon glyphicon-exclamation-sign";
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
			$cfg["page_icon"] = "glyphicon glyphicon-fire";
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
			$cfg["page_icon"] = "glyphicon glyphicon-bullhorn";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			if($this->uri->segment(3) != null){
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-arrow-left";
				$cfg["btn_text"] = "Kembali";
				$cfg['ref_bencana'] = $this->mod_infobencana->ref_bencana();
				$cfg['ref_st'] = $this->mod_laporanmasyarakat->ref_st();
				// echo json_encode($cfg['ref_st']);
				// die();
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

	public function peta(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "Peta";
			$cfg["page_icon"] = "glyphicon glyphicon-map-marker";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			if($this->uri->segment(3) != null){
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-arrow-left";
				$cfg["btn_text"] = "Kembali";
				$cfg['ref_peta'] = $this->mod_peta->ref_peta();
				if($this->uri->segment(3) == $this->URL_INPUT_FORM){
					$this->load->view('apps/body_peta_input',$cfg);
				}else
				if($this->uri->segment(3) == $this->URL_EDIT_FORM){
					$this->load->view('apps/body_peta_edit',$cfg);
				}
			}else{
				$cfg["judul_section_tabel"] = "Tabel Daftar Peta";
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->URL_INPUT_FORM."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-plus-sign";
				$cfg["btn_text"] = "Upload Peta";
				$this->load->view('apps/body_peta',$cfg);
			}
			$this->load->view('apps/footer');
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function user(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "User";
			$cfg["page_icon"] = "glyphicon glyphicon-user";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			if($this->uri->segment(3) != null){
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-user";
				$cfg["btn_text"] = "Kembali";
				if($this->uri->segment(3) == $this->URL_INPUT_FORM){
					$this->load->view('apps/body_user_input',$cfg);
				}else
				if($this->uri->segment(3) == $this->URL_EDIT_FORM){
					$this->load->view('apps/body_user_edit',$cfg);
				}
			}else{
				$cfg["judul_section_tabel"] = "Tabel Daftar User";
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->URL_INPUT_FORM."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-plus-sign";
				$cfg["btn_text"] = "Tambah User";
				$this->load->view('apps/body_user',$cfg);
			}
			$this->load->view('apps/footer');
		}else{
			header('location:'. site_url().'/apps/login/');
		}
	}

	public function chat(){
		if($this->session->userdata("session_appssystem_code")){
			$cfg["judul_halaman"] = "Forum Diskusi";
			$cfg["page_icon"] = "glyphicon glyphicon-comment";
			$this->load->view('apps/header');
			$this->load->view('apps/nav');
			if($this->uri->segment(3) != null){
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-chat";
				$cfg["btn_text"] = "Kembali";
				if($this->uri->segment(3) == $this->URL_INPUT_FORM){
					$this->load->view('apps/body_chat_input',$cfg);
				}else
				if($this->uri->segment(3) == $this->URL_EDIT_FORM){
					$this->load->view('apps/body_chat_edit',$cfg);
				}
			}else{
				$cfg["judul_section_tabel"] = "Tabel Daftar Diskusi";
				$cfg["url"] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->URL_INPUT_FORM."/";
				$cfg["btn_icon"] = "glyphicon glyphicon-plus-sign";
				$cfg["btn_text"] = "Tambah Topik";
				$this->load->view('apps/body_chat',$cfg);
			}
			$this->load->view('apps/footer');
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

	//
	function landing_page(){
		$this->load->view('landing_page/landing_page');
	}
	//

	function mobile_peringatan_dini_detail(){
		if($this->uri->segment(3) != null){
			$data["page_content"] = $this->mod_peringatandini->mobile_peringatan_dini_detail($this->uri->segment(3));
			$this->load->view('mobile/peringatan_dini_detail',$data);
		}
	}

	function mobile_info_bencana_detail(){
		if($this->uri->segment(3) != null){
			$data["page_content"] = $this->mod_infobencana->mobile_info_bencana_detail($this->uri->segment(3));
			$this->load->view('mobile/info_bencana_detail',$data);
		}
	}

	function mobile_laporan_masyarakat_detail(){
		if($this->uri->segment(3) != null){
			$data["page_content"] = $this->mod_laporanmasyarakat->mobile_laporan_masyarakat_detail($this->uri->segment(3));
			$this->load->view('mobile/laporan_masyarakat_detail',$data);
		}
	}

	function mobile_peta_list(){
		$this->load->view('mobile/peta_list');
	}

	function mobile_peta_detail(){
		if($this->uri->segment(3) != null){
			$data["page_content"] = $this->mod_peta->mobile_peta_detail($this->uri->segment(3));
			// echo json_encode($data[""]);
			$this->load->view('mobile/peta_detail',$data);
		}
	}

	//-------------------
	function mobile_chat_input(){
		$this->load->view('mobile/chat_input');	
	}

	function mobile_chat_list(){
		$this->load->view('mobile/chat_list');	
	}

	function mobile_chat_detail(){
		$this->load->view('mobile/chat_detail');	
	}

}
