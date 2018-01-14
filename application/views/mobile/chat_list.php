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
                <div class="row" style="margin-top:20px">
                    <div class="wrapper">
                        <div class="col-lg-12" style="padding-right:25px;">
                            <a href="<?php echo site_url(); ?>/apps/mobile_chat_input/<?php echo $this->uri->segment(3) ?>/">
                                <input type="button" class="btn btn-primary btn-xs pull-right" value="Topik Baru" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="wrapper">
                        <div class="col-md-12" style="margin-top:20px">
                            <div id="first-tab-group" class="tabgroup">
                                <div id="tab1">
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
        var str = '';
        $(document).ready(function(){
            $.ajax({
            url: "<?php echo site_url(); ?>/api/chat/",
            type: 'GET',
            success: function(response) {
                var panjang_data = response.response.length;
                console.log(response.response[0].judul);
                if(panjang_data > 0){
                    for(var x=0;x<panjang_data;x++){
                        str +='<div class="text-content" style="margin-bottom:20px;">';
                        str +='<font style="color:#888;font-size:12pt"><b>' +  response.response[x].judul + '</b></font>';
                        str +='<ul class="info-post">';
                        str +='<li><i class="fa fa-user"></i><font style="color:#888;font-size:10pt">oleh ' +  response.response[x].pengirim + '</font></li>';
                        str +='</ul>';
                        str +='<ul class="info-post">';
                        str +='<li><i class="fa fa-calendar"></i><font style="color:#888;font-size:10pt">' +  response.response[x].tanggal_buat + '</font></li>';
                        str +='</ul>';
                        str +='<div class="row">';
                        str +='<div class="col-lg-12">';
                        str +='<a href="<?php echo site_url(); ?>/apps/mobile_chat_detail/<?php echo $this->uri->segment(3) ?>/'+  response.response[x].id +'/">';
                        str +='<input type="button" class="btn btn-primary btn-xs pull-right" value=" Detail " />';
                        str +='</a>';
                        if(response.response[x].id_pengirim == <?php echo $this->uri->segment(3); ?>){
                            str +='<input onClick="delete_data('+response.response[x].id+');" type="button" class="btn btn-primary btn-xs pull-right" value=" Hapus " style="margin-right:5px;"/>';
                        }
                        str +='</div>';
                        str +='</div>';
                        str +='</div>';
                    }
                    $("#tab1").html(str);    
                }
            },
            error: function(response){
                alert("Terjadi ganguan saat load data forum diskusi");
            },
            cache: false,
            contentType: false,
            processData: false
            });
        });

        function delete_data(id){
            var del = confirm("Apakah Anda yakin akan menghapus diskusi ?");
            if(del){
            $.ajax({
                url: "<?php echo site_url(); ?>/api/chat_delete/" + id + "/",
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
                    alert("Delete data diskusi gagal.");
                },
                cache: false,
                contentType: false,
                processData: false
            });

            }
        }
        </script>
    </body>
</html>