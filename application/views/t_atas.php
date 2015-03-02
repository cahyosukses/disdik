<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
      <meta charset="utf-8">
      <?php
         if (empty($meta)) {
         	echo "";
         } else {
         	echo $meta;
         }
       ?>
      <title><?php echo $title?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- Le styles -->
      <link href="<?php echo base_URL()?>assets/css/bootstrap.css" rel="stylesheet">
      <link href="<?php echo base_URL()?>assets/css/bootstrap-responsive.css" rel="stylesheet">
      <link href="<?php echo base_URL()?>assets/css/disdik.css" rel="stylesheet">
      <link href="<?php echo base_URL()?>assets/calendar/eventCalendar.css" rel="stylesheet">
      <link href="<?php echo base_URL()?>assets/calendar/eventCalendar_theme_responsive.css" rel="stylesheet">

      <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <!-- Le fav and touch icons -->
      <link rel="shortcut icon" href="<?php echo base_URL()?>/favicon.ico">
      <?php if(isset($show_map)){ ?>
      <script	src="http://maps.googleapis.com/maps/api/js"></script>
      <script>
         var directionsDisplay;
               var directionsService = new google.maps.DirectionsService();
               var endLatlng = new google.maps.LatLng(-1.6067930000000104,103.57839999999999);
                
                function initialize() {
                
         	directionsDisplay = new google.maps.DirectionsRenderer();
         	var mapOptions = {
         	   zoom: 15,
         	   mapTypeId: google.maps.MapTypeId.ROADMAP,
         	   center: endLatlng,
         	   disableDefaultUI:true    
         	};		  
                
         	var map = new google.maps.Map(document.getElementById('googleMap'),mapOptions);
                
         	var marker = new google.maps.Marker({
         	  position: endLatlng,
         	  map: map,
         	  title:"Hello World!"
         	});
                
         	directionsDisplay.setMap(map);
         	directionsDisplay.setPanel(document.getElementById('directions-panel'));
                
         	var control = document.getElementById('control');
         	control.style.display = 'block';
                
         	map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);         
                }
         google.maps.event.addDomListener(window, 'load', initialize);
      </script>
      <?php } ?>
   </head>
   <?php
      $l_val	= array("", "blog", "portofolio", "download", "bukutamu");
      $l_view	= array("Beranda", "Blog", "Portofolio", "Download", "Contact");
      ?>
   <body>
      <div class="container well" style="width: 960px">
      <img src="<?php echo base_URL()?>assets/logo.gif" style="width: 70px; height: 70px; display: inline; margin: -5px 0 50px 0">
      <h3 style="margin: -120px 0 20px 90px; font-family: Georgia; font-size: 30px">Dinas Pendidikan Provinsi Jambi</h3>
      <br>
      <small style="font-family: Times New Roman; font-size: 17px; margin: -40px 0 0 90px; display: inline; position: absolute">Alamat : Jl. Jend. A. Yani No.06 Telanaipura Jambi. Telp. (0741) 63197 Fax. (0741) 63197</small>
      <div style="margin-top: -40px; font-family: tahoma" class="pull-right">
         <a href="<?php echo base_URL()?>tampil/bukutamu">Kontak Kami</a> 
      </div>
      <div class="navbar">
         <div class="navbar-inner">
            <ul class="nav">
               <li><a href="<?php echo base_URL()?>tampil" class="depan">Beranda</a></li>
               <li class="dropdown">
                  <a data-toggle="dropdown" href="#" class="dropdown-toggle depan">Profil &nbsp;&nbsp;<b class="caret"></b></a>		
                  <ul class="dropdown-menu">
                     <?php 
                        $q_menu_profil = $this->db->query("SELECT id, judul FROM profil")->result();
                        foreach ($q_menu_profil as $mp) {
                        ?>
                     <li><a href="<?php echo base_URL()?>tampil/profil/<?php echo $mp->id?>/<?php echo getURLFriendly($mp->judul)?>"><?php echo $mp->judul?></a></li>
                     <?php
                        }
                        ?>
                  </ul>
               </li>
               <li class="dropdown">
                  <a data-toggle="dropdown" href="#" class="dropdown-toggle depan">Data dan Informasi &nbsp;&nbsp;<b class="caret"></b></a>		
                  <ul class="dropdown-menu">
                     <!--
                        <?php 
                           $q_menu_data_informasi = $this->db->query("SELECT id, judul FROM data_informasi")->result();
                           foreach ($q_menu_data_informasi as $mp) {
                           ?>
                        <li><a href="<?php echo base_URL()?>tampil/data_informasi/<?php echo $mp->id?>/<?php echo getURLFriendly($mp->judul)?>"><?php echo $mp->judul?></a></li>
                        <?php
                           }
                           ?>
                        -->
                     <li><a href="<?php echo base_URL()?>tampil/rekap_data_sekolah">Rekap Data Sekolah</a></li>
                     <li><a href="<?php echo base_URL()?>tampil/daftar_sekolah">Daftar Nama dan Alamat Sekolah</a></li>
                  </ul>
               </li>
               <li class="dropdown">
                  <a data-toggle="dropdown" href="#" class="dropdown-toggle depan">Produk Hukum &nbsp;&nbsp;<b class="caret"></b></a>		
                  <ul class="dropdown-menu">
                     <?php 
                        $q_menu_data_produk_hukum = $this->db->query("SELECT id, judul FROM data_produk_hukum ORDER BY id")->result();
                        foreach ($q_menu_data_produk_hukum as $mp) {
                        ?>
                     <li><a href="<?php echo base_URL()?>tampil/data_produk_hukum/<?php echo $mp->id?>/<?php echo getURLFriendly($mp->judul)?>"><?php echo $mp->judul?></a></li>
                     <?php
                        }
                        ?>
                  </ul>
               </li>
               <li><a href="<?php echo base_URL()?>tampil/galeri" class="depan">Galeri</a></li>
            </ul>
            <form class="navbar-form pull-right" method="post" action="<?php echo base_URL()?>tampil/cari">
               <input type="text" class="span2" name="q" value="<?php echo $this->input->post('q')?>">
               <button type="submit" class="btn">Cari</button>
            </form>
         </div>
      </div>
      <div id="myCarousel" class="carousel slide" style="height: 400px">
         <div class="carousel-inner">
            <?php $slideshow = $this->basecrud_m->get_where('galeri',array('slideshow' => 'Y'));?>
            <?php $i = 1; ?>
            <?php foreach ($slideshow->result() as $slide){ ?>
            <div class="item <?php echo $i == 1 ? 'active':'';?>">
               <img src="<?php echo base_URL()."timthumb?src=/upload/galeri/".$slide->file;?>&w=960&h=400&zc=0" alt="" style="height: 400px;width:960px">
               <div class="carousel-caption">
                  <h4><?php echo strtoupper($slide->judul);?></h4>
                  <p><?php echo ucwords($slide->ket);?></p>
               </div>
            </div>   
            <?php $i++;} ?>
            <!--
            <div class="item">
               <img src="<?php echo base_URL()?>upload/karosel/2.jpg" alt="" style="height: 400px">
               <div class="carousel-caption">
                  <h4>Pejabat Dinas Pendidikan Provinsi Jambi</h4>
                  <p>Foto Kepala Balai dan Sekertaris Dinas Pendidikan</p>
               </div>
            </div>
            <div class="item">
               <img src="<?php echo base_URL()?>upload/karosel/3.jpg" alt="" style="height: 400px">
               <div class="carousel-caption">
                  <h4>KUNKER DPR RI</h4>
                  <p>Kunjungan Kerja DPR RI Di Aula Rumah Gubernur Jambi</p>
               </div>
            </div>
            -->
         </div>
         <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
         <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
         
         <div class="marquee">Selamat Datang Pada Website Resmi Dinas Pendidikan Provinsi Jambi</div>
         
      </div>
      
      
      
      <div class="row-fluid" style="padding-top:10px">
      <div class="span3">
         <div class="wellwhite sidebar-nav">
            <ul class="nav nav-list">
               <li class="nav-header" style="">Interaktif Menu</li>
               <!--<li><a href="<?php echo base_URL()?>tampil/blog">Berita</a></li>
               <li><a href="<?php echo base_URL()?>tampil/galeri">Galeri</a></li>-->
               <li><a href="<?php echo base_URL()?>tampil/bukutamu">Kontak Kami</a></li>
               <li><a href="<?php echo base_URL()?>tampil/ide_saran">Ide & Saran</a></li>
               <li><a href="<?php echo base_URL()?>tampil/ekspresi">Ekspresi</a></li>
            </ul>
         </div>
         <!--/.well -->
         <?php 
            if ($this->session->userdata('siswa_validated') != FALSE && $this->session->userdata('siswa_id') != "") {
            ?>
         <div class="wellwhite sidebar-nav">
            <ul class="nav nav-list">
               <li class="nav-header" style="">Status Login Siswa</li>
               <li>Anda telah login, dengan username : "<b><?php echo $this->session->userdata('siswa_nis'); ?> (<?php echo $this->session->userdata('siswa_nama'); ?>)</b>"</li>
               <li><a href="<?php echo base_URL()?>tampil/logout_siswa">Logout</a></li>
            </ul>
         </div>
         <?php 
            } else {
            ?>
         <?php 
            } 
            ?>
         <!--
         <div class="wellwhite sidebar-nav">
            <ul class="nav nav-list">
               <li class="nav-header" style="">Agenda</li>
               <?php
                  $q_link	= $this->db->query("SELECT * FROM agenda WHERE MID(tgl, 6, 2) = MONTH(NOW())")->result();
                  
                  if (empty($q_link)) {
                  	echo "<p>Tidak ada agenda kegiatan di bulan ini</p>";
                  } else {
                  	foreach($q_link as $ql) {
                ?>
               <p>
               	  <b><?php echo tgl_panjang($ql->tgl, "lm")?></b><br>
                  <?php echo $ql->ket?> di <?php echo $ql->tempat?>
               </p>
               <?php 
                    }
                  }
                  ?>
            </ul>
         </div>
         -->
         <!--/.well -->
         <div class="wellwhite sidebar-nav">
         <ul class="nav nav-list">
               <li class="nav-header" style="">Agenda</li>               
            </ul>
         <div id="eventCalendarHumanDate"></div>
            
         </div>
         <!--/.well -->
         <div class="span12">
            <ul id="myTab" class="nav nav-tabs">
               <li><a href="#poll" data-toggle="tab">Poll</a></li>
               <li class="active"><a href="#home" data-toggle="tab">Popular</a></li>
               <li><a href="#profile" data-toggle="tab">Tags</a></li>
            </ul>
            <div id="myTabContent" class="tab-content wellwhite" style="margin-top: -21px">
               <div class="tab-pane fade in active" id="home">
                  <p>
                  <ul class="nav-list" style="margin-left: 0px">
                     <?php
                        $q_berita_populer	= $this->db->query("SELECT * FROM berita ORDER BY hits DESC LIMIT 5")->result();
                        
                        foreach ($q_berita_populer as $d1) {
                        	echo "<li><a href='".base_URL()."tampil/blog/baca/".$d1->id."/".getURLFriendly($d1->judul)."'>".$d1->judul."</a></li>";
                        
                        }				
                        ?>
                  </ul>
                  </p>
               </div>
               <div class="tab-pane fade" id="profile">
                  <p>
                  <ul class="nav-list" style="margin-left: 0px">
                     <?php
                        $q_berita_tag	= $this->db->query("SELECT kat.id, kat.nama AS nama, COUNT(kategori) AS jml FROM berita, kat WHERE berita.kategori = kat.id GROUP BY kat.nama ORDER BY jml DESC")->result();
                        
                        foreach ($q_berita_tag as $d2) {
                        	echo "<li><a href='".base_URL()."tampil/kategori/".$d2->id."'>".$d2->nama." (".$d2->jml.")</a></li>";
                        
                        }				
                        ?>
                  </ul>
                  </p>
               </div>
               <div class="tab-pane fade" id="poll">
                  <p>
                  <form action="<?php echo base_URL()?>tampil/post_poll" method="post">
                     <?php 
                        $poll = $this->db->query("SELECT * FROM poll ORDER BY id DESC LIMIT 1")->row();
                        ?>
                     <h4 class="poll-title"><?php echo $poll->tanya?></h4>
                     <input type="hidden" name="id_poll" value="<?php echo $poll->id?>">
                     <label><input type="radio" value="1" name="poll" id="satu" required> <?php echo $poll->op_1?></label>
                     <label><input type="radio" value="2" name="poll" id="dua" required> <?php echo $poll->op_2?></label>
                     <label><input type="radio" value="3" name="poll" id="tiga" required> <?php echo $poll->op_3?></label>
                     <label><input type="radio" value="4" name="poll" id="empat" required> <?php echo $poll->op_4?></label>
                     <input type="submit" class="btn btn-primary" value="Kirim"> &nbsp;&nbsp; <input type="button" value="Lihat Hasil" class="btn btn-primary" onclick="window.open('<?php echo base_URL()?>tampil/hasil_poll', '_self')">
                  </form>
                  </p>
               </div>
            </div>
         </div>
      </div>

