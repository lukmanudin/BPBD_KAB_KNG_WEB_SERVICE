<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon.ico">
    <title>SIM BPBD</title>
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/dashboard.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/cke/ckeditor.js"></script>
    <script src="<?php echo base_url();?>assets/cke/bootstrap3-wysihtml5.all.js"></script>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Navigasi</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">BPBD Kab.Kuningan</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Account</a></li>
            </ul>
            <form class="navbar-form navbar-right">
              <input type="text" class="form-control" placeholder="Search...">
            </form>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
              <li><a href="<?php echo site_url();?>/apps/index/">Dashboard</a></li>
              <li><a href="<?php echo site_url();?>/apps/peringatan_dini/">Peringatan Dini</a></li>
              <li><a href="<?php echo site_url();?>/apps/info_bencana/">Info Bencana</a></li>
              <li><a href="<?php echo site_url();?>/apps/laporan_masyarakat/">Laporan Masyarakat</a></li>
              <li><a href="<?php echo site_url();?>/apps/user/">User</a></li>
            </ul>
          </div>