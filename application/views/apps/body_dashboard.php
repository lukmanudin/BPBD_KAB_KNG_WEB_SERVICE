
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header"><span class="<?php echo $page_icon; ?>"></span> Dashboard</h3>
          <div class="row placeholders">
            <div class="col-xs-6 col-sm-4 placeholder">
              <h1><span class="glyphicon glyphicon-exclamation-sign"></span></h1>
              <h4 id="peringatan_dini_jumlah">0</h4>
              <span class="text-muted"><a href="<?php echo site_url('apps/peringatan_dini'); ?>">Peringatan Dini Tersimpan</a></span>
            </div>
            <div class="col-xs-6 col-sm-4 placeholder">
              <h1><span class="glyphicon glyphicon-fire"></span></h1>
              <h4 id="info_bencana_jumlah">0</h4>
              <span class="text-muted"><a href="<?php echo site_url('apps/info_bencana'); ?>">Info Bencana Tersimpan</a></span>
            </div>
            <div class="col-xs-6 col-sm-4 placeholder">
            <h1><span class="glyphicon glyphicon-bullhorn"></span></h1>
              <h4 id="laporan_masyarakat_jumlah">0</h4>
              <span class="text-muted"><a href="<?php echo site_url('apps/laporan_masyarakat'); ?>">Laporan Masyarakat</a></span>
            </div>
            <div class="col-xs-6 col-sm-4 placeholder">
              <h1><span class="glyphicon glyphicon-map-marker"></span></h1>
              <h4 id="peta_jumlah">0</h4>
              <span class="text-muted"><a href="<?php echo site_url('apps/peta'); ?>">Informasi dalam Peta</a></span>
            </div>
            <div class="col-xs-6 col-sm-4 placeholder">
              <h1><span class="glyphicon glyphicon-user"></span></h1>
              <h4 id="user_jumlah">0</h4>
              <span class="text-muted"><a href="<?php echo site_url('apps/user'); ?>">Pengguna (user)</a></span>
            </div>
            <div class="col-xs-6 col-sm-4 placeholder">
              <h1><span class="glyphicon glyphicon-comment"></span></h1>
              <h4 id="chat_jumlah">0</h4>
              <span class="text-muted"><a href="<?php echo site_url('apps/chat'); ?>">Topik Diskusi</a></span>
            </div>
          </div>
          <a href="#" class="navbar-left"><img src="<?php echo base_url('assets/maskot.png'); ?>"  /></a>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        function load_recent(){
            $.ajax({
                url : '<?php echo site_url(); ?>/api/dashboard/' ,
                type : 'GET',
                dataType : 'json',
                success : function(response){
                  $('#peringatan_dini_jumlah').html(response.response.peringatan_dini.peringatan_dini_total[0].jumlah);
                  $('#info_bencana_jumlah').html(response.response.info_bencana.info_bencana_total[0].jumlah);
                  $('#laporan_masyarakat_jumlah').html(response.response.laporan_masyarakat.laporan_masyarakat_total[0].jumlah);
                  $('#peta_jumlah').html(response.response.peta.peta_total[0].jumlah);
                  $('#user_jumlah').html(response.response.user.user_total[0].jumlah);
                  $('#chat_jumlah').html(response.response.diskusi.diskusi_total[0].jumlah);
                },
                error : function(response){
                    console.log('Kegagalan koneksi');
                },
            });
        }
        setInterval(function(){load_recent();},1000);
        
    });
    </script>