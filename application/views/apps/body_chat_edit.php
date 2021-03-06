
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
              <label>Judul / topik diskusi</label>
              <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul / topik diskusi" required oninvalid="this.setCustomValidity('Kolom Judul tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
            </div>
            <div class="form-group">
              <label>Isi</label>
              <textarea class="form-control" id="isi" name="isi" placeholder="Isi diskusi"></textarea>
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
          url: "<?php echo site_url(); ?>/api/chat_edit/<?php echo $this->uri->segment(4); ?>/",
          type: 'GET',
          dataType : 'json',
          success: function(response) {
              console.log(response);
              if(response.response.length == 1){
                $("#id").val(response.response[0].id);
                $("#judul").val(response.response[0].judul);
                $("#isi").val(response.response[0].isi);
              }else{
                alert("Gagal load data diskusi");
              }
          },
          error: function(response){
            alert("Terjadi ganguan saat load data diskusi");
          },
          cache: false,
          contentType: false,
          processData: false
        });
      });
    </script>
    <script>
      $("form#my_form").submit(function(e) {
        var konfirmasi = confirm("Apakah Anda yakin akan melakukan perubahan pada konten diskusi?");
        if(konfirmasi){
          for ( instance in CKEDITOR.instances ) {
              CKEDITOR.instances[instance].updateElement();
          }
          e.preventDefault();    
          var formData = new FormData(this);
          $.ajax({
              url: "<?php echo site_url(); ?>/api/chat_update/",
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
                alert("Simpan data diskusi gagal.");
              },
              cache: false,
              contentType: false,
              processData: false
          });
        }
      });
    </script>
    
    
    