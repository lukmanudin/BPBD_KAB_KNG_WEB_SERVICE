<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('mod_laporanmasyarakat');
		$this->load->model('mod_peringatandini');
		$this->load->model('mod_infobencana');
		$this->load->model('mod_user');
		$this->load->model('mod_peta');
		$this->load->model('mod_chat');
		header('Content-type: json');
	}

	//--- LOGIN - - -
	function verifikasi(){
        if($this->input->post()!=null){
            $data = array(
            "username" => $this->input->post('username'),
            "password" => md5($this->input->post('password')));
            $resultcek = $this->get_user_by_username($data);
            if($resultcek==null){
                $return = array(
                    "code" => "NOT FOUND",
                    "message" => "Username tidak terdaftar",
                    "severity" => "danger",
                    "data_user" => null
                );
            }else{
                $return = $this->matching($data,$resultcek);
            } 
        }else{
            $return = array(
                "code" => "NO DATA POSTED",
                "message" => "Tidak ada data dikirim ke server",
                "severity"  => "danger",
                "data_user" => null
            );
        }
		echo json_encode(array("response"=>$return));
    }
    
    function get_user_by_username($data){
        return $this->mod_user->get_user_by_username($data);
    }
    
    function matching($data,$resultcek){
        if($data["username"] == $resultcek[0]->username && $data["password"] == $resultcek[0]->password){
            if($resultcek[0]->status == 2){
                $code = "NOT MATCH";
                $message = "User Anda diblokir! Anda tidak dapat login";
                $severity = "danger";
                //$this->buat_session($resultcek);
            }else
            if($resultcek[0]->status == 0){
                $code = "NOT MATCH";
                $message = "Username Anda belum aktif, silahkan lakukan aktivasi.";
                $severity = "warning";
			}else
            if($resultcek[0]->status == 1){
                $code = "MATCH";
                $message = "Username dan password sesuai";
                $severity = "success";
                $this->buat_session($resultcek);
            }
        }else{
            $code = "NOT MATCH";
            $message = "Username dan password tidak sesuai";
            $severity = "warning";
        }
        $return = array(
            "code" => $code,
            "message" => $message,
            "severity" => $severity,
            "data_user" => $resultcek
        );
        return $return;
    }

    function buat_session($resultcek){
        $waktu = date("Y-m-d H:i:s");
		$this->update_login_timestamp($resultcek[0]->id,array("last_login" => $waktu));
        $data_session = array(
            "session_appssystem_code"=>"SeCuRe".date("YmdHis")."#".date("YHmids"),
            "session_appssystem_id"=>$resultcek[0]->id,
            "session_appssystem_tipe"=>$resultcek[0]->tipe,
            "session_appssystem_username"=>$resultcek[0]->username,
            "session_appssystem_nama"=>$resultcek[0]->nama,
            "session_appssystem_email"=>$resultcek[0]->email,
            "session_appssystem_last_login"=>$waktu
		);
        $this->session->set_userdata($data_session);
    }
    
    function update_login_timestamp($id,$data){
        $this->mod_user->update_login_timestamp($id,$data);
	}
	
	//----- DAFTAR PENGGUNA - - -
	function verifikasi_daftar(){
        if($this->input->post()!=null){
            $tipe = $this->input->post('tipe');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $alamat = $this->input->post('alamat');
            $status = $this->input->post('status');;
            $data = array(
				"tipe" => $tipe,
                "username" => $username,
                "password" => $password,
                "nama" => $nama,
				"alamat" => $alamat,
				"email" => $email);
            $resultcek = $this->mod_user->verifikasi_daftar($data);
            if($resultcek==null){    
                $data = array(
					"tipe" => $tipe,
                    "username" => $username,
                    "password" => md5($password),
					"nama" => $nama,
					"email" => $email,
					"alamat" => $alamat,
					"status" => $status,
                    "register_datetime" => date("Y-m-d H:i:s"),
                    "last_login" => date("Y-m-d H:i:s"));
                $resultcek = $this->mod_user->daftar($data);
                if($resultcek > 0){
                    $return = array(
                        "code" => "SUCCESS",
                        "message" => "Pendaftaran berhasil,\nperiksa inbox atau SPAM email Anda untuk verifikasi pendaftaran",
                        "severity" => "success");    
                }else{
                    $return = array(
                        "code" => "FAILED",
                        "message" => "Pendaftaran gagal. Silahkan coba lagi.",
                        "severity" => "warning");  
                }
            }else{
                 $return = array(
                    "code" => "FOUND",
                    "message" => "Userneme atau email sudah digunakan, gunakan yang lainnya!",
                    "severity" => "danger"
                );
            } 
        }else{
            $return = array(
                "code" => "NO DATA POSTED",
                "message" => "Tidak ada data dikirim ke server!",
                "severity" => "danger"
            );
        }
        echo json_encode(array("response"=>$return),JSON_PRETTY_PRINT);
    }

	// ----- PRINGATAN DINI -----

	function peringatan_dini_published(){
		$response = $this->mod_peringatandini->peringatan_dini_published();
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
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

	function info_bencana_published(){
		$response = $this->mod_infobencana->info_bencana_published();
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	} 

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
				"tanggal_kejadian" => $this->input->post('tanggal_kejadian'),
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
					"tanggal_kejadian" => $this->input->post('tanggal_kejadian'),
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
					"tanggal_kejadian" => $this->input->post('tanggal_kejadian'),
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

	//--- LAPORAN MASYARAKAT - - -
	function laporan_masyarakat(){
		$response = $this->mod_laporanmasyarakat->laporan_masyarakat();
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function laporan_masyarakat_input(){
		if($this->input->post()!=null){
			if (empty($_FILES['lampiran']['name'])==true) {
				$nama_lampiran = "default.png";
			}else{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '10240';
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
			
			$data_peta = array(
				"pengirim"=> $this->input->post('pengirim'),
				"tanggal_kejadian"=> $this->input->post('tanggal_kejadian'),
				"judul"=> $this->input->post('judul'),
				"kategori" => $this->input->post('kategori'),
				"kampung" => $this->input->post('kampung'),
				"kelurahan" => $this->input->post('kelurahan'),
				"kecamatan" => $this->input->post('kecamatan'),
				"kabupaten" => $this->input->post('kabupaten'),
				"kronologis" => $this->input->post('kronologis'),
				"lampiran"=> $nama_lampiran,
				"status" => $this->input->post('status'),
				"tanggal_buat" => date("Y-m-d H:i:s")
			);
			$result = $this->mod_laporanmasyarakat->laporan_masyarakat_input($data_peta);
			// echo json_encode($data_peta);die();
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

	function laporan_masyarakat_delete(){
		if($this->uri->segment(3) != null){
			$result = $this->mod_laporanmasyarakat->laporan_masyarakat_delete($this->uri->segment(3));
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

	function laporan_masyarakat_by_pengirim(){
		if($this->uri->segment(3) != null){
			$response = $this->mod_laporanmasyarakat->laporan_masyarakat_by_pengirim($this->uri->segment(3));
		}else{
			$response = array();
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	//----- PETA
	function peta(){
		$response = $this->mod_peta->peta();
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function peta_input(){
		if($this->input->post()!=null){
			if (empty($_FILES['lampiran']['name'])==true) {
				$nama_lampiran = "";
			}else{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'kml';
				$config['max_size']	= '10240';
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
			
			$data_peta = array(
				"jenis" => $this->input->post('jenis'),
				"judul"=> $this->input->post('judul'),
				"deskripsi" => $this->input->post('deskripsi'),
				"lampiran"=> $nama_lampiran,
				"status" => $this->input->post('status'),
				"tanggal_upload" => date("Y-m-d H:i:s")
			);
			$result = $this->mod_peta->peta_input($data_peta);
			// echo json_encode($data_peta);die();
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

	function peta_edit(){
		if($this->uri->segment(3) != null){
			$response = $this->mod_peta->peta_edit($this->uri->segment(3));
		}else{
			$response = array();
		}
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function peta_update(){
		if($this->input->post()!=null){
			$tanggal_publish = "0000-00-00 00:00:00";
			if (empty($_FILES['lampiran']['name'])==true) {
				$nama_lampiran = "";
			}else{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'kml';
				$config['max_size']	= '10240';
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
				$data_peta = array(
					"jenis" => $this->input->post('jenis'),
					"judul"=> $this->input->post('judul'),
					"deskripsi" => $this->input->post('deskripsi'),
					"status" => $this->input->post('status'),
					"tanggal_upload" => date("Y-m-d H:i:s")
				);
			}else{
				$data_peta = array(
					"jenis" => $this->input->post('jenis'),
					"judul"=> $this->input->post('judul'),
					"deskripsi" => $this->input->post('deskripsi'),
					"lampiran"=> $nama_lampiran,
					"status" => $this->input->post('status'),
					"tanggal_upload" => date("Y-m-d H:i:s")
				);
			}
			
			$result = $this->mod_peta->peta_update($this->input->post('id'),$data_peta);
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


	function peta_delete(){
		if($this->uri->segment(3) != null){
			$result = $this->mod_peta->peta_delete($this->uri->segment(3));
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

	//------- CHAT / DISKUSI
	function chat(){
		$response = $this->mod_chat->chat();
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function chat_detail(){
		$response = $this->mod_chat->chat_detail($this->uri->segment(4));
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

	function chat_input(){
		if($this->input->post()!=null){
			$data_chat = array(
				"pengirim" => $this->uri->segment(3),
				"judul"=> $this->input->post('judul'),
				"isi" => $this->input->post('isi'),
				"tanggal_buat" => date("Y-m-d H:i:s")
			);
			$result = $this->mod_chat->chat_input($data_chat);
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

	function chat_delete(){
		if($this->uri->segment(3) != null){
			$result = $this->mod_chat->chat_delete($this->uri->segment(3));
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

	//---- LANDING PAGE WEB
	function landing_page_web(){
		$response = array(
			"last_peringatan_dini" => $this->mod_peringatandini->last_peringatan_dini(),
			"last_info_bencana" => $this->mod_infobencana->last_info_bencana(),
			"last_laporan_bencana" => $this->mod_laporanmasyarakat->last_laporan_masyarakat()
		);
		echo json_encode(array("response" => $response),JSON_PRETTY_PRINT);
	}

}
