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
                <div class="row">
                    <div class="wrapper">
                        <div class="col-md-12" style="margin-top:20px">
                            <div id="first-tab-group" class="tabgroup">
                                <div id="tab1">
                                    <img src="<?php echo base_url();?>uploads/<?php echo $page_content[0]->lampiran; ?>" alt="">
                                    <div class="text-content">
                                        <h4><?php echo $page_content[0]->judul; ?></h4>
                                        <ul class="info-post">
                                            <li><i class="fa fa-user"></i><?php echo $page_content[0]->judul; ?></li>
                                            <li><i class="fa fa-calendar"></i><?php echo $page_content[0]->tanggal_buat; ?></li>
                                        </ul>
                                        <p>
                                        <label>Tanggal Kejadian : </label><br>
                                        <?php echo $page_content[0]->tanggal_kejadian; ?>  
                                        </p>

                                        <p>
                                        <label>Lokasi kejadian</label><br>
                                        <?php echo $page_content[0]->kampung; ?>, <?php echo $page_content[0]->kelurahan; ?>, 
                                        <?php echo $page_content[0]->kecamatan; ?>, <?php echo $page_content[0]->kabupaten; ?>.  
                                        </p> 
                                        
                                        <p>
                                        <label>Kronologis</label><br>
                                        <?php echo $page_content[0]->kronologis; ?>
                                        </p>

                                        <p>
                                        <label>Status</label><br>
                                        <?php echo $page_content[0]->status; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="<?php echo base_url();?>assets/landing_page/js/vendor/jquery-1.11.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url();?>assets/landing_page/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="<?php echo base_url();?>assets/landing_page/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/landing_page/js/plugins.js"></script>
        <script src="<?php echo base_url();?>assets/landing_page/js/main.js"></script>
    </body>
</html>