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
              <li><a href="<?php echo site_url(); ?>/apps/logout/">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
              <li <?php if($this->uri->segment(2)=="dashboard" || $this->uri->segment(1)==null) echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/dashboard/"><span class="glyphicon glyphicon-th-large"></span> Dashboard</a></li>
              <li <?php if($this->uri->segment(2)=="peringatan_dini") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/peringatan_dini/"><span class="glyphicon glyphicon-exclamation-sign"></span> Peringatan Dini</a></li>
              <li <?php if($this->uri->segment(2)=="info_bencana") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/info_bencana/"><span class="glyphicon glyphicon-fire"></span> Info Bencana</a></li>
              <li <?php if($this->uri->segment(2)=="laporan_masyarakat") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/laporan_masyarakat/"><span class="glyphicon glyphicon-bullhorn"></span> Laporan Masyarakat</a></li>
              <li <?php if($this->uri->segment(2)=="peta") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/peta/"><span class="glyphicon glyphicon-map-marker"></span> Kumpulan Peta</a></li>
              <li <?php if($this->uri->segment(2)=="user") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/user/"><span class="glyphicon glyphicon-user"></span> User</a></li>
              <li <?php if($this->uri->segment(2)=="chat") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/chat/"><span class="glyphicon glyphicon-comment"></span> Chat / Diskusi</a></li>
            </ul>
          </div>