
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
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Nama / Judul peta</label>
                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Nama / judul peta" required oninvalid="this.setCustomValidity('Kolom Judul tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Jenis Peta</label>
                  <select class="form-control" id="jenis" name="jenis">
                    <?php
                      foreach($ref_peta as $ref){
                        echo '<option value="'.$ref->id.'">'.$ref->jenis.'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"></textarea>
            </div>
            <div class="form-group">
              <label>Upload file peta</label>
              <input type="file" class="form-control" id="lampiran" name="lampiran" placeholder="Lampiran" required oninvalid="this.setCustomValidity('Kolom Lampiran tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
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
    <script>
      $(function () {
        CKEDITOR.replace('deskripsi');
        $(".textarea").wysihtml5();
      });
    </script>
    <script>
      $("form#my_form").submit(function(e) {
        var konfirmasi = confirm("Apakah Anda yakin akan menyimpan peta?");
        if(konfirmasi){
          for ( instance in CKEDITOR.instances ) {
              CKEDITOR.instances[instance].updateElement();
          }
          e.preventDefault();    
          var formData = new FormData(this);
          $.ajax({
              url: "<?php echo site_url(); ?>/api/peta_input/",
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
                alert("Simpan data peta gagal.");
              },
              cache: false,
              contentType: false,
              processData: false
          });
        }
      });
    </script>

    
    