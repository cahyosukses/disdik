<!DOCTYPE html>
<html lang="en">
    <head>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/forum/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/forum/bootstrap/css/bootstrap-responsive.min.css"/>
    <link href="<?php echo base_URL()?>assets/chosen_v1.3.0/chosen.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/forum/bootstrap/js/jquery-1.7.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/forum/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/forum/jquery/jquery.slugit.js"></script>
    <script src="<?php echo base_URL();?>texteditor/tiny_mce/tiny_mce.js"></script>
    <script src="<?php echo base_URL()?>assets/chosen_v1.3.0/chosen.jquery.js"></script>

    <script type="text/javascript">
        tinyMCE.init({
                mode : "textareas",
                theme : "advanced",
                plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,autoresize",
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,|,insertdate,inserttime",
                theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr",
                theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                
                theme_advanced_resizing : false,     
         
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
    </script>
    </head>
    <body>            
        <div class="container-fluid">

            <br/>
            
            <div class="navbar" id="nav">
                <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="<?php echo site_url('forum/thread'); ?>"><b>Forum</b></a>
                    <div class="nav-collapse">
                    <ul class="nav">
                        <li><a href="<?php echo site_url('forum/thread'); ?>">Home</a></li>
                        <script>
                        $(function() {
                            $('#btn-new-thread').click(function() {
                                window.location = '<?php echo site_url('forum/thread/create'); ?>';
                            });
                        });
                        </script>
                        <li><button id="btn-new-thread" class="btn btn-primary btn-mini">Topik Baru</button></li>
                    </ul>
                    <ul class="nav pull-right">                        
                        <?php if ($this->session->userdata('forum_logged_in') != 1): ?>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li>
                                <form class="well" action="<?php echo site_url('forum/user/join'); ?>" method="post" style="margin: 5px 10px;">
                                <label>Username</label>
                                <input type="text" name="row[username]" class="span3" placeholder="">
                                <label>Password</label>
                                <input type="password" name="row[password]" class="span3" placeholder="">
                                <input type="submit" name="btn-login" class="btn btn-primary" value="Login"/>
                                </form>
                            </li>
                            </ul>
                            <!--<li><a href="<?php echo site_url('forum/user/join'); ?>">Join !</a></li>-->
                        </li>
                        <?php else: ?>
						<?php if ($this->session->userdata('admin_area') != 0): ?>
                        <li><a href="<?php echo site_url('forum/admin'); ?>">Admin</a></li>
						<?php endif; ?>
                        <li><a href="<?php echo site_url('forum/user/user_edit/'.$this->session->userdata('forum_user_id')); ?>">Profil Ku</a></li>
                        <li><a href="<?php echo site_url('forum/user/logout'); ?>">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                    </div><!-- /.nav-collapse -->
                </div>
                </div><!-- /navbar-inner -->
            </div><!-- /navbar -->
            
            <div class="row-fluid">