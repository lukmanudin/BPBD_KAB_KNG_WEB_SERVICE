
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
            <input type="hidden" name="id" id="id" >
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" required oninvalid="this.setCustomValidity('Kolom Username tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" disabled>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required oninvalid="this.setCustomValidity('Kolom Password tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
            </div>
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required oninvalid="this.setCustomValidity('Kolom Nama Lengkap tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email" required oninvalid="this.setCustomValidity('Kolom Alamat Email Lengkap tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
            </div>
            <div class="form-group">
              <label>Alamat Rumah</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat  Rumah" required oninvalid="this.setCustomValidity('Kolom Alamat Rumah Lengkap tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="status" id="status" class="form-control">
                <option value="0">Belum Aktif</option>
                <option value="1">Aktif</option>
                <option value="2">Terblokir</option>
              </select>
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
          url: "<?php echo site_url(); ?>/api/user_edit/<?php echo $this->uri->segment(4); ?>/",
          type: 'GET',
          dataType : 'json',
          success: function(response) {
              console.log(response);
              if(response.response.length == 1){
                $("#id").val(response.response[0].id);
                $("#nama").val(response.response[0].nama);
                $("#username").val(response.response[0].username);
                $("#password").val(response.response[0].password);
                $("#email").val(response.response[0].email);
                $("#alamat").val(response.response[0].alamat);
                for(var ctr = 0 ;ctr < 3;ctr++){
                  if(ctr == response.response[0].status){
                    $("select#status").val(response.response[0].status);
                  }
                }
              }else{
                alert("Gagal load data user");
              }
          },
          error: function(response){
            alert("Terjadi ganguan saat load data user");
          },
          cache: false,
          contentType: false,
          processData: false
        });
      });


      $("form#my_form").submit(function(e) {
        var konfirmasi = confirm("Apakah Anda yakin akan menyimpan perubahan data user?");
        if(konfirmasi){
          e.preventDefault();    
          var formData = new FormData(this);
          $.ajax({
              url: "<?php echo site_url(); ?>/api/user_update/",
              type: 'POST',
              data: formData,
              success: function(response) {
                  console.log(response);
                  if(response.response.code === "SUCCESS"){
                    alert(response.response.message);
                    window.location.replace("<?php echo site_url(); ?>/apps/user/");
                  }else
                  if(response.code === "ERROR"){
                    alert(response.response.message);
                  }
              },
              error: function(response){
                alert("Simpan data user gagal.");
              },
              cache: false,
              contentType: false,
              processData: false
          });
        }
      });
    </script>
    