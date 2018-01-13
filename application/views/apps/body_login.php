        <div class="container container-fluid">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="panel panel-default" style="margin-top:90px;">
                        <div class="panel-heading">
                            <div class="panel-title">L O G I N</div>
                        </div>
                        <div class="panel-body">
                            <div id="notifikasi_bar"></div>
                            <form id="my_form" role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required oninvalid="this.setCustomValidity('Kolom Username tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required oninvalid="this.setCustomValidity('Kolom Password tidak boleh dikosongkan!')"
    oninput="setCustomValidity('')" >
                                </div>
                                <span class="pull-right">
                                    <button type="submit" id="btn_simpan" value="simpan" class="btn btn-success">L o g i n</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        <script>
        $("form#my_form").submit(function(e) {
            var notif = '';
            notif += '<div class="alert alert-primary alert-dismissable">';
            notif += 'Loading . . .';
            notif += '</div>';
            $("#notifikasi_bar").html(notif);
            e.preventDefault();    
            var formData = new FormData(this);
            $.ajax({
                url: "<?php echo site_url(); ?>/api/verifikasi/",
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    notif = '';
                    if(response.response.code === "MATCH"){
                        if(response.response.data_user[0].tipe == "1"){
                            notif += '<div class="alert alert-'+response.response.severity +' alert-dismissable">';
                            notif += response.response.message;
                            notif += '</div>';
                            $("#notifikasi_bar").html(notif);
                            location.reload(); 
                        }else{  
                            notif += '<div class="alert alert-warning alert-dismissable">';
                            notif += 'Anda tidak diperkenankan login.Hanya admin yang berhak akses halaman ini';
                            notif += '</div>';
                            $("#notifikasi_bar").html(notif); 
                        }
                    }else{
                        notif = '';
                        notif += '<div class="alert alert-'+response.response.severity +' alert-dismissable">';
                        notif += response.response.message;
                        notif += '</div>';
                        $("#notifikasi_bar").html(notif);
                    }
                },
                error: function(response){
                    notif = '';
                    notif += '<div class="alert alert-warning alert-dismissable">';
                    notif += 'Login gagal, terjadi gangguan saat terhubung ke server';
                    notif += '</div>';
                    $("#notifikasi_bar").html(notif);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        </script>