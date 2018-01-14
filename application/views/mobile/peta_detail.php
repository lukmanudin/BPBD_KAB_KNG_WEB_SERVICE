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
        <script src="<?php echo base_url();?>assets/landing_page/js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <section class="tabs-content" id="blog">
            <div class="container">
                <div class="row" id="map_box">
                    <div class="wrapper">
                        <div class="col-md-12" style="margin-top:20px">
                            <div id="first-tab-group" class="tabgroup">
                                <div id="tab1">
                                    <div class="text-content">
                                        <div id="map" style="min-height:400px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="wrapper">
                        <div class="col-md-12" style="margin-top:20px">
                            <div id="first-tab-group" class="tabgroup">
                                <div id="tab1">
                                    <span id="image_box"></span>
                                    <div class="text-content">
                                        <h4><?php echo $page_content[0]->judul; ?></h4>
                                        <ul class="info-post">
                                            <li><i class="fa fa-picture-o"></i><?php echo $page_content[0]->lampiran; ?></li>
                                        </ul>
                                        <ul class="info-post">
                                            <li><i class="fa fa-calendar"></i><?php echo $page_content[0]->tanggal_upload; ?></li>
                                        </ul>
                                        <p>
                                        <label>Deskripsi : </label><br>
                                        <?php echo $page_content[0]->deskripsi; ?>  
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top:10px;margin-bottom:10px;">
                        <input type="button" style="padding:2.5px" onClick="goBack();" class="btn btn-primary form-control" value="KEMBALI" id="bback"/>
                    </div>
                </div>
            </div>
        </section>
        <script src="<?php echo base_url();?>assets/landing_page/js/vendor/jquery-1.11.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url();?>assets/landing_page/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="<?php echo base_url();?>assets/landing_page/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/landing_page/js/plugins.js"></script>
        <script src="<?php echo base_url();?>assets/landing_page/js/main.js"></script>
        <script>
            var nama_lampiran = '<?php echo $page_content[0]->lampiran; ?>';
            var ekstensi;
            if(nama_lampiran != null){
                ekstensi = nama_lampiran.split('.');
                if(ekstensi[1] != 'kml' || ekstensi[1] != 'KML'){
                    $('#image_box').html('<img src="<?php echo base_url();?>uploads/<?php echo $page_content[0]->lampiran; ?>" alt="">');
                }else{
                    load_kml(nama_lampiran);
                }
            }

            function load_kml(nama_lampiran){
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 11,
                    center: {lat: -6.9, lng: 108.4}
                });

                var ctaLayer = new google.maps.KmlLayer({
                url: '<?php echo base_url('uploads'); ?>/peta_ancamaman_gunung_api.kml',
                map: map
                });
            }
        </script>
        <?php
        $exp = explode(".",$page_content[0]->lampiran);
        if($exp[1]=="kml" ||$exp[1]=="KML"){
            echo '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEV6VJJWMu_R52hjxFcfx9a--OVKA5Hno&callback=load_kml"></script>';
        }else{
            echo "<script>$('#map_box').hide();</script>";
        }
        if($this->uri->segment(4) == "web"){
            echo "<script>$('#bback').hide();</script>";
        }
        ?>
        <script>
        function goBack() {
            window.history.back();
        }
        </script>
    </body>
</html>