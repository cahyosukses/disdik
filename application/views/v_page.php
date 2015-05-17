<?php 
   $fb_fanpage     = $this->basecrud_m->get_where('settings',array('title' => 'fb_fanpage'))->row()->value;
   $running_text   = $this->basecrud_m->get_where('settings',array('title' => 'running_text'))->row()->value;
   $header_img     = $this->basecrud_m->get_where('settings',array('title' => 'header_img'))->row()->value;
   $header_type    = $this->basecrud_m->get_where('settings',array('title' => 'header_img'))->row()->tipe;
   $background_img = $this->basecrud_m->get_where('settings',array('title' => 'background_img'))->row()->value;
?>

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
      <link href="<?php echo base_URL()?>assets/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"  media="screen" />

      <link rel="stylesheet" type="text/css" href="<?php echo base_URL()?>assets/lofslider/css/layout.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_URL()?>assets/lofslider/css/layout-rtl.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_URL()?>assets/lofslider/css/style3.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_URL()?>assets/lofslider/css/style3-rtl.css" />
      

      <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <!-- Le fav and touch icons -->
      <style type="text/css">
         body {
             padding-top: 10px;
             padding-bottom: 40px;
             background-image: url("<?php echo base_URL() . 'timthumb?src=/upload/' . $background_img?>&w=250&h=250&zc=0");
          }

         ul.lof-main-wapper li {
            position:relative;   
         }  

         #ahgallery01 {
            margin-left: 0px;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
            width: 530px;
         }
         #ahgallery01 ul.hover_block0, #ahgallery01 ul.hover_block1, #ahgallery01 ul.hover_block2 {
            display: block;
            overflow: hidden;
            height: 1%;
            padding-top: 0px;
            padding-left: 0px;
            /*background: black;*/
            margin-left: 0px;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
         }
         #ahgallery01 ul.bottom_block {
            padding-bottom: 0px ;
         }
         #ahgallery01 ul.hover_block0 li.ahitem, #ahgallery01 ul.hover_block1 li.ahitem, #ahgallery01 ul.hover_block2 li.ahitem {
            margin-left: 0;
            padding-left: 0;
            list-style:none;
            list-style-position: inside;
            float:left;
            /*background: black;*/
            width: 170px;
            position: relative;
         }
         #ahgallery01 ul.hover_block0 li a.teaser, #ahgallery01 ul.hover_block1 li a.teaser , #ahgallery01 ul.hover_block2 li a.teaser{
            display: block;
            position: relative;
            overflow: hidden;
            height: 213px;
            width: 138px;
            padding: 16px;
         }
         #ahgallery01 ul.hover_block0 li div.teaser, #ahgallery01 ul.hover_block1 li div.teaser , #ahgallery01 ul.hover_block2 li div.teaser {
            display: block;
            position: relative;
            overflow: hidden;
            height: 213px;
            width: 138px;
            padding: 16px;
         }
         #ahgallery01 ul.hover_block0 li img.overlay, #ahgallery01 ul.hover_block1 li img.overlay, #ahgallery01 ul.hover_block2 li img.overlay {
            margin: 0;
            position: absolute;
            top: 0px;
            left: 0;
            border: 0;
         }
      </style>

      <link rel="shortcut icon" href="<?php echo base_URL()?>/favicon.ico">
      <script src="<?php echo base_URL()?>assets/swfobject/swfobject.js"></script>

      <?php if(isset($show_map)){ ?>
      <script  src="http://maps.googleapis.com/maps/api/js"></script>      
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
      $l_val   = array("", "blog", "portofolio", "download", "bukutamu");
      $l_view  = array("Beranda", "Blog", "Portofolio", "Download", "Contact");
   ?>
   <body>
      <div class="container well" style="width: 1100px">
      <?php if($header_type === 'image'){ ?>      
         <img src="<?php echo base_URL() . "timthumb?src=/upload/". $header_img;?>&w=1100&h=100&zc=0" style="width: 1100px; height: 100px; display: inline; margin: -5px 0 5px 0">
      <?php }else{ ?>
           <script type="text/javascript">
             var flashvars = {};
             var params = {};
             params.scale = "exactfit";
             var attributes = {};
             swfobject.embedSWF("<?php echo base_url() . 'upload/' . $header_img;?>", "header_image", "1100", "150", "9.0.0", false,flashvars,params,attributes);
           </script>
           <div id="header_image">
             <h1>Alternative content</h1>
             <p><a href="http://www.adobe.com/go/getflashplayer">
              <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
                </a>
             </p>
           </div>
      <?php } ?>
         
         <!--<h3 style="margin: -120px 0 20px 90px; font-family: Georgia; font-size: 30px">Dinas Pendidikan Provinsi Jambi</h3>-->
         <br>
         <!--<small style="font-family: Times New Roman; font-size: 17px; margin: -40px 0 0 90px; display: inline; position: absolute">Alamat : Jl. Jend. A. Yani No.06 Telanaipura Jambi. Telp. (0741) 63197 Fax. (0741) 63197</small>-->
         <div style="margin: -35px 0px 0px 1070px; display: inline; position: absolute" class="pull-right">
            <a href="<?php echo $fb_fanpage;?>" target="_BLANK"><img src="<?php echo base_URL() . 'upload/galeri/facebook.png'?>"></a> 
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
                     <a data-toggle="dropdown" href="#" class="dropdown-toggle depan">Program &nbsp;&nbsp;<b class="caret"></b></a>     
                     <ul class="dropdown-menu">
                        <?php 
                           $q_menu_program = $this->db->query("SELECT id, judul FROM program")->result();
                           foreach ($q_menu_program as $prog) {
                           ?>
                        <li><a href="<?php echo base_URL()?>tampil/program/<?php echo $prog->id?>/<?php echo getURLFriendly($prog->judul)?>"><?php echo $prog->judul?></a></li>
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
                  <li><a href="<?php echo base_URL()?>tampil/opini" class="depan">Pojok Opini</a></li>
                  <li class="dropdown">
                     <a data-toggle="dropdown" href="#" class="dropdown-toggle depan">Galeri &nbsp;&nbsp;<b class="caret"></b></a>     
                     <ul class="dropdown-menu">
                        <li><a href="<?php echo base_URL()?>tampil/galeri" class="depan">Album Foto</a></li>
                        <li><a href="<?php echo base_URL()?>tampil/galeri_video" class="depan">Album Video</a></li>
                     </ul>
                  </li>
               </ul>
               <form class="navbar-form pull-right" method="post" action="<?php echo base_URL()?>tampil/cari">
                  <input type="text" class="span2" name="q" value="<?php echo $this->input->post('q')?>">
                  <button type="submit" class="btn">Cari</button>
               </form>
            </div>
         </div>
         <div style="height:300px">
            <?php $slideshow = $this->basecrud_m->get_where('berita',array('slideshow' => 'Y','publish' => '1'));?>
            <div id="jslidernews3" class="lof-slidecontent" style="width:1100px; height:300px;">
            <div class="preload">
               <div></div>
            </div>
            <div  class="button-previous">Previous</div>
               <?php $gal_slideshow = $this->basecrud_m->get_where('galeri',array('slideshow' => 'Y'));?>

               <div class="main-slider-content" style="width:1100px; height:300px;">
                  <ul class="sliders-wrap-inner">
                     <?php foreach ($slideshow->result() as $sl_u){ ?>
                     <li>
                        <img src="<?php echo base_URL()."timthumb?src=/upload/post/".$sl_u->gambar;?>&w=785&h=300&zc=0" alt="" style="height: 300px;width:785px" title="Newsflash 2" >           
                        <div class="slider-description">
                           <div class="slider-meta"><a target="_parent" title="Newsflash 1" href=""><i><?php echo tgl_panjang($sl_u->tglPost,'lm',true);?></i></a> </div>
                           <h4><?php echo strtoupper($sl_u->judul);?></h4>
                           <p>
                              <a class="readmore" href="<?php echo base_URL() . 'tampil/blog/baca/' . $sl_u->id . '/' . getURLFriendly($sl_u->judul)?>"><?php echo  strip_tags(substr($sl_u->isi,0,100)) . '...'?> [ Baca ]</a>
                           </p>
                        </div>
                     </li>
                     <?php } ?>

                     <?php foreach ($gal_slideshow->result() as $gl_u){ ?>
                     <li>
                        <img src="<?php echo base_URL()."timthumb?src=/upload/galeri/".$gl_u->file;?>&w=785&h=300&zc=0" alt="" style="height: 300px;width:785px" title="Newsflash 2" >           
                        <div class="slider-description">                           
                           <h3><?php echo strtoupper($gl_u->judul);?></h3>
                           <h4><?php echo strtoupper($gl_u->ket);?></h4>                           
                        </div>
                     </li>
                     <?php } ?>

                  </ul>
               </div>
               <!-- END MAIN CONTENT --> 
               <!-- NAVIGATOR -->
               <div class="navigator-content">
                  <div class="navigator-wrapper">
                     <ul class="navigator-wrap-inner">
                        <?php foreach ($slideshow->result() as $sl_p){ ?>
                        <li>
                           <div>
                              <img src="<?php echo base_URL()."timthumb?src=/upload/post/".$sl_p->gambar;?>&w=68&h=68&zc=0" alt="" style="height: 68px;width:68px" />
                              <h5> <?php echo strtoupper($sl_p->judul);?> </h5>
                              <span><?php echo tgl_panjang($sl_p->tglPost,'sm',true);?></span> - <?php echo strip_tags(substr($sl_p->isi,0,50)) . '...'?>
                           </div>
                        </li>
                        <?php } ?>                        
                        
                        <?php foreach ($gal_slideshow->result() as $gl_u){ ?>
                        <li>
                           <div>
                              <img src="<?php echo base_URL()."timthumb?src=/upload/galeri/".$gl_u->file;?>&w=68&h=68&zc=0" alt="" style="height: 68px;width:68px" />
                              <h5> <?php echo strtoupper($gl_u->judul);?> </h5>
                              <?php echo strip_tags(substr($gl_u->ket,0,50)) . '...'?>
                           </div>
                        </li>
                        <?php } ?>   
                     </ul>
                  </div>
               </div>
               
               <div class="button-next">Next</div>
            </div>
            
         </div>
         <div class="marquee"><?php echo $running_text;?></div>
         <!--
         <div id="myCarousel" class="carousel slide" style="height: 400px">
            
            <div class="carousel-inner">
               <?php $slideshow = $this->basecrud_m->get_where('berita',array('slideshow' => 'Y'));?>
               <?php $i = 1; ?>
               <?php foreach ($slideshow->result() as $slide){ ?>
               <div class="item <?php echo $i == 1 ? 'active':'';?>">
                  <img src="<?php echo base_URL()."timthumb?src=/upload/post/".$slide->gambar;?>&w=960&h=400&zc=0" alt="" style="height: 400px;width:960px">
                  <div class="carousel-caption">                     
                     <h4><a href="<?php echo base_URL() . 'tampil/blog/baca/' . $slide->id . '/' . getURLFriendly($slide->judul)?>"><?php echo strtoupper($slide->judul);?></a></h4>
                  </div>
               </div>
               <?php $i++;} ?>
               
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>

         </div>
-->
            
         <div class="row-fluid" style="padding-top:10px">
            <div class="span3">
               <div class="wellwhite sidebar-nav">
                  <ul class="nav nav-list">
                     <li class="nav-header" style=""><i class="icon-list"></i>Interaktif Menu</li>
                     <!--<li><a href="<?php echo base_URL()?>tampil/blog">Berita</a></li>-->
                     <li><a href="<?php echo base_URL()?>tampil">Berita</a></li>
                     <li><a href="<?php echo base_URL()?>tampil/bukutamu">Kontak Kami</a></li>
                     <li><a href="<?php echo base_URL()?>tampil/ide_saran">Ide & Saran</a></li>
                     <li><a href="<?php echo base_URL()?>tampil/ekspresi">Ekspresi</a></li>
                     <!--<li><a href="<?php echo base_URL()?>tampil/aduan">Aduan</a></li>
                     <li><a href="<?php echo base_URL()?>tampil/apresiasi">Apresiasi</a></li>
                     -->
                  </ul>
               </div>
               <!--/.well -->
               <!-- pengumuman -->
               <div class="wellwhite sidebar-nav">
                  <ul class="nav nav-list">
                     <li class="nav-header" style=""><i class="icon-bullhorn"></i>Pengumuman</li>
                  </ul>
                  <div id="box-pengumuman">
                     <div class="panel panel-default">
                        <div class="panel-body">
                           <div class="row-fluid">
                              <div class="span12">
                                 <ul class="pengumuman">
                                    <?php $p = $this->db->query("SELECT * FROM pengumuman WHERE publish = 'Y' ORDER BY tglPost DESC LIMIT 10");?>
                                    <?php if($p->num_rows() == 0){ ?>
                                    <li class="news-item">
                                       <span class="label label-default">
                                       <span class="icon-time"></span>                                       
                                       00:00:00
                                       </span><br>
                                       <a href="" title="Belum Ada Data Pengumuman">Belum Ada Data Pengumuman</a>
                                    </li>
                                    <?php }else{ ?>
                                    <?php foreach ($p->result() as $p_list){ ?>
                                    <li class="news-item">
                                       <span class="label label-default">
                                       <span class="icon-time"></span>
                                       <?php echo tgl_panjang($p_list->tglPost,'sm');?></span><br>
                                       <a href="<?php echo base_URL() . 'tampil/pengumuman/detail/' . $p_list->id;?>" title="<?php echo $p_list->judul;?>"><?php echo substr($p_list->judul,0,30) . '...';?></a>
                                    </li>
                                    <?php } ?>     
                                    <?php } ?>                            
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="panel-footer">
                           <a button href="<?php echo base_URL() . 'tampil/pengumuman';?>" type="button" class="btn btn-success btn-small" data-toggle="tooltip" data-placement="right" title="Klik untuk pengumuman lainya">
                              <i class="icon-th-list"></i> Index Pengumuman
                           </a>
                        </div>
                     </div>
                  </div>
               </div>


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
                     $q_link  = $this->db->query("SELECT * FROM agenda WHERE MID(tgl, 6, 2) = MONTH(NOW())")->result();
                     
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
                     <li class="nav-header" style=""><i class="icon-calendar"></i>Agenda</li>
                  </ul>
                  <div id="eventCalendarHumanDate"></div>
               </div>
               <!--/.well -->
               <div class="span12">
                  <ul id="myTab" class="nav nav-tabs">
                     <li><a href="#poll" data-toggle="tab">Berita Terbaru</a></li>
                     <li class="active"><a href="#home" data-toggle="tab">Popular</a></li>
                     <li><a href="#profile" data-toggle="tab">Tags</a></li>
                  </ul>
                  <div id="myTabContent" class="tab-content wellwhite" style="margin-top: -21px">
                     <div class="tab-pane fade in active" id="home">
                        <p>
                        <ul class="nav-list" style="margin-left: 0px">
                           <?php
                              $q_berita_populer = $this->db->query("SELECT * FROM berita ORDER BY hits DESC LIMIT 5")->result();
                              
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
                              $q_berita_tag  = $this->db->query("SELECT kat.id, kat.nama AS nama, COUNT(kategori) AS jml FROM berita, kat WHERE berita.kategori = kat.id GROUP BY kat.nama ORDER BY jml DESC")->result();
                              
                              foreach ($q_berita_tag as $d2) {
                                 echo "<li><a href='".base_URL()."tampil/kategori/".$d2->id."'>".$d2->nama." (".$d2->jml.")</a></li>";
                              
                              }           
                              ?>
                        </ul>
                        </p>
                     </div>
                     <div class="tab-pane fade" id="poll">
                        <p>
                        <!--
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
                        -->
                        
                        <ul class="nav-list" style="margin-left: 0px">
                           <?php
                              $q_berita_populer = $this->db->query("SELECT * FROM berita ORDER BY tglPost DESC LIMIT 5")->result();
                              
                              foreach ($q_berita_populer as $d1) {
                                 echo "<li><a href='".base_URL()."tampil/blog/baca/".$d1->id."/".getURLFriendly($d1->judul)."'>".$d1->judul."</a></li>";
                              
                              }           
                              ?>
                        </ul>
                        
                        </p>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="span9">
            <?php
               $page_name .= ".php";
               include $page_name;
            ?>
            </div>
            <!--
            <div class="span3">

               
               <div class="wellwhite sidebar-nav">
                  <ul class="nav nav-list">
                     <li class="nav-header" style=""><i class="icon-bullhorn"></i>Pojok Aduan</li>
                  </ul>
                  <div id="box-pengumuman" style="border-bottom-color:#BD362F">
                     <div class="panel panel-default">
                        <div class="panel-body">
                           <div class="row-fluid">
                              <div class="span12">
                                 <ul class="aduan">
                                    <?php $ad = $this->db->query("SELECT * FROM aduan WHERE tampil = 'Y' ORDER BY inserted_at DESC LIMIT 10");?>
                                    <?php if($ad->num_rows() == 0){ ?>
                                    <li class="news-item">
                                       <span class="label label-default">
                                       <span class="icon-time"></span>                                       
                                       00:00:00
                                       </span><br>
                                       <a href="" title="Belum Ada Data Pengumuman">Belum Ada Data Pengaduan</a>
                                    </li>
                                    <?php }else{ ?>
                                    <?php foreach ($ad->result() as $ad_list){ ?>
                                    <li class="news-item">
                                       <span class="label label-default">
                                       <span class="icon-time"></span>
                                       <?php echo tgl_panjang($ad_list->inserted_at,'sm');?></span><br>
                                       <a href="#info-aduan" data-toggle="modal" onclick="get_aduan_apresiasi(0,'aduan',<?php echo $ad_list->id;?>)">
                                          <?php echo substr($ad_list->topik,0,30) . '...';?>
                                       </a>
                                    </li>
                                    <?php } ?>     
                                    <?php } ?>                            
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="panel-footer">
                           <a button href="<?php echo base_URL() . 'tampil/aduan';?>" type="button" class="btn btn-danger btn-small" data-toggle="tooltip" data-placement="right" title="Klik untuk pengaduan lainya">
                              <i class="icon-th-list"></i> Index Pengaduan
                           </a>
                        </div>
                     </div>
                  </div>
                  
                  <div class="modal hide fade" id="info-aduan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="static"  aria-hidden="true" style="display: none">
                      <div class="modal-header" style="padding: 0px 10px 0px 5px;">
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         <h4 id="myModalLabel">Detail Pengaduan</h4>
                      </div>
                      <div class="modal-body">
                        <table class="table table-hover table-condensed" style="font-size: 80%">           
                            <tbody id="tabel-aduan">
                              <tr>
                                <td style="width:100px">Topik Aduan</td> 
                                <td>{TOPIK}</td>   
                              </tr>            
                              <tr>
                                <td>Nama Pengirim</td> 
                                <td>{NAMA_PENGADU}</td>   
                              </tr>            
                              <tr>
                                 <td>Judul Program</td>     
                                 <td>{JUDUL_PROGRAM}</td>   
                              </tr>
                              <tr>
                                 <td>Stasiun Program</td>   
                                 <td>{STASIUN_PROGRAM}</td>   
                              </tr>
                              <tr>
                                 <td>Pesan Aduan</td>
                                 <td>{INI ADALAH PESAN YANG saaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaangaaaat panjang sekali}</td>   
                              </tr>
                            </tbody>
                          </table>
                      </div>    
                 </div>

               </div>
               
               
               <div class="wellwhite sidebar-nav">
                  <ul class="nav nav-list">
                     <li class="nav-header" style=""><i class="icon-bullhorn"></i>Ruang Apresiasi</li>
                  </ul>
                  <div id="box-pengumuman"  style="border-bottom-color:#2F96B4">
                     <div class="panel panel-default">
                        <div class="panel-body">
                           <div class="row-fluid">
                              <div class="span12">
                                 <ul class="apresiasi">
                                    <?php $ap = $this->db->query("SELECT * FROM apresiasi WHERE tampil = 'Y' ORDER BY inserted_at DESC LIMIT 10");?>
                                    <?php if($ap->num_rows() == 0){ ?>
                                    <li class="news-item">
                                       <span class="label label-default">
                                       <span class="icon-time"></span>                                       
                                       00:00:00
                                       </span><br>
                                       <a href="" title="Belum Ada Data Apresiasi">Belum Ada Data Apresiasi</a>
                                    </li>
                                    <?php }else{ ?>
                                    <?php foreach ($ap->result() as $ap_list){ ?>
                                    <li class="news-item">
                                       <span class="label label-default">
                                       <span class="icon-time"></span>
                                       <?php echo tgl_panjang($ap_list->inserted_at,'sm');?></span><br>
                                       <a href="#info-apresiasi" data-toggle="modal" onclick="get_aduan_apresiasi(0,'apresiasi',<?php echo $ap_list->id;?>)">
                                          <?php echo substr($ap_list->topik,0,30) . '...';?>
                                       </a>
                                    </li>
                                    <?php } ?>     
                                    <?php } ?>                            
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="panel-footer">
                           <a button href="<?php echo base_URL() . 'tampil/apresiasi';?>" type="button" class="btn btn-info btn-small" data-toggle="tooltip" data-placement="right" title="Klik untuk apresiasi lainya">
                              <i class="icon-th-list"></i> Index Apresiasi
                           </a>
                        </div>
                     </div>
                  </div>
                  
                  <div class="modal hide fade" id="info-apresiasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="static"  aria-hidden="true" style="display: none">
                      <div class="modal-header" style="padding: 0px 10px 0px 5px;">
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         <h4 id="myModalLabel">Detail Apresiasi</h4>
                      </div>
                      <div class="modal-body">
                        <table class="table table-hover table-condensed" style="font-size: 80%">           
                            <tbody id="tabel-apresiasi">
                              <tr>
                                <td style="width:100px">Topik Aduan</td> 
                                <td>{TOPIK}</td>   
                              </tr>            
                              <tr>
                                <td>Nama Pengirim</td> 
                                <td>{NAMA_PENGADU}</td>   
                              </tr>            
                              <tr>
                                 <td>Judul Program</td>     
                                 <td>{JUDUL_PROGRAM}</td>   
                              </tr>
                              <tr>
                                 <td>Stasiun Program</td>   
                                 <td>{STASIUN_PROGRAM}</td>   
                              </tr>
                              <tr>
                                 <td>Pesan Aduan</td>
                                 <td>{INI ADALAH PESAN YANG saaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaangaaaat panjang sekali}</td>   
                              </tr>
                            </tbody>
                          </table>
                      </div>    
                 </div>

               </div>

            </div>
            -->   
            <div class="span12" style="margin-left: 5px">
               <div class="span6 wellwhite">
                  <div class="span12">
                     <legend>Galeri Foto</legend>
                     <!--
                     <?php 
                        $q_galeri_depan = $this->db->query("SELECT * FROM galeri_video ORDER BY RAND() DESC LIMIT 8")->result();
                        
                        foreach($q_galeri_depan as $qg){ ?>
                     <a class="various fancybox.iframe" href="http://www.youtube.com/embed/<?php echo $qg->video_id;?>?autoplay=1" title="<?php echo strtoupper($qg->judul)?>">
                        <img class="span3 image-polaroid" src="<?php echo base_URL()."timthumb?src=http://img.youtube.com/vi/". $qg->video_id ."/0.jpg";?>&w=99&h=70&zc=0" style="height: 70px; margin: 0 8px 10px 0">
                     </a>
                     <?php } ?>
                    -->
                     
                     
                     <?php 
                        $q_galeri_depan = $this->db->query("SELECT * FROM galeri ORDER BY RAND() DESC LIMIT 8")->result();
                        
                        foreach($q_galeri_depan as $qg){ ?>
                        <a class="fancybox" href="<?php echo base_URL()."upload/galeri/".$qg->file;?>" data-fancybox-group="gallery" title="<?php echo strtoupper($qg->judul)?>">
                           <img class="span3 image-polaroid" src="<?php echo base_URL()."timthumb?src=/upload/galeri/".$qg->file;?>&w=99&h=70&zc=0" style="height: 70px; margin: 0 8px 10px 0">
                        </a>
                     <?php } ?>
                     
                  </div>
               </div>
               <div class="span3 wellwhite">
                  <legend>Tautan</legend>
                  <ul>
                     <?php 
                        $q_link  = $this->db->query("SELECT * FROM link LIMIT 10")->result();
                        foreach ($q_link as $ql) {
                        ?>
                     <li><a style="font-size: 12px" href="<?php echo $ql->alamat?>" target="blank"><?php echo $ql->nama?></a></li>
                     <?php 
                        }
                        ?>
                  </ul>
               </div>
               <div class="span3 wellwhite">
                  <legend>Statistik Situs</legend>
                  <ul>
                     <?php $current_date = date('Y-m-d');?> 
                     <?php $hari_ini = $this->db->query("SELECT COUNT(*) as jml FROM view_stats WHERE DATE(tgl) = '$current_date'")->row();?>
                     <?php $bulan_ini = $this->db->query("SELECT COUNT(*) as jml FROM view_stats WHERE YEAR(tgl) = YEAR(NOW()) AND MONTH(tgl) = MONTH(NOW())")->row();?>
                     <?php $total = $this->db->query("SELECT COUNT(*) as jml FROM view_stats")->row();?>
                     <li>IP Anda : <?php echo $this->input->ip_address(); ?></li>
                     <li>Hari : <?php echo $hari_ini->jml;?> Views</li>
                     <li>Bulan : <?php echo $bulan_ini->jml;?> Views</li>
                     <li>Total : <?php echo $total->jml;?> Views</li>
                  </ul>
               </div>
            </div>

            <div class="span12 wellwhite" style="margin-left: 5px">
               <div class="span3" style="text-align:center">
                  <img src="<?php echo base_URL();?>upload/logo_footer_kiri.png" alt="logo kota jambi" height="100" width="100">
                  <div style="margin-top:10px">
                     <h5>Dinas Pendidikan Kota Jambi</h5>
                     Jl.Jendral Ahmad Yani No 06 <br>
                     Telanaipura Jambi <br>
                     Telp (0741) 63197 <br>
                     Faks (0741) 63197
                  </div>
               </div>
               <div class="span3">
                  <font style="color:#00acee; font-weight:bold; text-align:left; margin-left:20px;">PROFILE</font>      
                  <ul>
                    <?php 
                     $q_menu_profil = $this->db->query("SELECT id, judul FROM profil")->result();
                     foreach ($q_menu_profil as $mp) {
                     ?>
                     <li><a href="<?php echo base_URL()?>tampil/profil/<?php echo $mp->id?>/<?php echo getURLFriendly($mp->judul)?>"><?php echo $mp->judul?></a></li>
                     <?php
                     }
                     ?>
                  </ul>
               </div>
               <div class="span3">
                  <font style="color:#00acee; font-weight:bold; text-align:left; margin-left:20px;">PROGRAM</font>      
                  <ul>
                    <?php 
                     $q_menu_program = $this->db->query("SELECT id, judul FROM program")->result();
                     foreach ($q_menu_program as $footer_prog) {
                     ?>
                     <li><a href="<?php echo base_URL()?>tampil/program/<?php echo $footer_prog->id?>/<?php echo getURLFriendly($footer_prog->judul)?>"><?php echo $footer_prog->judul?></a></li>
                     <?php
                     }
                     ?>
                  </ul>
               </div>
               <div class="span3">
                  <font style="color:#00acee; font-weight:bold; text-align:left; margin-left:20px;">PRODUK HUKUM</font>      
                  <ul>
                    <?php 
                     $q_menu_ph = $this->db->query("SELECT id, judul FROM data_produk_hukum")->result();
                     foreach ($q_menu_ph as $footer_ph) {
                     ?>
                     <li><a href="<?php echo base_URL()?>tampil/data_produk_hukum/<?php echo $footer_ph->id?>/<?php echo getURLFriendly($footer_ph->judul)?>"><?php echo $footer_ph->judul?></a></li>
                     <?php
                     }
                     ?>
                  </ul>
               </div>
               <!--
               <div class="span6">
                  <font style="color:#00acee; font-weight:bold; text-align:left; margin-left:20px;">NEWSLETTER</font>      
                  <div id="ahgallery01">
                     <ul class="hover_block0 bottom_block">                       
                        <?php $newsletter = $this->basecrud_m->get('newsletter');?>
                        <?php foreach ($newsletter->result() as $nwsl) { ?>
                        <li class="ahitem">
                           <a class="teaser" style="font-weight: normal; text-decoration: none;" href="<?php echo base_URL() . 'tampil/download_file/newsletter/' . $nwsl->id;?>" target="_blank">
                              <img class="overlay" src="<?php echo base_URL() . 'timthumb?src=/upload/' . $nwsl->img;?>&w=170&h=245&zc=0" alt="" />
                              <span style="color:grey; font-size: 18px; font-weight: bold; line-height: 20px; margin-left: 10px; font-family: arial; margin-bottom: 0.5em; margin-top: 0.5em;"><?php echo $nwsl->judul;?></span>
                              <br />                     
                              <span style="display: block; font-size: 12px; font-weight: normal; margin-left: 10px; font-family: arial; margin-bottom: 0.5em; margin-top: 0.5em;"><?php echo $nwsl->keterangan;?></span>
                           </a>
                        </li>   
                        <?php } ?>
                     </ul>
                  </div> 
               </div>
               -->
            </div>
         </div>
         <!--/row-->
         <hr>
         <a href="#" class="back-to-top">Back to Top</a>
         <footer>
            <div>
               <center>Loaded in : {elapsed_time}. &copy; Dinas Pendidikan @ 2015</center>
            </div>
         </footer>
      </div>
      <!--/.fluid-container-->
      <!-- Le javascript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="<?php echo base_URL()?>assets/js/jquery.js"></script>
      
      
      <script language="javascript" type="text/javascript" src="<?php echo base_URL()?>assets/lofslider/js/jquery.easing.js"></script>
      <script language="javascript" type="text/javascript" src="<?php echo base_URL()?>assets/lofslider/js/script.js"></script>

      <script src="<?php echo base_URL()?>assets/js/jquery.marquee/jquery.marquee.min.js"></script>
      <script src="<?php echo base_URL()?>assets/js/news.box.js"></script>
      <script src="<?php echo base_URL()?>assets/calendar/jquery.eventCalendar.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-transition.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-alert.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-modal.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-dropdown.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-scrollspy.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-tab.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-tooltip.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-popover.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-button.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-collapse.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-carousel.js"></script>

      <script src="<?php echo base_URL()?>assets/js/bootstrap-typeahead.js"></script>
      <!--<script src="<?php echo base_URL()?>assets/js/bootstrap-typeahead.js"></script>
      <script src="<?php echo base_URL()?>assets/js/bootstrap-typeahead.js"></script>-->
      <script type="text/javascript" src="<?php echo base_URL()?>assets/fancybox/jquery.fancybox.js"></script>
      <script type="text/javascript" src="<?php echo base_URL()?>assets/fancybox/jquery.mousewheel.js"></script>
      <!--<script type="text/javascript" src="<?php echo base_URL()?>assets/js/jquery.flexslider-min.js"></script>-->
      
      <script type="text/javascript">
         $(document).ready(function() {
            
            var buttons = { previous:$('#jslidernews3 .button-previous') ,
                  next:$('#jslidernews3 .button-next') };
            $('#jslidernews3').lofJSidernews( { interval:5000,
                                    easing:'easeOutBounce',
                                    duration:1200,
                                    auto:true,                        
                                    mainWidth:1100,
                                    mainHeight:300,
                                    navigatorHeight  : 100,
                                    navigatorWidth    : 310,
                                    maxItemDisplay:3,
                                    buttons:buttons
                                    ,rtl:true} );     

            $('#ahgallery01 ul.hover_block0 li.ahitem').hover(function(){
               $(this).find('img.overlay').animate({top:'245px'},{queue:false,duration:500});
            }, function(){
               $(this).find('img.overlay').animate({top:'0px'},{queue:false,duration:500});
            });

            $(".fancybox").fancybox();

            $(".various").fancybox({
               maxWidth    : 800,
               maxHeight   : 600,
               fitToView   : false,
               width       : '70%',
               height      : '70%',
               autoSize    : false,
               closeClick  : false,
               openEffect  : 'none',
               closeEffect : 'none'
            });

            $('.marquee').marquee({
                //speed in milliseconds of the marquee
                duration: 20000,
                //gap in pixels between the tickers
                gap: 50,
                //time in milliseconds before the marquee will start animating
                delayBeforeStart: 0,
                //'left' or 'right'
                direction: 'left',
                //true or false - should the marquee be duplicated to show an effect of continues flow
                duplicated: false,
                pauseOnHover:true
            });
         
         
            $("#eventCalendarHumanDate").eventCalendar({
                 eventsjson: '<?php echo base_url() . 'tampil/generate_event_calendar'?>',
                 startWeekOnMonday: false,
                 jsonDateFormat: 'human',  // 'YYYY-MM-DD HH:MM:SS'
                 monthNames: [ "Januari", "Februari", "Maret", "April", "Mei", "juni","Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
                 dayNames: [ 'Minggu','Senen','Selasa','Rabu','Kamis','Jumat','Sabtu' ],
                 dayNamesShort: [ 'Ming','Sen','Sel','Rab', 'Kam','Jum','Sab' ],
                 txt_noEvents: "Tidak Ada Agenda",                        
                 txt_GoToEventUrl: "Lihat agenda",
                 txt_NextEvents: "Agenda selanjutnya:",
                 eventsLimit: 4
            });
         
         });
         
         $('.carousel').carousel({
            interval: 3000
         });
         
         $(function () {
            $('#myTab a:first').tab('show');
         
            $(".pengumuman").bootstrapNews({
               newsPerPage: 3,
               navigation: true,
               autoplay: true,
               direction:'up', // up or down
               animationSpeed: 'normal',
               newsTickerInterval: 3000, //4 secs
               pauseOnHover: true,
               onStop: null,
               onPause: null,
               onReset: null,
               onPrev: null,
               onNext: null,
               onToDo: null
            });
            
            $(".aduan").bootstrapNews({
               newsPerPage: 3,
               navigation: true,
               autoplay: true,
               direction:'up', // up or down
               animationSpeed: 'normal',
               newsTickerInterval: 3150, //4 secs
               pauseOnHover: true,
               onStop: null,
               onPause: null,
               onReset: null,
               onPrev: null,
               onNext: null,
               onToDo: null
            });

            $(".apresiasi").bootstrapNews({
               newsPerPage: 3,
               navigation: true,
               autoplay: true,
               direction:'up', // up or down
               animationSpeed: 'normal',
               newsTickerInterval: 3250, //4 secs
               pauseOnHover: true,
               onStop: null,
               onPause: null,
               onReset: null,
               onPrev: null,
               onNext: null,
               onToDo: null
            });
         
         });
         
         jQuery(document).ready(function() {
             var offset = 220;
             var duration = 500;
             jQuery(window).scroll(function() {
                 if (jQuery(this).scrollTop() > offset) {
                     jQuery('.back-to-top').fadeIn(duration);
                 } else {
                     jQuery('.back-to-top').fadeOut(duration);
                 }
             });
             
             jQuery('.back-to-top').click(function(event) {
                 event.preventDefault();
                 jQuery('html, body').animate({scrollTop: 0}, duration);
                 return false;
             })
         });
         

  
        function get_aduan_apresiasi(v_pdf,v_tipe,v_id){
            if(v_tipe === 'aduan'){
               $.get( "<?php echo base_url() . 'tampil/aduan_apresiasi_detail';?>",
                    { pdf : v_pdf,
                      id : v_id,
                      tipe : v_tipe }
               ).done(function( data ) {
                $('#tabel-aduan').html(data);
               })
            }else{
               $.get( "<?php echo base_url() . 'tampil/aduan_apresiasi_detail';?>",
                    { pdf : v_pdf,
                      id : v_id,
                      tipe : v_tipe }
               ).done(function( data ) {
                $('#tabel-apresiasi').html(data);
               })
            }     
        }

      </script>
   </body>
</html>

