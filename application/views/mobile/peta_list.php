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
            url: "<?php echo site_url(); ?>/api/mobile_peta_list/<?php echo $this->uri->segment(3); ?>",
            type: 'GET',
            success: function(response) {
                var panjang_data = response.response.length;
                console.log(response.response[0].judul);
                if(panjang_data > 0){
                    for(var x=0;x<panjang_data;x++){
                        str +='<div class="text-content" style="margin-bottom:20px;">';
                        str +='<font style="color:#888;font-size:12pt"><b>' +  response.response[x].judul + '</b></font>';
                        str +='<ul class="info-post">';
                        str +='<li><i class="fa fa-picture-o"></i><font style="color:#888;font-size:10pt">File peta : ' +  response.response[x].lampiran + '</font></li>';
                        str +='</ul>';
                        str +='<ul class="info-post">';
                        str +='<li><i class="fa fa-calendar"></i><font style="color:#888;font-size:10pt">Tanggal upload : ' +  response.response[x].tanggal_upload + '</font></li>';
                        str +='</ul>';
                        str +='<div class="row">';
                        str +='<div class="col-lg-12">';
                        str +='<p>';
                        str +='<center>';
                        str +='<a href="<?php echo site_url(); ?>/apps/mobile_peta_detail/'+  response.response[x].id +'/">';
                        str +='<input type="button" class="btn btn-primary btn-md" value="Lihat Peta" />';
                        str +='</a>';
                        str +='</center>';
                        str +='</div>';
                        str +='</div>';
                        str +='</div>';
                    }
                    $("#tab1").html(str);    
                }
            },
            error: function(response){
                alert("Terjadi ganguan saat load data peta");
            },
            cache: false,
            contentType: false,
            processData: false
            });
        });
        </script>
    </body>
</html>