
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h3 class="page-header">
          <span class="<?php echo $page_icon; ?>"></span> <?php echo $judul_halaman; ?>
          <a href="<?php echo $url; ?>" class="btn btn-primary btn-sm pull-right">
            <span class="<?php echo $btn_icon; ?>"><span> <?php echo $btn_text; ?> </span></class>
          </a>
        </h3>
        <div class="col-lg-12" id="notifikasi_bar">  
        </div>
          <div class="table-responsive">
            <table class="table table-striped table-consensed">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Judul Info Bencana</th>
                  <th>Status</th>
                  <th>Tanggal Dikeluarkan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tabel_data">
                <tr>
                  <td colspan="5">Tidak ada Info bencana tersimpan di database!</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5"><b>Halaman : </b><select id="opt_halaman"></select></td>
                </tr>
              </tfoot>
            </table>
            <script>
            var tabel_data = '';
            var response_data;
            var limit_per_halaman = 4;
            $(document).ready(function(){
              $.ajax({
                url: "<?php echo site_url(); ?>/api/info_bencana/",
                type: 'GET',
                success: function(response) {
                    if(response.response.length > 0){
                      response_data = response;
                      var jml_halaman;
                      var opt_halaman = '';
                      if(response.response.length > limit_per_halaman){
                        jml_halaman = Math.ceil(response.response.length / limit_per_halaman);
                        var hal = 1;
                        for(var x=0;x<jml_halaman;x++){
                            opt_halaman += '<option value="'+ hal +'">'+ hal +'</option>';    
                            hal++;
                        }
                        $("#opt_halaman").html(opt_halaman);
                      }else{
                        jml_halaman = 1;
                      }
                      table_builder(response,1);
                    }
                },
                error: function(response){
                  alert("Terjadi ganguan saat load data info bencana");
                },
                cache: false,
                contentType: false,
                processData: false
              });
            });

            $("#opt_halaman").on('change',function(){
                var hal = $("#opt_halaman").val();
                table_builder(response_data,hal);
            });

            function table_builder(r,h){
              var jml_halaman;
              var batas_atas, batas_bawah;
              if(r.response.length < limit_per_halaman){
                jml_halaman = 1;
              }else{
                jml_halaman = Math.ceil(r.response.length / limit_per_halaman);
              }
               
              if(h==1){
                batas_bawah = h - 1;
                if(jml_halaman==1){
                  batas_atas = r.response.length;
                }else{
                  batas_atas = 1 * limit_per_halaman;
                }
              }else
              if(h==jml_halaman){
                batas_bawah = (h * limit_per_halaman) - limit_per_halaman;
                batas_atas = r.response.length;
              }else
              if(h > 1 && h < jml_halaman){
                batas_bawah = (h * limit_per_halaman) - limit_per_halaman;
                batas_atas = (h * limit_per_halaman);
              } 
              tabel_data = '';
              for(var x=batas_bawah;x<batas_atas;x++){
                tabel_data += '<tr>';
                tabel_data += '<td>' + (x+1)  + '</td>' ;
                tabel_data += '<td><i>' + r.response[x].judul + '</i></td>' ;
                if( r.response[x].status === "Publish"){
                  tabel_data += '<td><label class="label label-success">' + r.response[x].status + '</label></td>' ;
                }else{
                  tabel_data += '<td><label class="label label-warning">' + r.response[x].status + '</label></td>' ;
                }
                tabel_data += '<td>' + r.response[x].tanggal_buat  + '</td>' ;
                tabel_data += '<td>' ;
                tabel_data += '<button class="btn btn-xs btn-primary"  onClick="detail('+r.response[x].id+');"><span class="glyphicon glyphicon-eye-open"></span></button> ' ;
                tabel_data += '<button class="btn btn-xs btn-success" onClick="edit_data('+r.response[x].id+');"><span class="glyphicon glyphicon-pencil"></span></button> ' ;
                tabel_data += '<button class="btn btn-xs btn-danger" onClick="delete_data('+r.response[x].id+');"><span class="glyphicon glyphicon-remove"></span></button> ' ;
                tabel_data += '</td>' ;
                tabel_data += '</tr>';
              }
              $("#tabel_data").html(tabel_data);
            }

            function edit_data(id){
              window.location = "<?php echo site_url(); ?>/apps/info_bencana/edit/" + id + "/";
            }

            function delete_data(id){
              var del = confirm("Apakah Anda yakin akan menghapus info bencana ?");
              if(del){
                $.ajax({
                    url: "<?php echo site_url(); ?>/api/info_bencana_delete/" + id + "/",
                    type: 'GET',
                    dataType : 'json',
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
                      alert("Delete data info bencana gagal.");
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });

              }else{

              }
            }  

            function detail(id){
              window.open('<?php echo site_url("apps/mobile_info_bencana_detail/'+ id +'") ?>','Detail Peringatan Dini','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,width=800,height=400');
            }
            </script>
          </div>
        </div>
      </div>
    </div>
    
