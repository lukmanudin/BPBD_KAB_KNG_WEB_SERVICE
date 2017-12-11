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
              <li <?php if($this->uri->segment(2)=="dashboard") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/index/dashboard/">Dashboard</a></li>
              <li <?php if($this->uri->segment(2)=="peringatan_dini") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/peringatan_dini/">Peringatan Dini</a></li>
              <li <?php if($this->uri->segment(2)=="info_bencana") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/info_bencana/">Info Bencana</a></li>
              <li <?php if($this->uri->segment(2)=="laporan_masyarakat") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/laporan_masyarakat/">Laporan Masyarakat</a></li>
              <li <?php if($this->uri->segment(2)=="user") echo ' class="active"';?>><a href="<?php echo site_url();?>/apps/user/">User</a></li>
            </ul>
          </div>