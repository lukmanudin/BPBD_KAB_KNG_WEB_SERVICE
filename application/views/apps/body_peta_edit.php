
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
              <input type="hidden" id="id" name="id">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Judul info bencana</label>
                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul peringatan dini">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Kategori bencana</label>
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
              <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Isi peringatan dini"></textarea>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div id="map" style="min-height:400px;"></div>
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
    <script>
      $(function () {
        CKEDITOR.replace('deskripsi');
        $(".textarea").wysihtml5();
      });
    </script>
    <script>
      $(document).ready(function(){
        $.ajax({
          url: "<?php echo site_url(); ?>/api/peta_edit/<?php echo $this->uri->segment(4); ?>/",
          type: 'GET',
          dataType : 'json',
          success: function(response) {
              console.log(response);
              if(response.response.length == 1){
                $("#id").val(response.response[0].id);
                $("#judul").val(response.response[0].judul);
                $("#deskripsi").val(response.response[0].deskripsi);
                $("#image_box").html('<img src="<?php echo base_url(); ?>uploads/'+response.response[0].lampiran+'" class="img img-responsive img-border">');
                $("input[name=status][value=" + response.response[0].status + "]").attr('checked', 'checked');
                var ref = <?php echo json_encode($ref_peta); ?>;
                for(var ctr =0 ;ctr < ref.length;ctr++){
                  if(ref[ctr].id == response.response[0].jenis){
                    $("select#jenis").val(ref[ctr].id);
                  }
                }
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
              url: "<?php echo site_url(); ?>/api/peta_update/",
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
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: -6.9, lng: 108.4}
        });

        var ctaLayer = new google.maps.KmlLayer({
          url: 'http://laurensius-dede-suhardiman.com/peta_ancamaman_gunung_api.kml',
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEV6VJJWMu_R52hjxFcfx9a--OVKA5Hno&callback=initMap">
    </script>
    
    