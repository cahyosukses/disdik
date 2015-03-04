<div class="span9">
	<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li>Data dan Informasi <span class="divider">/</span></li>
			<li>Rekap Data Sekolah</li>			
	</ul>

	<div class="span12 wellwhite" style="margin-left: 0px">
		<legend>Rekap Data Sekolah</legend>
		<form class="form-search" method="POST" action="">      
      <table>
        <tr>  
          <td style="padding-right:10px">Filter</td>           
          <td style="padding-right:10px">
            <?php $id_kabupaten = $this->session->userdata('id_kabupaten');?>
            <select name="id_kabupaten" style="width:250px">
              <option value="">Semua Wilayah</option>
              <?php foreach ($kabupaten->result() as $k){ ?>
              <option <?php echo $id_kabupaten == $k->id ? 'selected' : ''?> value="<?php echo $k->id;?>"><?php echo $k->nama;?></option>  
              <?php }?>
            </select>
          </td>
          
          <td style="padding-right:10px">
            <?php $tahun = $this->session->userdata('tahun');?>
            <select name="tahun" style="width:120px">
              <!--<option value="">Semua Tahun</option>-->
              <?php $min = $th_min_max->min_th;
                    $max = $th_min_max->max_th;
                    for ($i= $min; $i <= $max ; $i++) { 
              ?>
              <option <?php echo $tahun === $i ? 'selected': '';?> value="<?php echo $i?>"><?php echo $i; ?></option>
              <?php } ?>
            </select>
          </td>  
          <td><button type="submit" class="btn pull-right">Cari Data</button></td>        
        </tr>        
        <tr>
          <td></td>
          
        </tr>
      </table> 
    </form>

		<table class="table table-hover">
          <thead>
            <tr>
              <th style="text-align:left">Jenjang</th>
              <th>Rombel</th>
              <th>Murid</th>
              <th>Guru</th>
              <th>Ruang Kelas</th>
              <th>Lulusan</th>              
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data->result() as $d){ ?>
            <tr>
              
              <td style="text-align:left"><?php echo $d->jenjang?></td>  
              <td style="text-align:center"><?php echo $d->rombel?></td>  
              <td style="text-align:center"><?php echo $d->murid?></td>  
              <td style="text-align:center"><?php echo $d->guru?></td>  
              <td style="text-align:center"><?php echo $d->ruang_kelas?></td>  
              <td style="text-align:center"><?php echo $d->lulusan?></td>  
              
            </tr>            
            <?php }?>
          </tbody>
        </table>
	</div>
</div><!--/span-->