<!DOCTYPE html>
<html class="no-js"> 
    <head>
        <meta charset="utf-8">
        <title>SIMBPBD</title>
    	<meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/landing_page/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/landing_page/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/landing_page/css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/landing_page/css/templatemo_misc.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/landing_page/css/templatemo_style.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/landing_page/css/owl-carousel.css">
        <script src="<?php echo base_url();?>assets/landing_page/js/vendor/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url();?>assets/landing_page/js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>    
        <script src="<?php echo base_url();?>assets/cke/ckeditor.js"></script>
        <script src="<?php echo base_url();?>assets/cke/bootstrap3-wysihtml5.all.js"></script>
    </head>
    <body>
        <section class="tabs-content" id="blog" style="background-color:white">
            <div class="container">
                <div class="row">
                    <div class="wrapper" style="padding-bottom:60px">
                        <div class="col-md-12" style="margin-top:20px">
                            <div id="first-tab-group" class="tabgroup">
                                <div id="tab1">
                                    <div class="text-content"  style="padding-bottom:60px">
                                        <h4>Tambah Topik Diskusi</h4>
                                        <!-- <ul class="info-post">
                                            <li><i class="fa fa-user"></i>Admin</li>
                                            <li><i class="fa fa-calendar"></i><?php echo $page_content[0]->tanggal_publish; ?></li>
                                        </ul> -->
                                        <p>
                                        <form id="my_form" role="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                            <label>Judul / topik diskusi</label>
                                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul / topik diskusi">
                                            </div>
                                            <div class="form-group">
                                            <label>Isi</label>
                                            <textarea class="form-control" id="isi" name="isi" placeholder="Isi diskusi"></textarea>
                                            </div>
                                            <span class="pull-right">
                                            <button type="submit" id="btn_simpan" value="simpan" class="btn btn-success">Simpan </button>
                                            <a href="<?php echo site_url(); ?>/apps/mobile_chat_list/<?php echo $this->uri->segment(3) ?>/" style="margin-left:10px;">
                                                <input type="button" class="btn btn-primary  pull-right" value="Kembali" />
                                            </a>
                                            </span>
                                        </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>window.jQuery || document.write('<script src="<?php echo base_url();?>assets/landing_page/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="<?php echo base_url();?>assets/landing_page/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/landing_page/js/plugins.js"></script>
        <script src="<?php echo base_url();?>assets/landing_page/js/main.js"></script>
        <script>
        $(function () {
            CKEDITOR.replace('isi');
            $(".textarea").wysihtml5();
        });
        </script>
        <script>
        $("form#my_form").submit(function(e) {
            var konfirmasi = confirm("Apakah Anda yakin akan mengirim topik diskusi?");
            if(konfirmasi){
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            e.preventDefault();    
            var formData = new FormData(this);
            $.ajax({
                url: '<?php echo site_url(); ?>/api/chat_input/<?php echo $this->uri->segment(3); ?>' ,
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
    </body>
</html>