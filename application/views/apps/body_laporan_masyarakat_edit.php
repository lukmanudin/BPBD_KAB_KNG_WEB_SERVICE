
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header">
            <span class="<?php echo $page_icon; ?>"></span> <?php echo $judul_halaman; ?>
            <a href="<?php echo $url; ?>" class="btn btn-primary btn-sm pull-right">
              <span class="<?php echo $btn_icon; ?>"><span> <?php echo $btn_text; ?> </span></class>
            </a>
          </h3>
          <div class="col-lg-12" id="notifikasi_bar">  
          </div>
          <form id="my_form" role="form" method="post" enctype="multipart/form-data">
            <div class="row">
              <input type="hidden" id="id" name="id" value="<?php echo $this->session->userdata("session_appssystem_id"); ?>">
              <input type="hidden" id="pengirim" name="pengirim" value="<?php echo $this->session->userdata("session_appssystem_id"); ?>">
              <input type="hidden" id="status" name="status" value="Waiting Response">
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Judul Laporan</label>
                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul peringatan dini" disabled>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Tanggal Kejadian</label>
                  <input type="datetime" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian" placeholder="Tanggal Kejadian"  disabled>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Kategori bencana</label>
                  <select class="form-control" id="kategori" name="kategori"  disabled>
                    <?php
                      foreach($ref_bencana as $ref){
                        echo '<option value="'.$ref->id.'">'.$ref->nama_bencana.'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Lokasi (RT/RW/Dusun/Kampung)</label>
                  <input type="text" class="form-control" id="kampung" name="kampung" placeholder="Lokasi Bencana"  disabled>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Kelurahan</label>
                  <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan" disabled>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan" disabled>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Kabupaten</label>
                  <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Kabupaten" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Kronologis peristiwa dan informasi terkini</label>
                  <textarea class="form-control" id="kronologis" name="kronologis" placeholder="Kronologis peristiwa"  disabled></textarea>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Status Laporan</label>
                  <select class="form-control" id="status" name="status">
                    <?php
                      foreach($ref_st as $ref_stat){
                        echo '<option value="'.$ref_stat->id.'">'.$ref_stat->status.'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <span class="pull-right">
              <button type="submit" id="btn_simpan" value="simpan" class="btn btn-success">Simpan</button>
            </span>
          </form>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $.ajax({
          url: "<?php echo site_url(); ?>/api/laporan_masyarakat_edit/<?php echo $this->uri->segment(4); ?>/",
          type: 'GET',
          dataType : 'json',
          success: function(response) {
            console.log(response);
              if(response.response.length == 1){
                $("#id").val(response.response[0].id);
                $("#judul").val(response.response[0].judul);
                // $("#kategori").val(response.response[0].kategori);
                $("#tanggal_kejadian").val(response.response[0].tanggal_kejadian);
                $("#kampung").val(response.response[0].kampung);
                $("#kelurahan").val(response.response[0].kelurahan);
                $("#kecamatan").val(response.response[0].kecamatan);
                $("#kabupaten").val(response.response[0].kabupaten);
                $("#dampak").val(response.response[0].dampak);
                $("#kerugian_material").val(response.response[0].kerugian_material);
                $("#korban_jiwa").val(response.response[0].korban_jiwa);
                $("#kronologis").val(response.response[0].kronologis);
                $("#penanganan").val(response.response[0].penanganan);
                $("#kebutuhan_darurat").val(response.response[0].kebutuhan_darurat);
                $("#image_box").html('<img src="<?php echo base_url(); ?>uploads/'+response.response[0].lampiran+'" class="img img-responsive img-border">');
                $("input[name=status][value=" + response.response[0].status + "]").attr('checked', 'checked');
                var ref = <?php echo json_encode($ref_bencana); ?>;
                for(var ctr =0 ;ctr < ref.length;ctr++){
                  if(ref[ctr].id == response.response[0].kategori){
                    $("select#kategori").val(ref[ctr].id);
                  }
                }
                var ref_st = <?php echo json_encode($ref_st); ?>;
                for(var ctr =0 ;ctr <ref_st.length;ctr++){
                  if(ref_st[ctr].id == response.response[0].status){
                    $("select#status").val(ref_st[ctr].id);
                  }
                }
              }else{
                alert("Gagal load data laporan masyarakat dini");
              }
          },
          error: function(response){
            alert("Terjadi ganguan saat load data laporan masyarakat");
          },
          cache: false,
          contentType: false,
          processData: false
        });
      });
    </script>
    <script>
      $("form#my_form").submit(function(e) {
        var konfirmasi = confirm("Apakah Anda yakin akan mengubah stage status laporan masyarakat?");
        if(konfirmasi){
          e.preventDefault();    
          var formData = new FormData(this);
          $.ajax({
              url: "<?php echo site_url(); ?>/api/laporan_masyarakat_update/",
              type: 'POST',
              data: formData,
              success: function(response) {
                  console.log(response);
                  if(response.response.code === "SUCCESS"){
                    alert(response.response.message);
                    location.reload(); 
                  }else
                  if(response.code === "ERROR"){
                    alert(response.response.message);
                  }
              },
              error: function(response){
                alert("Update laporan masyarakat gagal.");
              },
              cache: false,
              contentType: false,
              processData: false
          });
        }
      });
    </script>
    
    