	  <legend>Web Settings</legend>
					
	  <?php if($setting->num_rows() == 0){ ?>
       <div class="row"></div>
       <div class="alert alert-info">                      
          <strong>Data tidak ditemukan.</strong>
       </div>
       <?php }else{ ?>
       <table width="100%" class="table table-condensed">
          <thead>
             <tr>
                <th style="text-align: left">No</th>
                <th style="text-align: left">Title</th>                        
                <th style="text-align: left">Tipe</th>
                <th style="text-align: left">Value</th>
             </tr>
          </thead>
          <tbody>
             <?php $nomor = 0;?>
             <?php foreach($setting->result() as $r){ ?>
             <tr>
                <td><?php echo $nomor + 1?></td>
                <td><?php echo $r->title;?></td>                                                
                <td><?php echo $r->tipe;?></td>
                <td>
                <?php if($r->tipe === 'big-text'){?>
                  <textarea id="<?php echo $r->title;?>" class="update_me" style="width: 100%;height: 100%"><?php echo $r->value;?></textarea>
                <?php }elseif($r->tipe === 'small-text'){ ?>
                  <input id="<?php echo $r->title;?>" class="update_me" style="width: 100%;height: 100%" type="text" value="<?php echo $r->value;?>">
                <?php }elseif($r->tipe === 'image'){ ?>
                  <img style="margin-bottom: 10px" src="<?php echo base_url(); ?>timthumb?src=/upload/<?php echo $r->value;?>&h=<?php echo $r->img_height?>&w=<?php echo $r->img_width?>&zc=0">
                  <form action="<?php echo base_url() . 'manage/settings/upload/' . $r->title;?>" method="POST" enctype="multipart/form-data">                                
                    <input class="upload" name="img" onchange="this.form.submit()" multiple="" type="file">                                       
                  </form>
                <?php }else{ ?>
                  <script type="text/javascript">
                    var flashvars = {};
                    var params = {};
                    params.scale = "exactfit";
                    var attributes = {};
                    swfobject.embedSWF("<?php echo base_url() . 'upload/' . $r->value;?>", "<?php echo $r->title;?>", "<?php echo $r->img_width?>", "<?php echo $r->img_height?>", "9.0.0", false,flashvars,params,attributes);
                  </script>
                  <div id="<?php echo $r->title;?>">
                    <h1>Alternative content</h1>
                    <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
                  </div>
                  <form action="<?php echo base_url() . 'manage/settings/upload/' . $r->title;?>" method="POST" enctype="multipart/form-data">                                
                    <input class="upload" name="img" onchange="this.form.submit()" multiple="" type="file">                                       
                  </form>
                <?php } ?>
                  
                </td>
             </tr>
             <?php $nomor++;} ?>
          </tbody>
       </table>
       <?php } ?>


<script>
   $('.update_me').keyup( function() {
      var this_title = $(this).attr('id');
      var this_val = $(this).val();
      //alert(value);
      $.post( "<?php echo base_url() . 'manage/settings/edt/';?>" + this_title, 
      	{ value: this_val } 
      );
   });
</script>   