<style type="text/css">
  .table-condensed th,
  .table-condensed td {
    padding: 0px 1px;
  }  
</style>

<div class="span9">
	<ul class="breadcrumb wellwhite">
			<li><a href="<?php echo base_URL()?>">Beranda</a> <span class="divider">/</span></li>
			<li>Data dan Informasi <span class="divider">/</span></li>
			<li>Daftar Nama dan Alamat Sekolah</li>			
	</ul>

	<div class="span12 wellwhite" style="margin-left: 0px">
		<legend>Daftar Nama dan Alamat Sekolah</legend>
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
            <?php $jenjang = $this->session->userdata('jenjang');?>
            <select name="jenjang" style="width:130px">
              <option value="">Semua jenjang</option>
              <option <?php echo $jenjang === 'tk' ? 'selected': '';?> value="tk">TK</option>
              <option <?php echo $jenjang === 'sd' ? 'selected': '';?> value="sd">SD</option>
              <option <?php echo $jenjang === 'mi' ? 'selected': '';?> value="mi">MI</option>
              <option <?php echo $jenjang === 'smp' ? 'selected': '';?> value="smp">SMP</option>
              <option <?php echo $jenjang === 'mts' ? 'selected': '';?> value="mts">Mts</option>
              <option <?php echo $jenjang === 'sma' ? 'selected': '';?> value="sma">SMA</option>
              <option <?php echo $jenjang === 'smk' ? 'selected': '';?> value="smk">SMK</option>
              <option <?php echo $jenjang === 'ma' ? 'selected': '';?> value="ma">MA</option>
              <option <?php echo $jenjang === 'slb' ? 'selected': '';?> value="slb">SLB</option>
            </select>
          </td>
          <td style="padding-right:10px">
            <?php $status = $this->session->userdata('status');?>
            <select name="status" style="width:120px">
              <option value="">Semua Status</option>
              <option <?php echo $status === 'negeri' ? 'selected': '';?> value="negeri">Negeri</option>
              <option <?php echo $status === 'swasta' ? 'selected': '';?> value="swasta">Swasta</option>
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
          <th style="text-align:left">NPSN</th>
          <th style="text-align:left">Nama</th>
          <th>Jenjang</th>
          <th>Status</th>
          <th>Info</th>
          <th>Guru</th>
          <th>Siswa</th>              
        </tr>
      </thead>
      <tbody>
      <?php if($data->num_rows() == 0){ ?>
      <tr>
          <td colspan='7' align='center'> Data not found </td>
      </tr>
      <?php }else{ ?>
      <?php foreach ($data->result() as $b) { ?>
        <tr>
          <td style="text-align:left"><?php echo $b->npsn;?></td>
          <td style="text-align:left"><?php echo $b->nama;?></td>
          <td style="text-align:center"><?php echo strtoupper($b->jenjang);?></td>
          <td style="text-align:center"><?php echo strtoupper($b->status);?></td>
          <td style="text-align:center"><a href="#info" data-toggle="modal" onclick="get_info(<?php echo $b->id?>)">Info</a></td>
          <td style="text-align:center"><a href="#guru" data-toggle="modal" onclick="get_guru(<?php echo $b->id?>)">Guru</a></td>
          <td style="text-align:center"><a href="#siswa" data-toggle="modal" onclick="get_siswa(<?php echo $b->id?>)">Siswa</a></td>              
        </tr>            
      <?php } ?>
      <?php } ?>
      </tbody>
    </table>
	</div>

  <center>
     <div class="pagination pagination-small">
         <ul><?php echo $this->pagination->create_links();?> </ul>
     </div>
  </center>
 
  <div style="width: 30%;margin-left:-15%;" class="modal hide fade" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="static"  aria-hidden="true" style="display: none">
    <div class="modal-header" style="padding: 0px 10px 0px 5px;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h6 id="myModalLabel">INFO SEKOLAH</h6>
    </div>
    <div class="modal-body">
      <table class="table table-hover table-condensed" style="font-size: 80%">
          <tbody id="tabel-info">
            <tr>
              <td style="width:150px;background-color:#D9EDF7">NSS</td>
              <td>{NSS}</td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Nama</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Alamat</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Kota</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Propinsi</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Kode Pos</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Nomor Telphon</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Nomor Faks</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Email</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Waktu Persekolahan</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Akreditasi</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Jenjang</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Jumlah Ruang</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Jumlah Lahan</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Jumlah Gedung</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Jumlah Kelas</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Status</td>
              <td></td>  
            </tr>            
            <tr>
              <td style="width:150px;background-color:#D9EDF7">Website</td>
              <td></td>  
            </tr>            
          </tbody>
        </table>
    </div>
  </div>  

  <div style="width: 50%;margin-left:-25%;" class="modal hide fade" id="guru" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="static"  aria-hidden="true" style="display: none">
    <div class="modal-header" style="padding: 0px 10px 0px 5px;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">DATA GURU</h4>
    </div>
    <div class="modal-body">
      <table class="table table-hover table-condensed" style="font-size: 80%">
        <thead>
            <tr style="background-color:#E3E3E3">
              <th>No.Pegawai</th>
              <th>Nama</th>
              <th>NUPTK</th>
              <th>JK</th>
              <th>Status</th>
              <th>Aktif</th>
                          
            </tr>
          </thead>
          <tbody id="tabel-guru">
            <tr>
              <td style="text-align:center;background-color:#D9EDF7">20266171</td>
              <td style="text-align:center">TK Pembina Bekasi</td>
              <td style="text-align:center;background-color:#D9EDF7">TK</td>
              <td style="text-align:center">Negeri</td>
              <td style="text-align:center;background-color:#D9EDF7">Negeri</td>
              <td style="text-align:center">Negeri</td>              
            </tr>            
          </tbody>
        </table>
    </div>
    
  </div> <!--end modal guru -->

  <div style="width: 30%;margin-left:-15%;" class="modal hide fade" id="siswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="static"  aria-hidden="true" style="display: none">
    <div class="modal-header" style="padding: 0px 10px 0px 5px;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">DATA MURID</h4>
    </div>
    <div class="modal-body">
      <table class="table table-hover table-condensed" style="font-size: 80%">
        <thead>
            <tr style="background-color:#E3E3E3">
              <th>NISN</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Jurusan</th>
            </tr>
          </thead>
          <tbody id="tabel-siswa">
            <tr>
              <td style="text-align:center;background-color:#D9EDF7">20266171</td>
              <td style="text-align:center">LISA DEWI LESTARI</td>
              <td style="text-align:center;background-color:#D9EDF7">[Belum Ditempatkan]</td>
              <td style="text-align:center">Umum</td>              
            </tr>            
          </tbody>
        </table>
    </div>
    
  </div> <!--end modal guru -->
</div><!--/span--> 

<script>
  
  function get_info(id_sekolah){
    $.get( "<?php echo base_url() . 'tampil/sekolah_get_info';?>",
           { id : id_sekolah }
    ).done(function( data ) {
       $('#tabel-info').html(data);
    });;  
  }

  function get_guru(id_sekolah){
    $.get( "<?php echo base_url() . 'tampil/sekolah_get_guru';?>",
           { id : id_sekolah }
    ).done(function( data ) {
       $('#tabel-guru').html(data);
    });; 
  }
  
  function get_siswa(id_sekolah){
    $.get( "<?php echo base_url() . 'tampil/sekolah_get_siswa';?>",
           { id : id_sekolah }
    ).done(function( data ) {
       $('#tabel-siswa').html(data);
    });; 
  }
  

</script>