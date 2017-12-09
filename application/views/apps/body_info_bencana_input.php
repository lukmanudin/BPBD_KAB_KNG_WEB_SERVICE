
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header">
            <?php echo $judul_halaman; ?>
            <a href="<?php echo $url; ?>" class="btn btn-primary btn-sm pull-right">
              <span class="<?php echo $btn_icon; ?>"><span> <?php echo $btn_text; ?> </span></class>
            </a>
          </h3>
          <div class="col-lg-12" id="notifikasi_bar">  
          </div>
          <form id="my_form" role="form" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Judul info bencana</label>
                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul peringatan dini">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Kategori bencana</label>
                  <select class="form-control" id="kategori" name="kategori">
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
                  <input type="text" class="form-control" id="kampung" name="kampung" placeholder="Lokasi Bencana">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Kelurahan</label>
                  <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>Kabupaten</label>
                  <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Kabupaten">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Dampak</label>
                  <textarea class="form-control" id="dampak" name="dampak" placeholder="Dampak yang ditimbulkan"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Kerugian Material</label>
                  <textarea class="form-control" id="kerugian_material" name="kerugian_material" placeholder="Kerugian material"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Korban Jiwa</label>
                  <textarea class="form-control" id="korban_jiwa" name="korban_jiwa" placeholder="Korban jiwa"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Kronologis peristiwa</label>
                  <textarea class="form-control" id="kronologis" name="kronologis" placeholder="Kronologis peristiwa"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Upaya penanganan</label>
                  <textarea class="form-control" id="penanganan" name="penanganan" placeholder="Upaya penanganan"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Kebutuhan / Darurat</label>
                  <textarea class="form-control" id="kebutuhan_darurat" name="kebutuhan_darurat" placeholder="Kebutuhan / Darurat"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Lampiran</label>
              <input type="file" class="form-control" id="lampiran" name="lampiran" placeholder="Lampiran">
            </div>
            <div class="form-group">
              <label>Save as</label>
              <div class="radio">
                <label>
                  <input type="radio" name="status" value="Draft" checked>
                    Simpan sebagai draft
                  </label>
                </div>
                <div class="radio">
                  <label>
                  <input type="radio" name="status" value="Publish">
                    Simpan dan publikasikan
                </label>
                  </label>
                </div>
              </div>
            <span class="pull-right">
              <button type="submit" id="btn_simpan" value="simpan" class="btn btn-success">Simpan</button>
            </span>
          </form>
        </div>
      </div>
    </div>
    <!-- <script>
      $(function () {
        CKEDITOR.replace('isi');
        $(".textarea").wysihtml5();
      });
    </script> -->
    <script>
      $("form#my_form").submit(function(e) {
        var konfirmasi = confirm("Apakah Anda yakin akan menyimpan peringatan dini?");
        if(konfirmasi){
          e.preventDefault();    
          var formData = new FormData(this);
          $.ajax({
              url: "<?php echo site_url(); ?>/api/info_bencana_input/",
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
                alert("Simpan data peringatan dini gagal.");
              },
              cache: false,
              contentType: false,
              processData: false
          });
        }
      });
    </script>

    
    