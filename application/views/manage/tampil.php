<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Halaman Administrator - Admin Area!! </title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- Le styles -->
      <link href="<?php echo base_URL()?>assets/css/bootstrap.css" rel="stylesheet">
      <style type="text/css">
         body {
            padding-top: 60px;
            padding-bottom: 40px;
         }
         .sidebar-nav {
            padding: 9px 0;
         }

        input[type="checkbox"] {
            width: 13px;
            height: 13px;
            padding: 0;
            
            vertical-align: bottom;
            position: relative;
            top: -2px;
            
        }
      </style>
      <link href="<?php echo base_URL()?>assets/css/bootstrap-responsive.css" rel="stylesheet">
      <link href="<?php echo base_URL()?>assets/chosen_v1.3.0/chosen.css" rel="stylesheet">
      <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <!-- Fav and touch icons -->
      <link rel="shortcut icon" href="<?php echo base_URL()?>assets/ico/favicon.ico">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_URL()?>assets/ico/apple-touch-icon-144-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_URL()?>assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_URL()?>assets/ico/apple-touch-icon-72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" href="<?php echo base_URL()?>assets/ico/apple-touch-icon-57-precomposed.png">
      <script src="<?php echo base_URL()?>assets/js/jquery.js"></script>
      <script src="<?php echo base_URL()?>assets/swfobject/swfobject.js"></script>
   </head>
   <body style="background: #fff">
      <div class="navbar navbar-inverse navbar-fixed-top">
         <div class="navbar-inner">
            <div class="container-fluid">
               <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </a>
               <a class="brand" href="#">Administrator</a>
               <div class="nav-collapse collapse">
                  <ul class="nav">
                     <li class="active"><a href="<?php echo base_URL()?>manage">Home</a></li>
                     <li><a href="<?php echo base_URL()?>manage/blog">Posting Blog</a></li>
                     <li><a href="<?php echo base_URL()?>" target="_blank">Lihat Website</a></li>
                  </ul>
                  <div class="btn-group navbar-form pull-right" style="margin-right: 10px">
                     <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                     <b><?php echo $this->session->userdata('user')?></b>
                     <span class="caret"></span>
                     </a>
                     <ul class="dropdown-menu">
                        <li><a href="<?php echo base_URL()?>manage/passwod">Edit Profil</a></li>
                        <li><a href="<?php echo base_URL()?>manage/logout">Logout</a></li>
                     </ul>
                  </div>
               </div>
               <!--/.nav-collapse -->
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="row-fluid">
            <div class="span2">
               <div class="well sidebar-nav">
                  <ul class="nav nav-list">
                     <li class="nav-header">Administrator Menu</li>
                     <?php 
                     $menu_list = explode(',',$this->session->userdata('menu_list'));
                     $this->db->from('manage_menu');
                     $this->db->where('show','Y');    
                     $this->db->where_in('id',$menu_list);    
                      
                     $this->db->order_by('sort','ASC');
                     $menu = $this->db->get();

                     ?>
                     <?php foreach ($menu->result() as $mn){ 
                        
                        if ($this->uri->segment(2) === $mn->method) {
                            echo "<li class='active'><a href='".base_URL()."manage/".$mn->method."'>".$mn->name."</a></li>";
                          } else {
                            echo "<li><a href='".base_URL()."manage/".$mn->method."'>".$mn->name."</a></li>";
                          } 


                     } ?>

                     <!--
                     <?php
                        $l_val  = array("", "profil", "data_sekolah","data_produk_hukum","blog","kategori_berita", "komentar", "galeri", "bukutamu","ide_saran","ekspresi", "link", "agenda", "passwod");
                        $l_view = array("Beranda", "Profil","Data Sekolah","Produk Hukum", "Post Berita","Kategori Berita", "Komentar Berita", "Galeri Foto", "Buku Tamu","Ide & Saran","Ekspresi", "Link/Tautan", "Agenda", "Edit Admin");
                        
                        for ($i = 0; $i < sizeof($l_val); $i++) {
                          if ($this->uri->segment(2) == $l_val[$i]) {
                            echo "<li class='active'><a href='".base_URL()."manage/".$l_val[$i]."'>".$l_view[$i]."</a></li>";
                          } else {
                            echo "<li><a href='".base_URL()."manage/".$l_val[$i]."'>".$l_view[$i]."</a></li>";
                          }
                        }
                        
                        ?>
                     <li><a href="<?php echo base_URL()?>manage/logout" onclick="return confirm('Anda yakin akan LOGOUT dari halaman Admin ..?')"><b>Logout</b></a></li>
                     -->
                  </ul>
               </div>
               <!--/.well -->
            </div>
            
            <!--/span-->
            <div class="span10">
               <?php echo $this->load->view('manage/'.$page)?>
            </div>
            <!--/span-->

         </div>
         <!--/row-->
         <hr>
         <footer>
            Loaded in : {elapsed_time}. &copy; Dinas Pendidikan Provinsi Jambi</a> @ 2015
         </footer>
      </div>
      <!--/.fluid-container-->
      <!-- Le javascript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      
      <script src="<?php echo base_URL()?>assets/chosen_v1.3.0/chosen.jquery.js"></script>
      <script src="<?php echo base_URL();?>texteditor/tiny_mce/tiny_mce.js"></script>
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
      
      <!--<script src="<?php echo base_URL()?>assets/editor/nicEdit.js"></script>-->
      <script type="text/javascript">
         $(document).ready(function () {            
              var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
              for (var selector in config) {
                $(selector).chosen(config[selector]);
              }
          });
         
        jQuery(document).ready(function(){
          $('.fancybox').fancybox();
         });
         
        tinyMCE.init({
                mode : "exact",
                elements : "tinyMCE",
                theme : "advanced",
                plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,autoresize",
                theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,     
         
                //Mad File Manager        
                relative_urls : false,
                file_browser_callback : MadFileBrowser
          });
          
          function MadFileBrowser(field_name, url, type, win){    
              tinyMCE.activeEditor.windowManager.open({
                  file : "<?php echo base_url();?>texteditor/mfm.php?field=" + field_name + "&url=" + url + "",
                  title : 'File Manager',
                  width : 640,
                  height : 450,
                  resizable : "no",
                  inline : "yes",
                  close_previous : "no"
              }, {
                  window : win,
                  input : field_name
              });
              return false;
            }
         
         /*bkLib.onDomLoaded(function() { nicEditors.allTextAreas({fullPanel : true}) });*/
      </script>
   </body>
</html>