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
                    <div class="wrapper">
                        <div class="col-md-12" style="margin-top:20px">
                            <div id="first-tab-group" class="tabgroup">
                                <div id="tab1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="wrapper">
                        <div class="col-md-12" style="margin-top:20px">
                            <div id="first-tab-group" class="tabgroup">
                                <div id="tab2">
                                    <div class="text-content" style="padding-bottom:60px">
                                        <font style="color:#888;font-size:12pt">
                                        <p>
                                        <form id="my_form" role="form" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                            <label>Tanggapan Anda</label>
                                            <textarea class="form-control" id="isi" name="isi" placeholder="Isi diskusi"></textarea>
                                            </div>
                                            <span class="pull-right">
                                            <button type="submit" id="btn_simpan" value="SIMPAN" class="btn btn-success">SIMPAN </button> 
                                            <button type="button" id="btn_simpan" value="KEMBALI" class="btn btn-primary" onClick="goBack();">KEMBALI </button>
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
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" id="comment_box">
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
            var konfirmasi = confirm("Apakah Anda yakin akan mengirim tanggapan pada diskusi ini?");
            if(konfirmasi){
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            e.preventDefault();    
            var formData = new FormData(this);
            $.ajax({
                url: '<?php echo site_url(); ?>/api/chat_input_komentar/<?php echo $this->uri->segment(3) ."/". $this->uri->segment(4) . "/"; ?>' , //id_user/id_forum
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
        <script>
        var str = '';
        var cmt = ''
        $(document).ready(function(){
            $.ajax({
            url: "<?php echo site_url(); ?>/api/chat_detail/<?php echo $this->uri->segment(3)."/".$this->uri->segment(4); ?>/",
            type: 'GET',
            success: function(response) {
                var panjang_data_response = response.response.response_detail.length;
                var panjang_data_komentar = response.response.response_komentar.length;
                console.log(response.response.response_detail[0].judul);
                if(panjang_data_response > 0){
                    str +='<div class="text-content" style="margin-bottom:20px;">';
                    str +='<font style="color:#888;font-size:12pt"><b>' +  response.response.response_detail[0].judul + '</b></font>';
                    str +='<ul class="info-post">';
                    str +='<li><i class="fa fa-user"></i><font style="color:#888;font-size:10pt">oleh ' +  response.response.response_detail[0].pengirim + '</font></li>';
                    str +='</ul>';
                    str +='<ul class="info-post">';
                    str +='<li><i class="fa fa-calendar"></i><font style="color:#888;font-size:10pt">' +  response.response.response_detail[0].tanggal_buat + '</font></li>';
                    str +='</ul>';
                    str +='<p>'
                    str += response.response.response_detail[0].isi;
                    str +='<p>';
                    str +='</div>'   
                }
                if(panjang_data_komentar > 0){
                    for(var x = 0;x<panjang_data_komentar;x++){
                        cmt +='<div class="well" style="margin-left:10px;margin-right:10px;">';
                        cmt +='<div class="media">';
                        cmt +='<div class="media-body">';
                        cmt +='<font style="color:#888;font-size:10pt">Tanggapan dari <i>' + response.response.response_komentar[x].pengirim  + '</i></font>';
                        cmt +='<br><font style="color:#888;font-size:8pt">Pada tanggal ' + response.response.response_komentar[x].tanggal_buat+ '</i></font>';
                        cmt +='<p>';
                        cmt += '<font style="color:#888;font-size:10pt"><i>' + response.response.response_komentar[x].isi + '</i></font>';
                        cmt +='</p>';
                        cmt +='</div>';
                        cmt +='</div>';
                        cmt +='</div>';
                    }
                    
                }
                $("#tab1").html(str); 
                $("#comment_box").html(cmt); 
            },
            error: function(response){
                alert("Terjadi ganguan saat load data forum diskusi");
            },
            cache: false,
            contentType: false,
            processData: false
            });
        });
        </script>
        <script>
        function goBack() {
            window.history.back();
        }
        </script>
    </body>
</html>