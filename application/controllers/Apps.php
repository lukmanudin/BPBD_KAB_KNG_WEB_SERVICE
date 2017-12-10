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

	public function peringatan_dini(){
		$cfg["judul_halaman"] = "Peringatan Dini";
		$this->load->view('apps/header');
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
	}

	public function info_bencana(){
		$cfg["judul_halaman"] = "Info Bencana";
		$this->load->view('apps/header');
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
	}

	public function laporan_masyarakat(){

	}

	public function user(){

	}

	public function chat_group(){

	}
}
