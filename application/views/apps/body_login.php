        <div class="container container-fluid">
            <div class="row">
                <div class="col-lg-4">d</div>
                <div class="col-lg-4">
                    <div class="panel panel-default" style="margin-top:90px;">
                        <div class="panel-heading">
                            <div class="panel-title">L O G I N</div>
                        </div>
                        <div class="panel-body">
                            <div class="notifikasi_bar"></div>
                            <form id="my_form" role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                                <span class="pull-right">
                                    <button type="submit" id="btn_simpan" value="simpan" class="btn btn-success">L o g i n</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">d</div>
            </div>
        </div>
        <script>
        $("form#my_form").submit(function(e) {
            e.preventDefault();    
            var formData = new FormData(this);
            $.ajax({
                url: "<?php echo site_url(); ?>/api/verifikasi/",
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    if(response.response.code === "MATCH"){
                        alert(response.response.message);
                        location.reload(); 
                    }else{
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
        });
        </script>