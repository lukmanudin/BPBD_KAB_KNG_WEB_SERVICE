<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mod_peringatandini');
		$this->load->model('mod_test');
		$this->load->model('mod_infobencana');
		header('Content-type: json');
	}

	function peringatan_dini(){
		$response = $this->mod_peringatandini->peringatan_dini();
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function peringatan_dini_input(){
		if($this->input->post()!=null){
			$tanggal_publish = "0000-00-00 00:00:00";
			if (empty($_FILES['lampiran']['name'])==true) {
				$nama_lampiran = "default.png";
			}else{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '2048';
				$config['overwrite'] = 'true';
				$config['encrypt_name'] = 'true';  
				$config['remove_spaces'] = 'true';  
				$config['file_name'] = date("YmdHis");  
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('lampiran')){ 
					echo $this->upload->display_errors();
				}else{ 
					$detail = $this->upload->data();
					$nama_lampiran = $detail["orig_name"];
				}
			}
			if($this->input->post('status') == "Publish"){
				$tanggal_publish = date("Y-m-d H:i:s");
			}else
			if($this->input->post('status') == "Draft"){
				$tanggal_publish = "0000-00-00 00:00:00";
			}
			$data_peringatan_dini = array(
				"judul"=> $this->input->post('judul'),
				"isi" => $this->input->post('isi'),
				"status" => $this->input->post('status'),
				"tanggal_buat" => date("Y-m-d H:i:s"),
				"tanggal_publish" => $tanggal_publish,
				"lampiran"=> $nama_lampiran
			);
			$result = $this->mod_peringatandini->peringatan_dini_input($data_peringatan_dini);
			if($result == 1){
				$response = array(
					"code" => "SUCCESS",
					"message" => "Simpan data berhasil",
					"severity" => "success"
				);
			}else{
				$response = array(
					"code" => "ERROR",
					"message" => "Simpan data gagal",
					"severity" => "warning"
				);
			}
		}else{
			$response = array(
				"code" => "ERROR",
				"message" => "Tidak ada data dikirim ke server",
				"severity" => "danger"
			);
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function peringatan_dini_edit(){
		if($this->uri->segment(3) != null){
			$response = $this->mod_peringatandini->peringatan_dini_edit($this->uri->segment(3));
		}else{
			$response = array();
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function peringatan_dini_update(){
		if($this->input->post()!=null){
			$tanggal_publish = "0000-00-00 00:00:00";
			if (empty($_FILES['lampiran']['name'])==true) {
				$nama_lampiran = null;
			}else{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '2048';
				$config['overwrite'] = 'true';
				$config['encrypt_name'] = 'true';  
				$config['remove_spaces'] = 'true';  
				$config['file_name'] = date("YmdHis");  
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('lampiran')){ 
					echo $this->upload->display_errors();
				}else{ 
					$detail = $this->upload->data();
					$nama_lampiran = $detail["orig_name"];
				}
			}
			if($this->input->post('status') == "Publish"){
				$tanggal_publish = date("Y-m-d H:i:s");
			}else
			if($this->input->post('status') == "Draft"){
				$tanggal_publish = "0000-00-00 00:00:00";
			}
			if($nama_lampiran == null){
				$data_peringatan_dini = array(
					"judul"=> $this->input->post('judul'),
					"isi" => $this->input->post('isi'),
					"status" => $this->input->post('status'),
					"tanggal_publish" => $tanggal_publish
				);
			}else{
				$data_peringatan_dini = array(
					"judul"=> $this->input->post('judul'),
					"isi" => $this->input->post('isi'),
					"status" => $this->input->post('status'),
					"tanggal_publish" => $tanggal_publish,
					"lampiran"=> $nama_lampiran
				);
			}
			
			$result = $this->mod_peringatandini->peringatan_dini_update($this->input->post('id'),$data_peringatan_dini);
			if($result == 1){
				$response = array(
					"code" => "SUCCESS",
					"message" => "Simpan data berhasil",
					"severity" => "success"
				);
			}else{
				$response = array(
					"code" => "ERROR",
					"message" => "Simpan data gagal",
					"severity" => "warning"
				);
			}
		}else{
			$response = array(
				"code" => "ERROR",
				"message" => "Tidak ada data dikirim ke server",
				"severity" => "danger"
			);
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function peringatan_dini_delete(){
		if($this->uri->segment(3) != null){
			$result = $this->mod_peringatandini->peringatan_dini_delete($this->uri->segment(3));
			if($result > 0){
				if($result == 1){
					$response = array(
						"code" => "SUCCESS",
						"message" => "hapus data berhasil",
						"severity" => "success"
					);
				}else{
					$response = array(
						"code" => "ERROR",
						"message" => "hapus data gagal",
						"severity" => "warning"
					);
				}
			}
		}else{
			$response = array(
				"code" => "ERROR",
				"message" => "Tidak parameter delete data",
				"severity" => "danger"
			);
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	//-----INFO BENCANA----------

	function info_bencana(){
		$response = $this->mod_infobencana->info_bencana();
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function info_bencana_input(){
		if($this->input->post()!=null){
			$tanggal_publish = "0000-00-00 00:00:00";
			if (empty($_FILES['lampiran']['name'])==true) {
				$nama_lampiran = "default.png";
			}else{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '2048';
				$config['overwrite'] = 'true';
				$config['encrypt_name'] = 'true';  
				$config['remove_spaces'] = 'true';  
				$config['file_name'] = date("YmdHis");  
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('lampiran')){ 
					echo $this->upload->display_errors();
				}else{ 
					$detail = $this->upload->data();
					$nama_lampiran = $detail["orig_name"];
				}
			}
			if($this->input->post('status') == "Publish"){
				$tanggal_publish = date("Y-m-d H:i:s");
			}else
			if($this->input->post('status') == "Draft"){
				$tanggal_publish = "0000-00-00 00:00:00";
			}
			$data_info_bencana = array(
				"judul"=> $this->input->post('judul'),
				"kategori" => $this->input->post('kategori'),
				"kampung" => $this->input->post('kampung'),
				"kelurahan" => $this->input->post('kelurahan'),
				"kecamatan" => $this->input->post('kecamatan'),
				"kabupaten" => $this->input->post('kabupaten'),
				"dampak" => $this->input->post('dampak'),
				"kerugian_material" => $this->input->post('kerugian_material'),
				"korban_jiwa" => $this->input->post('korban_jiwa'),
				"kronologis" => $this->input->post('kronologis'),
				"penanganan" => $this->input->post('penanganan'),
				"kebutuhan_darurat" => $this->input->post('kebutuhan_darurat'),
				"lampiran"=> $nama_lampiran,
				"status" => $this->input->post('status'),
				"tanggal_buat" => date("Y-m-d H:i:s"),
				"tanggal_publish" => $tanggal_publish
			);
			$result = $this->mod_infobencana->info_bencana_input($data_info_bencana);
			if($result == 1){
				$response = array(
					"code" => "SUCCESS",
					"message" => "Simpan data berhasil",
					"severity" => "success"
				);
			}else{
				$response = array(
					"code" => "ERROR",
					"message" => "Simpan data gagal",
					"severity" => "warning"
				);
			}
		}else{
			$response = array(
				"code" => "ERROR",
				"message" => "Tidak ada data dikirim ke server",
				"severity" => "danger"
			);
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function info_bencana_edit(){
		if($this->uri->segment(3) != null){
			$response = $this->mod_infobencana->info_bencana_edit($this->uri->segment(3));
		}else{
			$response = array();
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function info_bencana_update(){
		if($this->input->post()!=null){
			$tanggal_publish = "0000-00-00 00:00:00";
			if (empty($_FILES['lampiran']['name'])==true) {
				$nama_lampiran = null;
			}else{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '2048';
				$config['overwrite'] = 'true';
				$config['encrypt_name'] = 'true';  
				$config['remove_spaces'] = 'true';  
				$config['file_name'] = date("YmdHis");  
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('lampiran')){ 
					echo $this->upload->display_errors();
				}else{ 
					$detail = $this->upload->data();
					$nama_lampiran = $detail["orig_name"];
				}
			}
			if($this->input->post('status') == "Publish"){
				$tanggal_publish = date("Y-m-d H:i:s");
			}else
			if($this->input->post('status') == "Draft"){
				$tanggal_publish = "0000-00-00 00:00:00";
			}
			if($nama_lampiran == null){
				$data_info_bencana = array(
					"judul"=> $this->input->post('judul'),
					"kategori" => $this->input->post('kategori'),
					"kampung" => $this->input->post('kampung'),
					"kelurahan" => $this->input->post('kelurahan'),
					"kecamatan" => $this->input->post('kecamatan'),
					"kabupaten" => $this->input->post('kabupaten'),
					"dampak" => $this->input->post('dampak'),
					"kerugian_material" => $this->input->post('kerugian_material'),
					"korban_jiwa" => $this->input->post('korban_jiwa'),
					"kronologis" => $this->input->post('kronologis'),
					"penanganan" => $this->input->post('penanganan'),
					"kebutuhan_darurat" => $this->input->post('kebutuhan_darurat'),
					"status" => $this->input->post('status'),
					"tanggal_buat" => date("Y-m-d H:i:s"),
					"tanggal_publish" => $tanggal_publish
				);
			}else{
				$data_info_bencana = array(
					"judul"=> $this->input->post('judul'),
					"kategori" => $this->input->post('kategori'),
					"kampung" => $this->input->post('kampung'),
					"kelurahan" => $this->input->post('kelurahan'),
					"kecamatan" => $this->input->post('kecamatan'),
					"kabupaten" => $this->input->post('kabupaten'),
					"dampak" => $this->input->post('dampak'),
					"kerugian_material" => $this->input->post('kerugian_material'),
					"korban_jiwa" => $this->input->post('korban_jiwa'),
					"kronologis" => $this->input->post('kronologis'),
					"penanganan" => $this->input->post('penanganan'),
					"kebutuhan_darurat" => $this->input->post('kebutuhan_darurat'),
					"lampiran"=> $nama_lampiran,
					"status" => $this->input->post('status'),
					"tanggal_buat" => date("Y-m-d H:i:s"),
					"tanggal_publish" => $tanggal_publish
				);
			}
			
			$result = $this->mod_infobencana->info_bencana_update($this->input->post('id'),$data_info_bencana);
			if($result == 1){
				$response = array(
					"code" => "SUCCESS",
					"message" => "Simpan data berhasil",
					"severity" => "success"
				);
			}else{
				$response = array(
					"code" => "ERROR",
					"message" => "Simpan data gagal",
					"severity" => "warning"
				);
			}
		}else{
			$response = array(
				"code" => "ERROR",
				"message" => "Tidak ada data dikirim ke server",
				"severity" => "danger"
			);
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function info_bencana_delete(){
		if($this->uri->segment(3) != null){
			$result = $this->mod_infobencana->info_bencana_delete($this->uri->segment(3));
			if($result > 0){
				if($result == 1){
					$response = array(
						"code" => "SUCCESS",
						"message" => "hapus data berhasil",
						"severity" => "success"
					);
				}else{
					$response = array(
						"code" => "ERROR",
						"message" => "hapus data gagal",
						"severity" => "warning"
					);
				}
			}
		}else{
			$response = array(
				"code" => "ERROR",
				"message" => "Tidak parameter delete data",
				"severity" => "danger"
			);
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}
	
}
