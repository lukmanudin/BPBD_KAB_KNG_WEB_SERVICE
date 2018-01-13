
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
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label>Judul peringatan dini</label>
              <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul peringatan dini" required oninvalid="this.setCustomValidity('Kolom Judul tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
            </div>
            <div class="form-group">
              <label>Isi</label>
              <textarea class="form-control" id="isi" name="isi" placeholder="Isi peringatan dini"></textarea>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <span id="image_box"></span>
                <div class="form-group">
                  <label>Lampiran</label>
                  <input type="file" class="form-control" id="lampiran" name="lampiran" placeholder="Lampiran">
                </div>
              </div>
              <div class="col-lg-6"></div>
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
        CKEDITOR.replace('isi');
        $(".textarea").wysihtml5();
      });
    </script>
    <script>
      $(document).ready(function(){
        $.ajax({
          url: "<?php echo site_url(); ?>/api/peringatan_dini_edit/<?php echo $this->uri->segment(4); ?>/",
          type: 'GET',
          dataType : 'json',
          success: function(response) {
              console.log(response);
              if(response.response.length == 1){
                $("#id").val(response.response[0].id);
                $("#judul").val(response.response[0].judul);
                $("#isi").val(response.response[0].isi);
                $("#image_box").html('<img src="<?php echo base_url(); ?>uploads/'+response.response[0].lampiran+'" class="img img-responsive img-border">');
                $("input[name=status][value=" + response.response[0].status + "]").attr('checked', 'checked');
                }else{
                alert("Gagal load data peringatan dini");
              }
          },
          error: function(response){
            alert("Terjadi ganguan saat load data peringatan dini");
          },
          cache: false,
          contentType: false,
          processData: false
        });
      });


      $("form#my_form").submit(function(e) {
        var konfirmasi = confirm("Apakah Anda yakin akan menyimpan peringatan dini?");
        if(konfirmasi){
          for ( instance in CKEDITOR.instances ) {
              CKEDITOR.instances[instance].updateElement();
          }
          e.preventDefault();    
          var formData = new FormData(this);
          $.ajax({
              url: "<?php echo site_url(); ?>/api/peringatan_dini_update/",
              type: 'POST',
              data: formData,
              success: function(response) {
                  console.log(response);
                  if(response.response.code === "SUCCESS"){
                    alert(response.response.message);
                    window.location.replace("<?php echo site_url(); ?>/apps/peringatan_dini/");
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

    
    