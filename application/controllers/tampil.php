<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*

	copyright @ Nur Akhwan website
	copyright @ kirana.avalokiteshvara

 */
ini_set('memory_limit', '512M');

class Tampil extends My_Controller {
	
	function __construct() {
		parent::__construct();
		
		//date_default_timezone_set("Asia/Jakarta"); 

		$this->load->library(array('Pagination','image_lib', 'session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'file','paginate'));
		$this->load->model(array('web_model','basecrud_m'));

		$current_date = date('Y-m-d');
		$ip = $this->_get_client_ip();

		//untuk statistik situs
		$last_seen = $this->session->userdata('last_seen');
		if(!$last_seen){
			$this->session->set_userdata('last_seen',$current_date);				
			$this->basecrud_m->insert('view_stats',array('ip' => $ip));
		}else{
			if($last_seen !== $current_date){
				$this->session->set_userdata('last_seen',$current_date);
				$this->basecrud_m->insert('view_stats',array('ip' => $ip));	
			}
		}
		
	}
	
	function _generate_page($data){
		$this->load->view('v_page',$data);
	}

	public function index() {
		/*$web['title']	= 'Dinas Pendidikan Provinsi Jambi';
		$web['haldep']	= $this->db->query("SELECT * FROM haldep")->row();
		$web['berita']	= $this->db->query("SELECT * FROM berita LIMIT 5")->result();
		
		$this->load->view('t_atas', $web);
		$this->load->view('t_main', $web);
		$this->load->view('t_footer');
		*/
		$this->blog();
	}

	function opini($cmd = null, $param = null){

		$this->load->model('opini_m');		
		$web['title']	= '.:: Daftar Pojok Opini  ::.';
		
		$date_now = date('Y-m-d H:i:s');

        if(!$this->session->userdata('sort')){
        	//set default sort and order        	
            $this->session->set_userdata('sort','judul');
            $this->session->set_userdata('order','ASC');
        }

		if($cmd === 'cari'){

			$this->form_validation->set_rules('cari', 'Kata kunci pencarian', 'xss_clean');

			if ($this->form_validation->run() == TRUE) {	
				$this->session->set_userdata('cari',$this->input->post('cari'));
			}

			redirect('tampil/opini');

		}elseif($cmd === 'detail'){

			$r = $this->basecrud_m->get_where('opini',array('id' => $param));
			if($r->num_rows() == 0){
				$this->load->view('invalid', $web);	
			}else{
				$this->db->query("UPDATE opini SET hits = hits + 1 WHERE id = '".$param."'");
				$web['data'] = 	$r->row();				
				$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
					                                  FROM opini_tanggapan 
					                                  WHERE id_opini = $param AND tampil = 'Y'
					                                  ORDER BY inserted_at ASC");
				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				$web['page_name'] = 'v_opini_det';
			}
			
			
		}elseif($cmd === 'set_sort'){

			$this->session->set_userdata('sort',$param);
			$curr_order = $this->session->userdata('order');

			if($curr_order === 'ASC'){				
				$this->session->set_userdata('order','DESC');
			}else{
				//exit(0);
				$this->session->set_userdata('order','ASC');
			}			

			redirect(base_URL() . 'tampil/opini');

		}elseif($cmd === 'reply_add'){


			$this->form_validation->set_rules('nama', 'Nama', 'xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');			
			$this->form_validation->set_rules('website', 'Website', 'xss_clean');
			$this->form_validation->set_rules('komentar', 'Komentar', 'xss_clean|required');
			$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');

			if ($this->form_validation->run() == TRUE) {				
				
				//$date_now = date('Y-m-d H:i:s');
				$nama = $this->input->post('nama');
				
				if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
					$nama = 'Guest';
				}

				$in = array(
					'id_opini'     => $param,
					'nama'         => $nama,
					'email'        => $this->input->post('email'),
					'alamat'       => $this->input->post('alamat'),
					'website'      => $this->input->post('website'),
					'komentar'     => $this->input->post('komentar'),
					'inserted_at'  => $date_now
				);				

				$this->basecrud_m->insert('opini_tanggapan',$in);
				$this->session->set_flashdata("k", "<div class='alert alert-success'>Tanggapan terkirim dan Menunggu untuk di Moderasi</div>");
				redirect('tampil/opini/detail/' . $param,'reload');
			
			}else{		
				$web['post'] = $this->db->query(
											"SELECT judul,isi,oleh,tglPost
				                             FROM opini
				                             WHERE id = $param")->row();

				$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
													  FROM opini_tanggapan 
					                                  WHERE id_opini = $param AND tampil = 'Y'
					                                  ORDER BY inserted_at ASC");
				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];			
				$web['msg'] = validation_errors();			
			}

			$web['page_name'] = 'v_opini_det';
		
		}else{
			//pagination
			$url      = base_url() . 'tampil/opini/';
			$res      = $this->opini_m->get('numrows');
			$per_page = 15;
			$config   = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->opini_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->opini_m->offset = $this->uri->segment(3);
	        }else{
	            $this->opini_m->offset = 0;
	        }	

			$sort  = $this->session->userdata('sort');
			$order = $this->session->userdata('order');

			$this->opini_m->sort  = $sort;
			$this->opini_m->order = $order;
	    	//end pagination
	    	
			$web['data'] = $this->opini_m->get('pagging');			
			$web['page_name'] = 'v_opini';
		}
		
		$this->_generate_page($web);
	}

	function pengumuman($cmd = null, $param = null){

		$this->load->model('pengumuman_m');		
		$web['title']	= '.:: Daftar Pengumuman  ::.';
		//$this->load->view('t_atas', $web);

		if($cmd === 'cari'){

			$this->form_validation->set_rules('cari', 'Kata kunci pencarian', 'xss_clean');

			if ($this->form_validation->run() == TRUE) {	
				$this->session->set_userdata('cari',$this->input->post('cari'));
			}

			redirect('tampil/pengumuman');

		}elseif($cmd === 'detail'){

			$r = $this->basecrud_m->get_where('pengumuman',array('id' => $param));
			if($r->num_rows() == 0){
				$this->load->view('invalid', $web);	
			}else{
				$this->db->query("UPDATE pengumuman SET hits = hits + 1 WHERE id = '".$param."'");
				$web['data'] = 	$r->row();
				//$this->load->view('v_pengumuman_det', $web);	
				$web['page_name'] = 'v_pengumuman_det';
			}
			
			
		}else{
			//pagination
			$url = base_url() . 'tampil/pengumuman/';
			$res = $this->pengumuman_m->get('numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->pengumuman_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->pengumuman_m->offset = $this->uri->segment(3);
	        }else{
	            $this->pengumuman_m->offset = 0;
	        }	

			$this->pengumuman_m->sort = 'tglPost';
	    	$this->pengumuman_m->order = 'DESC';
	    	//end pagination
	    	
			$web['data'] = $this->pengumuman_m->get('pagging');
			//$this->load->view('v_pengumuman', $web);
			$web['page_name'] = 'v_pengumuman';
		}

		//$this->load->view('t_footer');
		$this->_generate_page($web);

	}

	public function profil() {
		
		$web['title']	= '.:: Profil Website Dinas Pendidikan Provinsi Jambi  ::.';
		$id				= $this->uri->segment(3);
		$profil = $this->db->query("SELECT * FROM profil WHERE id = '$id'");
		
		if($profil->num_rows() == 0){
			redirect(base_URL() . 'tampil','reload');
		}

		$web['profil']	= $profil->row();
		
		if($profil->row()->type === 'map'){
			$web['show_map'] = 'SHOW-ME';
		}

		//$this->load->view('t_atas', $web);
		//$this->load->view('v_profil', $web);
		//$this->load->view('t_footer');
		$web['page_name'] = 'v_profil';
		$this->_generate_page($web);
	}

	public function program() {
		
		$web['title']	= '.:: Website Dinas Pendidikan Provinsi Jambi  ::.';
		$id				= $this->uri->segment(3);
		$program = $this->db->query("SELECT * FROM program WHERE id = '$id'");
		
		if($program->num_rows() == 0){
			redirect(base_URL() . 'tampil','reload');
		}

		$web['program']	= $program->row();

		$web['page_name'] = 'v_program';
		$this->_generate_page($web);
	}


	/*
	public function data_informasi() {
		$web['title']	= '.:: Data dan Informasi Dinas Pendidikan Provinsi Jambi  ::.';
		$id				= $this->uri->segment(3);
		$web['data_informasi']	= $this->db->query("SELECT * FROM data_informasi WHERE id = '$id'")->row();
		
		$this->load->view('t_atas', $web);
		$this->load->view('v_data_informasi', $web);
		$this->load->view('t_footer');
	}
	*/

	function rekap_data_sekolah(){
		$this->load->model('rekap_m');

		$web['title']	= '.:: Rekap Data Sekolah  ::.';

		$web['kabupaten'] = $this->basecrud_m->get_where('kabupaten',array('id_propinsi' => 1));
		

		if(!empty($_POST)){
			
			$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'xss_clean');

			if ($this->form_validation->run() == TRUE) {					
				$this->session->set_userdata('id_kabupaten',$this->input->post('id_kabupaten'));
			}

		}

		$web['data'] = $this->rekap_m->stats();		
		$web['page_name'] = 'v_rekap_sekolah';
		$this->_generate_page($web);
	}

	/***************************************************************************/

	function sekolah_get_siswa(){

		$id_sekolah = $_GET['id'];
		$siswa = $this->basecrud_m->get_where('data_siswa',array('id_sekolah' => $id_sekolah));

		$data = null;
		foreach ($siswa->result() as $s) {
			$kelas = IsNullOrEmptyString($s->kelas) ? "[Belum ditentukan]" : $s->kelas; 
			$jurusan = IsNullOrEmptyString($s->jurusan) ? "[Belum ditentukan]" : $s->jurusan; 
			$data .=
			"<tr>
              <td style=\"text-align:center;background-color:#D9EDF7\">" . $s->nisn . "</td>
              <td style=\"text-align:left\">" . $s->nama . "</td>
              <td style=\"text-align:center;background-color:#D9EDF7\">" . $kelas . "</td>
              <td style=\"text-align:center\">" . $jurusan . "</td>              
            </tr>";
		}

		echo $data;
	}

	function sekolah_get_guru(){

		$id_sekolah = $_GET['id'];
		$guru = $this->basecrud_m->get_where('data_guru',array('id_sekolah' => $id_sekolah));

		$data = null;
		foreach ($guru->result() as $gr) {
			$data .=
			"<tr>
              <td style=\"text-align:center;background-color:#D9EDF7\">" . $gr->nip . "</td>
              <td style=\"text-align:center\">" . $gr->nama . "</td>
              <td style=\"text-align:center;background-color:#D9EDF7\">" . $gr->nuptk . "</td>
              <td style=\"text-align:center\">" . strtoupper($gr->jk) . "</td>
              <td style=\"text-align:center;background-color:#D9EDF7\">" . strtoupper($gr->status) . "</td>
              <td style=\"text-align:center\">" . $gr->aktif . "</td>              
            </tr>";   
		}

		echo $data;
	}

	function aduan_apresiasi_pdf($tipe,$id){
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		
		#complete serverpath must be given like
	    #example "/apache/htdocs/myfile.pdf" ( not "http:xyz.com/myfile.pdf" )
	    $DelFilePath = FCPATH . "/upload/" . $tipe . "_" . $id . ".pdf";	
	     
	    # delete file if exists
	    if (file_exists($DelFilePath)) { unlink ($DelFilePath); }

		$pdfFilePath = FCPATH . "/upload/" . $tipe . "_" . $id . ".pdf";			
		$data = array();

		if($tipe === 'aduan'){
			$data['isi'] = $this->basecrud_m->get_where('aduan',array('id' => $id))->row();
		}else{
			$data['isi'] = $this->basecrud_m->get_where('apresiasi',array('id' => $id))->row();
		}
		
		 
		if (file_exists($pdfFilePath) == FALSE)
		{
		    ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
		    if($tipe === 'aduan'){
		    	$html = $this->load->view('pdf_aduan', $data, true); // render the view into HTML
		    }else{
		    	$html = $this->load->view('pdf_apresiasi', $data, true); // render the view into HTML
		    }			    
		     
		    $this->load->library('pdf');
		    $pdf = $this->pdf->load();
		    $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
		    $pdf->WriteHTML($html); // write the HTML into the PDF
		    $pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect("/upload/" . $tipe . "_" . $id . ".pdf"); 
	}

	function aduan_apresiasi_detail(){		
		
		$id   = $_GET['id'];
		$tipe = $_GET['tipe'];

		$data = "";
		if($tipe === 'aduan'){
			$rs = $this->basecrud_m->get_where('aduan',array('id' => $id));
			if($rs->num_rows() > 0){
				$data = 
				     "<tr>
		                <td style=\"width:100px\">Topik Aduan</td> 
		                <td>" . $rs->row()->topik . "</td>   
		              </tr>            
		              <tr>
		                <td>Nama Pengirim</td> 
		                <td>" . $rs->row()->nama_pengadu . "</td>   
		              </tr>            
		              <tr>
		                 <td>Judul Program</td>     
		                 <td>" .$rs->row()->judul_program . "</td>   
		              </tr>
		              <tr>
		                 <td>Stasiun Program</td>   
		                 <td>" . $rs->row()->stasiun_program . "</td>   
		              </tr>
		              <tr>
		                 <td>Pesan Aduan</td>
		                 <td>" . $rs->row()->pesan . "</td>   
		              </tr>";
	        }
		}else{
			$rs = $this->basecrud_m->get_where('apresiasi',array('id' => $id));
			if($rs->num_rows() > 0){
				$data = 
				    "<tr>
		                <td style=\"width:100px\">Topik Apresiasi</td> 
		                <td>" . $rs->row()->topik . "</td>   
		              </tr>            
		              <tr>
		                <td>Nama Pengirim</td> 
		                <td>" . $rs->row()->nama_pengirim . "</td>   
		              </tr>            
		              <tr>
		                 <td>Judul Program</td>     
		                 <td>" . $rs->row()->judul_program . "</td>   
		              </tr>
		              <tr>
		                 <td>Stasiun Program</td>   
		                 <td>" . $rs->row()->stasiun_program . "</td>   
		              </tr>
		              <tr>
		                 <td>Pesan Apresiasi</td>
		                 <td>" . $rs->row()->pesan . "</td>   
		              </tr>";
	        }
		}

		echo $data;	
	}



	function sekolah_get_info(){

		$id_sekolah = $_GET['id'];
		$sekolah = $this->basecrud_m->get_where('data_sekolah',array('id' => $id_sekolah))->row();
		$kabupaten = $this->basecrud_m->get_where('kabupaten',array('id' => $sekolah->id_kabupaten))->row();

		$data = "	<!--<tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">NSS</td>
		              <td>". $sekolah->nss ."</td>  
		            </tr>-->            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Nama</td>
		              <td>". strtoupper($sekolah->nama) ."</td>  
		            </tr> 
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Kecamatan</td>
		              <td>". strtoupper($sekolah->kecamatan) ."</td>  
		            </tr>  
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Kelurahan</td>
		              <td>". strtoupper($sekolah->kelurahan) ."</td>  
		            </tr>             
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Alamat</td>
		              <td>". $sekolah->alamat ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Kabupaten / Kota</td>
		              <td>". strtoupper($kabupaten->nama) ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Propinsi</td>
		              <td>JAMBI</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Kode Pos</td>
		              <td>". $sekolah->kodepos ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Nomor Telphon</td>
		              <td>". $sekolah->no_telp ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Nomor Faks</td>
		              <td>". $sekolah->no_faks ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Email</td>
		              <td>". $sekolah->email ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Waktu Persekolahan</td>
		              <td>". $sekolah->waktu_persekolahan ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Akreditasi</td>
		              <td>". $sekolah->akreditasi ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Jenjang</td>
		              <td>". strtoupper($sekolah->jenjang) ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Jumlah Ruang</td>
		              <td>". $sekolah->jumlah_ruang ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Jumlah Lahan</td>
		              <td>". $sekolah->jumlah_lahan ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Jumlah Gedung</td>
		              <td>". $sekolah->jumlah_gedung ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Jumlah Kelas</td>
		              <td>". $sekolah->jumlah_kelas ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Status</td>
		              <td>". strtoupper($sekolah->status) ."</td>  
		            </tr>            
		            <tr>
		              <td style=\"width:150px;background-color:#D9EDF7\">Website</td>
		              <td>". $sekolah->website ."</td>  
		            </tr>";

		echo $data;            

	}

	function daftar_sekolah(){

		$this->load->model('datasekolah_m');
		
		if(!empty($_POST)){

			$this->form_validation->set_rules('jenjang', 'Jenjang', 'xss_clean');
			$this->form_validation->set_rules('status', 'status', 'xss_clean');
			$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'xss_clean');

			if ($this->form_validation->run() == TRUE) {	

				$this->session->set_userdata('jenjang',$this->input->post('jenjang'));
				$this->session->set_userdata('status',$this->input->post('status'));
				$this->session->set_userdata('id_kabupaten',$this->input->post('id_kabupaten'));
			}

			redirect('tampil/daftar_sekolah','reload');

		}

		//pagination
		$url = base_url() . 'tampil/daftar_sekolah/';
		$res = $this->datasekolah_m->get('numrows');
		$per_page = 10;
		$config = paginate($url,$res,$per_page,3);
		$this->pagination->initialize($config);

		$this->datasekolah_m->limit = $per_page;
		if($this->uri->segment(3) == TRUE){
        	$this->datasekolah_m->offset = $this->uri->segment(3);
        }else{
            $this->datasekolah_m->offset = 0;
        }	

		$this->datasekolah_m->sort = 'a.nama';
    	$this->datasekolah_m->order = 'ASC';
    	//end pagination

    	$web['title']	= '.:: Daftar Nama dan Alamat Sekolah  ::.';
		$web['data'] = $this->datasekolah_m->get('pagging');
		$web['kabupaten'] = $this->basecrud_m->get_where('kabupaten',array('id_propinsi' => 1));
		
		//$this->load->view('t_atas', $web);
		//$this->load->view('v_daftar_sekolah', $web);
		//$this->load->view('t_footer');
		$web['page_name'] = 'v_daftar_sekolah';
		$this->_generate_page($web);
	}


	function reset_search($param0,$param1){

		if($param0 === 'prod_hukum'){
			$this->session->unset_userdata('cari');
			$this->session->unset_userdata('cari');
			redirect('tampil/data_produk_hukum/' . $param1,'reload');
		}

	}

	function download_file($tipe = null, $id){

		$this->load->helper('download');

		$replace_me = array("/","?","\\","!","$");

		if($tipe === 'dok_hukum'){

			$file = $this->basecrud_m->get_where('produk_hukum_files',array('id' => $id));
			if($file->num_rows() == 0){
				redirect('tampil');
			}

			if (!file_exists("./upload/download/" . $file->row()->nama_file)){
				redirect('tampil');
			}

			//update view
			$this->db->query("UPDATE produk_hukum_files 
				              SET view_count = view_count + 1 
				              WHERE id = '".$id."'");

			$data = file_get_contents("./upload/download/" . $file->row()->nama_file); // Read the file's contents
			$ext = pathinfo($file->row()->nama_file, PATHINFO_EXTENSION);
			$name = str_replace($replace_me,"_",$file->row()->judul) . '.' . $ext;

			force_download($name, $data); 		

		}elseif($tipe === 'newsletter'){

			$file = $this->basecrud_m->get_where('newsletter',array('id' => $id));
			if($file->num_rows() == 0){
				redirect('tampil');
			}

			if (!file_exists("./upload/download/" . $file->row()->file)){
				redirect('tampil');
			}

			//update view
			$this->db->query("UPDATE newsletter 
				              SET view_count = view_count + 1 
				              WHERE id = '".$id."'");

			$data = file_get_contents("./upload/download/" . $file->row()->file); // Read the file's contents
			$ext = pathinfo($file->row()->file, PATHINFO_EXTENSION);
			$name = str_replace($replace_me,"_",$file->row()->judul) . '.' . $ext;

			force_download($name, $data); 
		}
	}

	public function data_produk_hukum() {
		
		$this->load->model('produk_hukum_m');

		$web['title']	= '.:: Data Produk Hukum ::.';
		$id				= $this->uri->segment(3);

		//cek search ----------------
		$curr_id = $this->session->userdata('curr_id');
        
        if(!$curr_id){
            $this->session->set_userdata('curr_id',$id);
        }else{
            if($curr_id !== $id){
                $this->session->unset_userdata('cari');
                $this->session->unset_userdata('tahun');
                $curr_id = $this->session->set_userdata('curr_id',$id);                    
            }        
        }    
        //----------------------------

		if(!empty($_POST)){
			//pencarian
			$this->form_validation->set_rules('cari', 'Text Cari', 'xss_clear');
			$this->form_validation->set_rules('tahun', 'Tahun Cari', 'xss_clean');

			if ($this->form_validation->run() == TRUE) {
				$this->session->set_userdata('cari',$this->input->post('cari'));
				$this->session->set_userdata('tahun',$this->input->post('tahun'));
				
			}
			
		}
		
		$header = $this->db->query("SELECT * FROM data_produk_hukum WHERE id = '$id'");

		//$this->load->view('t_atas', $web);

		if($header->num_rows() == 0){

			//$this->load->view('invalid');
			$web['page_name'] = 'invalid';

		}else{

			//pagination
			$url = base_url() . 'tampil/data_produk_hukum/' . $id . '/';
			$res = $this->produk_hukum_m->get($id,'numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,4);
			$this->pagination->initialize($config);

			$this->produk_hukum_m->limit = $per_page;
			if($this->uri->segment(4) == TRUE){
	        	$this->produk_hukum_m->offset = $this->uri->segment(4);
	        }else{
	            $this->produk_hukum_m->offset = 0;
	        }	

			$this->produk_hukum_m->sort = 'a.tahun DESC, a.nomor DESC';
	    	//$this->produk_hukum_m->order = 'ASC';
	    	//end pagination
	    	
			$web['data'] = $this->produk_hukum_m->get($id,'pagging');
			$web['data_produk_hukum']	= $header->row();		
			//$this->load->view('v_data_produk_hukum', $web);
			$web['page_name'] = 'v_data_produk_hukum';
		}		

		//$this->load->view('t_footer');		
		$this->_generate_page($web);

	}

	function _captcha(){
		//generate capcha
        $this->load->helper('captcha');
		$vals = array(			
			'img_path' => './captcha/',
			'img_url' => base_url() . 'captcha/',
			'img_width' => 180,
			'img_height' => 30,
            'font_path' => './captcha/font/BRUSHSCI.TTF',
			'border' => 0,
			'expiration' => 7200
		);
		
		$cap = create_captcha($vals);		
		$this->session->set_userdata('captcha_word', $cap['word']);	
		return $cap;
	}

	public function check_captcha(){

		$cap = $this->input->post('captcha_word');
		$cap_sess = $this->session->userdata('captcha_word'); 
		if( $cap_sess === $cap)
		{
			return true;
		}
		else{
			$this->form_validation->set_message('check_captcha', 'Security Code Tidak Cocok. ');
			return false;
		}
	}

	function aduan($cmd = null,$param = null){


		$this->load->model('aduan_m');

		$web['title']		= "Pojok Aduan";
		//$this->load->view('t_atas', $web);

		$date_now = date('Y-m-d H:i:s');

		//$cap = $this->_captcha();
		//$web['captcha_image'] = $cap['image'];
		
		if($cmd === 'add'){

			$cap = $this->_captcha();
			$web['captcha_image'] = $cap['image'];
			//$this->load->view('f_ide_saran', $web);
			$web['page_name'] = 'f_aduan';
		

		}elseif($cmd === 'add_act'){

			$this->form_validation->set_rules('topik', 'Topik', 'xss_clean|required');
			$this->form_validation->set_rules('nama_pengadu', 'Nama Lengkap Pengadu', 'xss_clean');			
			$this->form_validation->set_rules('email_pengadu', 'Email', 'xss_clean|valid_email');			
			$this->form_validation->set_rules('judul_program', 'Judul Program', 'xss_clean');
			$this->form_validation->set_rules('tgl_tayang_program', 'Tanggal Tayang', 'xss_clean|required');
			$this->form_validation->set_rules('jam_tayang_program', 'Jam Tayang', 'xss_clean|required');
			$this->form_validation->set_rules('stasiun_program', 'Stasiun Program', 'xss_clean|required');
			$this->form_validation->set_rules('pesan', 'Pesan pengaduan', 'xss_clean|required');
			$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$nama = $this->input->post('nama_pengadu');
				if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
					$nama = 'Guest';
				}


				$in = array(
					'topik'              => $this->input->post('topik'),
					'nama_pengadu'       => $nama,
					'email_pengadu'      => $this->input->post('email_pengadu'),
					'judul_program'      => $this->input->post('judul_program'),
					'tgl_tayang_program' => $this->input->post('tgl_tayang_program'),
					'jam_tayang_program' => $this->input->post('jam_tayang_program'),
					'stasiun_program'    => $this->input->post('stasiun_program'),
					'pesan'              => $this->input->post('pesan'),
					'inserted_at'        => $date_now
				);				

				$this->basecrud_m->insert('aduan',$in);
				$this->session->set_flashdata("k", "<div class='alert alert-success'>Pengaduan terkirim dan Menunggu untuk di Moderasi</div>");
				redirect('tampil/aduan','reload');
			
			}else{

				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				$web['msg'] = validation_errors();							
				//$this->load->view('f_ide_saran', $web);
				$web['page_name'] = 'f_aduan';
				
			}

		}/*elseif($cmd === 'reply'){

			$r = $this->basecrud_m->get_where('aduan',array('id' => $param));
			if($r->num_rows() == 0){

				//$this->load->view('invalid', $web);	
				$web['page_name'] = 'invalid';
				
			}else{
				$web['post'] = $this->db->query("SELECT nama_pengadu,topik,DATE(inserted_at) as tgl
					                             FROM aduan
					                             WHERE id = $param")->row();
				
				$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
					                                  FROM aduan_tanggapan 
					                                  WHERE id_aduan = $param AND tampil = 'Y'
					                                  ORDER BY inserted_at ASC");
				
			
				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				//$this->load->view('f_ide_saran_tanggapan', $web);	
				$web['page_name'] = 'f_aduan_tanggapan';
		
			}

			

		}elseif($cmd === 'reply_add'){

			$r = $this->basecrud_m->get_where('aduan',array('id' => $param));
			if($r->num_rows() == 0){

				//$this->load->view('invalid', $web);	
				$web['page_name'] = 'invalid';
				
			}else{
				$this->form_validation->set_rules('nama', 'Nama', 'xss_clean|required');
				$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');			
				$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');			
				$this->form_validation->set_rules('website', 'Website', 'xss_clean');
				$this->form_validation->set_rules('komentar', 'Komentar', 'xss_clean|required');
				$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');
				
				if ($this->form_validation->run() == TRUE) {				
					
					//$date_now = date('Y-m-d H:i:s');
					$nama = $this->input->post('nama');
					
					if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
						$nama = 'Guest';
					}

				
					$in = array(
						'id_ide_saran' => $param,
						'nama'         => $nama,
						'email'        => $this->input->post('email'),
						'alamat'       => $this->input->post('alamat'),
						'website'      => $this->input->post('website'),
						'komentar'     => $this->input->post('komentar'),
						'inserted_at'  => $date_now
					);				

					$this->basecrud_m->insert('aduan_tanggapan',$in);
					$this->session->set_flashdata("k", "<div class='alert alert-success'>Tanggapan terkirim dan Menunggu untuk di Moderasi</div>");
					redirect('tampil/ide_saran/reply/' . $param,'reload');
				
				}else{		

					$web['post'] = $this->db->query("SELECT nama_pengadu,topik,DATE(inserted_at) as tgl
					                             	FROM aduan
					                             	WHERE id = $param")->row();

					$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
						                                  FROM aduan_tanggapan 
						                                  WHERE id_aduan = $param AND tampil = 'Y'
						                                  ORDER BY inserted_at ASC");
					$cap = $this->_captcha();
					$web['captcha_image'] = $cap['image'];			
					$web['msg'] = validation_errors();							
				}

				//$this->load->view('f_ide_saran_tanggapan', $web);
				$web['page_name'] = 'f_aduan_tanggapan';
		
			}			

		}*/else{

			//pagination
			$url = base_url() . 'tampil/aduan/';
			$res = $this->aduan_m->get('numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->aduan_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->aduan_m->offset = $this->uri->segment(3);
	        }else{
	            $this->aduan_m->offset = 0;
	        }	

			$this->aduan_m->sort = 'inserted_at';
	    	$this->aduan_m->order = 'DESC';
	    	//end pagination
	    	
			$web['data'] = $this->aduan_m->get('pagging');				
			//$this->load->view('v_ide_saran', $web);
			$web['page_name'] = 'v_aduan';
		

		}

		//$this->load->view('t_footer');
		
		$this->_generate_page($web);
	}

	function apresiasi($cmd = null,$param = null){


		$this->load->model('apresiasi_m');

		$web['title']		= "Pojok Apresiasi";
		//$this->load->view('t_atas', $web);

		$date_now = date('Y-m-d H:i:s');

		//$cap = $this->_captcha();
		//$web['captcha_image'] = $cap['image'];
		
		if($cmd === 'add'){

			$cap = $this->_captcha();
			$web['captcha_image'] = $cap['image'];
			//$this->load->view('f_ide_saran', $web);
			$web['page_name'] = 'f_apresiasi';
		

		}elseif($cmd === 'add_act'){

			$this->form_validation->set_rules('topik', 'Topik', 'xss_clean|required');
			$this->form_validation->set_rules('nama_pengirim', 'Nama Lengkap Pengirim', 'xss_clean');			
			$this->form_validation->set_rules('email_pengirim', 'Email Pengirim', 'xss_clean|valid_email');			
			$this->form_validation->set_rules('judul_program', 'Judul Program', 'xss_clean');
			$this->form_validation->set_rules('tgl_tayang_program', 'Tanggal Tayang', 'xss_clean|required');
			$this->form_validation->set_rules('jam_tayang_program', 'Jam Tayang', 'xss_clean|required');
			$this->form_validation->set_rules('stasiun_program', 'Stasiun Program', 'xss_clean|required');
			$this->form_validation->set_rules('pesan', 'Pesan pengaduan', 'xss_clean|required');
			$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$nama = $this->input->post('nama_pengirim');
				if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
					$nama = 'Guest';
				}


				$in = array(
					'topik'              => $this->input->post('topik'),
					'nama_pengirim'      => $nama,
					'email_pengirim'     => $this->input->post('email_pengirim'),
					'judul_program'      => $this->input->post('judul_program'),
					'tgl_tayang_program' => $this->input->post('tgl_tayang_program'),
					'jam_tayang_program' => $this->input->post('jam_tayang_program'),
					'stasiun_program'    => $this->input->post('stasiun_program'),
					'pesan'              => $this->input->post('pesan'),
					'inserted_at'        => $date_now
				);				

				$this->basecrud_m->insert('apresiasi',$in);
				$this->session->set_flashdata("k", "<div class='alert alert-success'>Apresiasi terkirim dan Menunggu untuk di Moderasi</div>");
				redirect('tampil/apresiasi','reload');
			
			}else{

				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				$web['msg'] = validation_errors();							
				//$this->load->view('f_ide_saran', $web);
				$web['page_name'] = 'f_apresiasi';
				
			}

		}/*elseif($cmd === 'reply'){

			$r = $this->basecrud_m->get_where('aduan',array('id' => $param));
			if($r->num_rows() == 0){

				//$this->load->view('invalid', $web);	
				$web['page_name'] = 'invalid';
				
			}else{
				$web['post'] = $this->db->query("SELECT nama_pengadu,topik,DATE(inserted_at) as tgl
					                             FROM aduan
					                             WHERE id = $param")->row();
				
				$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
					                                  FROM aduan_tanggapan 
					                                  WHERE id_aduan = $param AND tampil = 'Y'
					                                  ORDER BY inserted_at ASC");
				
			
				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				//$this->load->view('f_ide_saran_tanggapan', $web);	
				$web['page_name'] = 'f_aduan_tanggapan';
		
			}

			

		}elseif($cmd === 'reply_add'){

			$r = $this->basecrud_m->get_where('aduan',array('id' => $param));
			if($r->num_rows() == 0){

				//$this->load->view('invalid', $web);	
				$web['page_name'] = 'invalid';
				
			}else{
				$this->form_validation->set_rules('nama', 'Nama', 'xss_clean|required');
				$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');			
				$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');			
				$this->form_validation->set_rules('website', 'Website', 'xss_clean');
				$this->form_validation->set_rules('komentar', 'Komentar', 'xss_clean|required');
				$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');
				
				if ($this->form_validation->run() == TRUE) {				
					
					//$date_now = date('Y-m-d H:i:s');
					$nama = $this->input->post('nama');
					
					if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
						$nama = 'Guest';
					}

				
					$in = array(
						'id_ide_saran' => $param,
						'nama'         => $nama,
						'email'        => $this->input->post('email'),
						'alamat'       => $this->input->post('alamat'),
						'website'      => $this->input->post('website'),
						'komentar'     => $this->input->post('komentar'),
						'inserted_at'  => $date_now
					);				

					$this->basecrud_m->insert('aduan_tanggapan',$in);
					$this->session->set_flashdata("k", "<div class='alert alert-success'>Tanggapan terkirim dan Menunggu untuk di Moderasi</div>");
					redirect('tampil/ide_saran/reply/' . $param,'reload');
				
				}else{		

					$web['post'] = $this->db->query("SELECT nama_pengadu,topik,DATE(inserted_at) as tgl
					                             	FROM aduan
					                             	WHERE id = $param")->row();

					$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
						                                  FROM aduan_tanggapan 
						                                  WHERE id_aduan = $param AND tampil = 'Y'
						                                  ORDER BY inserted_at ASC");
					$cap = $this->_captcha();
					$web['captcha_image'] = $cap['image'];			
					$web['msg'] = validation_errors();							
				}

				//$this->load->view('f_ide_saran_tanggapan', $web);
				$web['page_name'] = 'f_aduan_tanggapan';
		
			}			

		}*/else{

			//pagination
			$url = base_url() . 'tampil/apresiasi/';
			$res = $this->apresiasi_m->get('numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->apresiasi_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->apresiasi_m->offset = $this->uri->segment(3);
	        }else{
	            $this->apresiasi_m->offset = 0;
	        }	

			$this->apresiasi_m->sort = 'inserted_at';
	    	$this->apresiasi_m->order = 'DESC';
	    	//end pagination
	    	
			$web['data'] = $this->apresiasi_m->get('pagging');				
			//$this->load->view('v_ide_saran', $web);
			$web['page_name'] = 'v_apresiasi';
		

		}

		//$this->load->view('t_footer');
		
		$this->_generate_page($web);
	}

	function ide_saran($cmd = null,$param = null){


		$this->load->model('ide_saran_m');

		$web['title']		= "Ide Dan Saran Pengunjung";
		//$this->load->view('t_atas', $web);

		$date_now = date('Y-m-d H:i:s');

		//$cap = $this->_captcha();
		//$web['captcha_image'] = $cap['image'];
		
		if($cmd === 'add'){

			$cap = $this->_captcha();
			$web['captcha_image'] = $cap['image'];
			//$this->load->view('f_ide_saran', $web);
			$web['page_name'] = 'f_ide_saran';
		

		}elseif($cmd === 'add_act'){

			$this->form_validation->set_rules('nama', 'Nama', 'xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');			
			$this->form_validation->set_rules('website', 'Website', 'xss_clean');
			$this->form_validation->set_rules('topik', 'Topik', 'xss_clean|required');
			$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$nama = $this->input->post('nama');
				if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
					$nama = 'Guest';
				}


				$in = array(
					'nama'        => $nama,
					'email'       => $this->input->post('email'),
					'alamat'      => $this->input->post('alamat'),
					'website'     => $this->input->post('website'),
					'topik'       => $this->input->post('topik'),
					'inserted_at' => $date_now
				);				

				$this->basecrud_m->insert('ide_saran',$in);
				$this->session->set_flashdata("k", "<div class='alert alert-success'>Saran terkirim dan Menunggu untuk di Moderasi</div>");
				redirect('tampil/ide_saran','reload');
			
			}else{

				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				$web['msg'] = validation_errors();							
				//$this->load->view('f_ide_saran', $web);
				$web['page_name'] = 'f_ide_saran';
				
			}

		}elseif($cmd === 'reply'){

			$r = $this->basecrud_m->get_where('ide_saran',array('id' => $param));
			if($r->num_rows() == 0){

				//$this->load->view('invalid', $web);	
				$web['page_name'] = 'invalid';
				
			}else{
				$web['post'] = $this->db->query("SELECT nama,topik,DATE(inserted_at) as tgl
				                             FROM ide_saran
				                             WHERE id = $param")->row();

				$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
					                                  FROM ide_saran_tanggapan 
					                                  WHERE id_ide_saran = $param AND tampil = 'Y'
					                                  ORDER BY inserted_at ASC");

				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				//$this->load->view('f_ide_saran_tanggapan', $web);	
				$web['page_name'] = 'f_ide_saran_tanggapan';
		
			}

			

		}elseif($cmd === 'reply_add'){

			$r = $this->basecrud_m->get_where('ide_saran',array('id' => $param));
			if($r->num_rows() == 0){

				//$this->load->view('invalid', $web);	
				$web['page_name'] = 'invalid';
				
			}else{
				$this->form_validation->set_rules('nama', 'Nama', 'xss_clean|required');
				$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');			
				$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');			
				$this->form_validation->set_rules('website', 'Website', 'xss_clean');
				$this->form_validation->set_rules('komentar', 'Komentar', 'xss_clean|required');
				$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');
				
				if ($this->form_validation->run() == TRUE) {				
					
					//$date_now = date('Y-m-d H:i:s');
					$nama = $this->input->post('nama');
					
					if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
						$nama = 'Guest';
					}

				
					$in = array(
						'id_ide_saran' => $param,
						'nama'         => $nama,
						'email'        => $this->input->post('email'),
						'alamat'       => $this->input->post('alamat'),
						'website'      => $this->input->post('website'),
						'komentar'     => $this->input->post('komentar'),
						'inserted_at'  => $date_now
					);				

					$this->basecrud_m->insert('ide_saran_tanggapan',$in);
					$this->session->set_flashdata("k", "<div class='alert alert-success'>Tanggapan terkirim dan Menunggu untuk di Moderasi</div>");
					redirect('tampil/ide_saran/reply/' . $param,'reload');
				
				}else{		

					$web['post'] = $this->db->query("SELECT nama,topik,DATE(inserted_at) as tgl
					                             	FROM ide_saran
					                             	WHERE id = $param")->row();

					$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
						                                  FROM ide_saran_tanggapan 
						                                  WHERE id_ide_saran = $param AND tampil = 'Y'
						                                  ORDER BY inserted_at ASC");
					$cap = $this->_captcha();
					$web['captcha_image'] = $cap['image'];			
					$web['msg'] = validation_errors();							
				}

				//$this->load->view('f_ide_saran_tanggapan', $web);
				$web['page_name'] = 'f_ide_saran_tanggapan';
		
			}			

		}else{

			//pagination
			$url = base_url() . 'tampil/ide_saran/';
			$res = $this->ide_saran_m->get('numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->ide_saran_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->ide_saran_m->offset = $this->uri->segment(3);
	        }else{
	            $this->ide_saran_m->offset = 0;
	        }	

			$this->ide_saran_m->sort = 'inserted_at';
	    	$this->ide_saran_m->order = 'DESC';
	    	//end pagination
	    	
			$web['data'] = $this->ide_saran_m->get('pagging');				
			//$this->load->view('v_ide_saran', $web);
			$web['page_name'] = 'v_ide_saran';
		

		}

		//$this->load->view('t_footer');
		
		$this->_generate_page($web);
	}

	function ekspresi($cmd = null,$param = null){

		$this->load->model('ekspresi_m');

		$web['title']		= "Ekspresi Pengunjung";
		//$this->load->view('t_atas', $web);

		$date_now = date('Y-m-d H:i:s');

		if($cmd === 'add'){

			$cap = $this->_captcha();
			$web['captcha_image'] = $cap['image'];
			//$this->load->view('f_ekspresi', $web);
			$web['page_name'] = 'f_ekspresi';
		

		}elseif($cmd === 'add_act'){

			$this->form_validation->set_rules('nama', 'Nama', 'xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');			
			$this->form_validation->set_rules('website', 'Website', 'xss_clean');
			$this->form_validation->set_rules('judul', 'Judul', 'xss_clean|required');
			$this->form_validation->set_rules('isi_ekspresi', 'Eksrepsi', 'xss_clean|required');
			$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');

			if ($this->form_validation->run() == TRUE) {				
				
				$nama = $this->input->post('nama');					
				if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
					$nama = 'Guest';
				}

				$in = array(
					'nama'         => $nama,
					'email'        => $this->input->post('email'),
					'alamat'       => $this->input->post('alamat'),
					'website'      => $this->input->post('website'),
					'judul'        => $this->input->post('judul'),
					'isi_ekspresi' => $this->input->post('isi_ekspresi'),
					'inserted_at'  => $date_now
				);				

				$this->basecrud_m->insert('ekspresi',$in);
				$this->session->set_flashdata("k", "<div class='alert alert-success'>Ekspresi terkirim dan Menunggu untuk di Moderasi</div>");
				redirect('tampil/ekspresi','reload');
			
			}else{
				
				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				$web['msg'] = validation_errors();							
				//$this->load->view('f_ekspresi', $web);
				$web['page_name'] = 'f_ekspresi';
				
			}

		}elseif($cmd === 'reply'){

			$r = $this->basecrud_m->get_where('ekspresi',array('id' => $param));
			if($r->num_rows() == 0){

				//$this->load->view('invalid', $web);	
				$web['page_name'] = 'invalid';
				
			}else{
				$web['post'] = $this->db->query("SELECT nama,judul,isi_ekspresi,DATE(inserted_at) as tgl
				                             FROM ekspresi
				                             WHERE id = $param")->row();

				$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
													  FROM ekspresi_tanggapan 
					                                  WHERE id_ekspresi = $param AND tampil = 'Y'
					                                  ORDER BY inserted_at ASC");

				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];
				//$this->load->view('f_ekspresi_tanggapan', $web);
				$web['page_name'] = 'f_ekspresi_tanggapan';

			}
			
		}elseif($cmd === 'reply_add'){


			$this->form_validation->set_rules('nama', 'Nama', 'xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');			
			$this->form_validation->set_rules('website', 'Website', 'xss_clean');
			$this->form_validation->set_rules('komentar', 'Komentar', 'xss_clean|required');
			$this->form_validation->set_rules('captcha_word','Captcha','xss_clean|required|callback_check_captcha');

			if ($this->form_validation->run() == TRUE) {				
				
				//$date_now = date('Y-m-d H:i:s');
				$nama = $this->input->post('nama');
				
				if(strtolower($nama) === 'administrator' || strtolower($nama) === 'admin'){
					$nama = 'Guest';
				}

				$in = array(
					'id_ekspresi'  => $param,
					'nama'         => $nama,
					'email'        => $this->input->post('email'),
					'alamat'       => $this->input->post('alamat'),
					'website'      => $this->input->post('website'),
					'komentar'     => $this->input->post('komentar'),
					'inserted_at'  => $date_now
				);				

				$this->basecrud_m->insert('ekspresi_tanggapan',$in);
				$this->session->set_flashdata("k", "<div class='alert alert-success'>Tanggapan terkirim dan Menunggu untuk di Moderasi</div>");
				redirect('tampil/ekspresi/reply/' . $param,'reload');
			
			}else{		
				$web['post'] = $this->db->query("SELECT nama,judul,isi_ekspresi,DATE(inserted_at) as tgl
				                             FROM ekspresi
				                             WHERE id = $param")->row();

				$web['tanggapan'] = $this->db->query("SELECT nama,komentar,DATE(inserted_at) as tgl 
													  FROM ekspresi_tanggapan 
					                                  WHERE id_ekspresi = $param AND tampil = 'Y'
					                                  ORDER BY inserted_at ASC");
				$cap = $this->_captcha();
				$web['captcha_image'] = $cap['image'];			
				$web['msg'] = validation_errors();			
			}

			//$this->load->view('f_ekspresi_tanggapan', $web);
			$web['page_name'] = 'f_ekspresi_tanggapan';
		
		}else{

			//pagination
			$url = base_url() . 'tampil/ekspresi/';
			$res = $this->ekspresi_m->get('numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->ekspresi_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->ekspresi_m->offset = $this->uri->segment(3);
	        }else{
	            $this->ekspresi_m->offset = 0;
	        }	

			$this->ekspresi_m->sort = 'inserted_at';
	    	$this->ekspresi_m->order = 'DESC';
	    	//end pagination
	    	
			$web['data'] = $this->ekspresi_m->get('pagging');				
			//$this->load->view('v_ekspresi', $web);
			$web['page_name'] = 'v_ekspresi';

		}

		//$this->load->view('t_footer');		
		$this->_generate_page($web);
	}
	/************************************************************************/

	/*
	public function data_siswa() {
		$web['title']	= '.:: Data Siswa Website SD Negeri Sidoharjo  ::.';
		$ke				= $this->uri->segment(3);
		$kelas			= $this->uri->segment(4);
		$web['data']	= $this->db->query("SELECT * FROM data_siswa WHERE kelas != 'L' ORDER BY kelas ASC")->result();
		
		$this->load->view('t_atas', $web);

		if ($ke == "per_kelas") {
			$web['data']	= $this->db->query("SELECT * FROM data_siswa WHERE kelas = '$kelas' ORDER BY nama ASC")->result();
		} else {
			$web['data']	= $this->db->query("SELECT * FROM data_siswa WHERE kelas != 'L' ORDER BY kelas ASC")->result();
		}
		$this->load->view('v_data_siswa', $web);
		$this->load->view('t_footer');
	}

	public function data_guru() {
		$web['title']	= '.:: Data Guru Website SD Negeri Sidoharjo  ::.';
		$ke				= $this->uri->segment(3);
		$kelas			= $this->uri->segment(4);
		$web['data']	= $this->db->query("SELECT * FROM data_guru ORDER BY nama ASC")->result();
		
		$this->load->view('t_atas', $web);
		$this->load->view('v_data_guru', $web);
		$this->load->view('t_footer');
	}
	*/

	public function blog() {
		$web['title']	= '.:: Official Website Dinas Pendidikan Provinsi Jambi ::.';		
		
		$ke				= $this->uri->segment(3);
		$id_berita		= $this->uri->segment(4);
		
		$this->load->library('pagination');
		$total_rows		= $this->db->query("SELECT * FROM berita WHERE publish = '1'")->num_rows();
		
		
		$url         = base_URL().'tampil/blog/page/';
		$total_rows  = $total_rows;
		$uri_segment = 4;
		$per_page    = 7; 
		
		$config = paginate($url,$total_rows,$per_page,$uri_segment);
		$this->pagination->initialize($config); 
		
		
		$awal	= $this->uri->segment(4); 
		if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $config['per_page'];
		
		$web['blog'] 	= $this->db->query("SELECT a.*,IF(a.sticky = 'Y',0,1) as order_sticky 
			                                FROM berita a
			                                WHERE publish = '1' 
			                                ORDER BY order_sticky ASC, tglPost DESC 
			                                LIMIT $awal, $akhir")->result();
		
		$web['page']	= $this->pagination->create_links();

		if ($ke == "baca") {
			$this->db->query("UPDATE berita SET hits = hits + 1 WHERE id = '".$id_berita."'");
			$q_ambil_berita	= $this->db->query("SELECT * FROM berita WHERE id =  '$id_berita'");
			if ($q_ambil_berita->num_rows() == NULL) {
				redirect('tampil/invalid');
			} else {
				$web['baca']	= $q_ambil_berita->row();
				
				$meta = array(
					array('name' => 'title', 'content' => $web['baca']->judul),
					array('name' => 'type', 'content' => 'article'),
					array('name' => 'url', 'content' => base_URL()),
					array('name' => 'image', 'content' => 'logo.jpg'),
					array('name' => 'site_name', 'content' => 'Website Website Dinas Pendidikan Provinsi Jambi -- '.$web['baca']->judul),
					array('name' => 'description', 'content' => 'Website Website Dinas Pendidikan Provinsi Jambi -- '.substr(addslashes(strip_tags($web['baca']->isi)), 0, 200))
				);
				
				$web['title']		= $web['baca']->judul." - Website Website Dinas Pendidikan Provinsi Jambi";
				$web['meta']		=  meta($meta);
				//$this->load->view('t_atas', $web);
				//$this->load->view('b_blog', $web);
				$web['page_name'] = 'b_blog';
				
			}
		} else {
			//$this->load->view('t_atas', $web);
			//$this->load->view('v_blog', $web);
			$web['page_name'] = 'v_blog';
		}
		
		//$this->load->view('t_footer');
		$this->_generate_page($web);
	}
	
	public function kategori() {
	
		
		$web['title']	= '.:: Berita Seputar Website Dinas Pendidikan Provinsi Jambi ::.';
		
		$this->load->library('pagination');
		$total_rows		= $this->db->query("SELECT * FROM berita WHERE kategori LIKE '%".$this->uri->segment(3)."%' AND publish = '1'")->num_rows();

		$url	= base_URL().'tampil/kategori/'.$this->uri->segment(3).'/page/';
		$total_rows	= $total_rows;
		$uri_segment= 5;
		$per_page 	= 5; 
		
		$config = paginate($url,$total_rows,$per_page,$uri_segment);
		$this->pagination->initialize($config); 
		
		$awal	= $this->uri->segment(5); 
		if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $config['per_page'];
		
		$web['blog'] 	= $this->db->query("SELECT a.*,IF(a.sticky = 'Y',0,1) as order_sticky 
			                                FROM berita a
			                                WHERE publish = '1' AND kategori LIKE '%".$this->uri->segment(3)."%' ORDER BY order_sticky ASC, tglPost DESC 
			                                LIMIT $awal, $akhir")->result();

		$web['page']	= $this->pagination->create_links();

		//$this->load->view('t_atas', $web);
		//$this->load->view('v_blog', $web);
		//$this->load->view('t_footer');
		$web['page_name'] = 'v_blog';
		$this->_generate_page($web);
	}
	
	public function post_komen() {
		$nama	= $this->security->xss_clean(addslashes($this->input->post('nama')));
		$email	= $this->security->xss_clean(addslashes($this->input->post('email')));
		$pesan	= $this->security->xss_clean(addslashes($this->input->post('pesan')));
		$id		= $this->security->xss_clean(addslashes($this->input->post('id')));
		
		if ($nama != "" || $email != "" || $pesan != "" || $id != "") {
			$this->db->query("INSERT INTO berita_komen VALUES ('', '$id', '$nama', '$email', '$pesan', NOW())");
			$this->session->set_flashdata("k", "<div class='alert alert-success'>Komentar terkirim</div>");
			redirect('tampil/blog/baca/'.$id."#komentar");
		} else {
			$this->session->set_flashdata("k", "<div class='alert alert-error'>Isikan isian dengan lengkap</div>");
			redirect('tampil/blog/baca/'.$id."#komentar");
		}
	}
	
	function galeri_video(){
		$web['title']	= '.:: Album Foto Galeri Website Dinas Pendidikan Provinsi Jambi ::.';
		$ke				= $this->uri->segment(3);
		$idu			= $this->uri->segment(4);
		$web['data']	= $this->db->query("SELECT * FROM galeri_video ORDER BY id DESC")->result();		
		$web['page_name'] = 'v_galeri_video';				
		
		$this->_generate_page($web);
	}	

	public function galeri() {
		$web['title']	= '.:: Album Foto Galeri Website Dinas Pendidikan Provinsi Jambi ::.';
		$ke				= $this->uri->segment(3);
		$idu			= $this->uri->segment(4);
		$web['data']	= $this->db->query("SELECT * FROM galeri_album ORDER BY id DESC")->result();		
		
		//$this->load->view('t_atas', $web);

		if ($ke == "lihat") {

			$gal = $this->basecrud_m->get_where('galeri_album',array('id' => $idu));
			if($gal->num_rows() == 0){
				//$this->load->view('invalid', $web);	
				$web['page_name'] = 'invalid';		
			}else{
				$web['datdet']	= $this->db->query("SELECT * FROM galeri WHERE id_album = '$idu'")->result();
				$web['datalb']	= $this->db->query("SELECT * FROM galeri_album WHERE id = '$idu'")->row();
				//$this->load->view('v_galeri_detil', $web);	
				$web['page_name'] = 'v_galeri_detil';		
			}

			
		} else {
			//$this->load->view('v_galeri', $web);
			$web['page_name'] = 'v_galeri';
		}
		
		//$this->load->view('t_footer');		
		$this->_generate_page($web);
	}
		
	public function bukutamu() {
		$web['buku_tamu']	= $this->db->query("SELECT * FROM pesan ORDER BY tgl DESC")->result();
		$web['title']		= ".:: Buku Tamu Dinas Pendidikan Provinsi Jambi ::.";
		$ke					= $this->uri->segment(3);
		
		
		//$this->load->view('t_atas', $web);
		
		/*if ($ke == "edit") {
			$web['det_pesan']	= $this->db->query("SELECT * FROM pesan WHERE id = '".$this->uri->segment(4)."'")->row();
			$this->load->view('v_bukutamu', $web);
		} else */
		
		if ($ke == "simpan") {
			$nama	= $this->input->post('nama');
			$email	= $this->input->post('email');
			$pesan	= $this->input->post('pesan');
			
			if ($nama != "" || $email != "" || $pesan != "") {
				$this->db->query("INSERT INTO pesan VALUES ('', '".$nama."', '".$email."', '".$pesan."', NOW())");
				$this->session->set_flashdata("k", "<div class='alert alert-success'>Pesan terkirim</div>");
				redirect('tampil/bukutamu');
			} else {
				$this->session->set_flashdata("k", "<div class='alert alert-error'>Isian must be lengkap</div>");
				redirect('tampil/bukutamu');
			}
		} 
		

		else {		
			//$this->load->view('v_bukutamu', $web);
			$web['page_name'] = 'v_bukutamu';		
		}		
		
		//$this->load->view('t_footer');		
		$this->_generate_page($web);
	}
	

	// Function to get the client ip address
    function _get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
     
        return $ipaddress;
    }

	/*************************************************************/
	public function post_poll() {

		//cek ip
		$ip = $this->_get_client_ip();
		$current_date = date('Y-m-d');

		$a = $this->basecrud_m->get_where('poll_stats',array('ip' => $ip , 'tgl' => $current_date));
		if($a->num_rows() > 0 ){
			$this->session->set_flashdata("k", "<div class='alert alert-danger'>Maaf, Anda sudah melakukan polling hari ini</div>");
		}else{
			$this->basecrud_m->insert('poll_stats',array('ip' => $ip , 'tgl' => $current_date));
			$id_poll	= $this->input->post('id_poll');
			$pilih		= $this->input->post('poll');
			$pilih_poll	= $this->db->query("UPDATE poll SET j_".$pilih." = (j_".$pilih."+1) WHERE id = '".$id_poll."'");
		}
		
		redirect('tampil/hasil_poll');
	}
	
	public function hasil_poll() {
		$web['title']		= ".:: Hasil Polling Website Dinas Pendidikan Provinsi Jambi ::. ";
		
		//$this->load->view('t_atas', $web);	
		//$this->load->view('v_poll');	
		//$this->load->view('t_footer');	
		$web['page_name'] = 'v_poll';
		$this->_generate_page($web);
	}

	/*****************************************************************/

	public function cari() {
		$web['title']	= '.:: Hasil Pencarian Website Dinas Pendidikan Provinsi Jambi ::.';		
		
		$ke				= $this->uri->segment(3);
		$id_berita		= $this->uri->segment(4);
		
		$q = $this->input->post('q');
		
		/*
		TODO
		cari berita
		cari nama sekolah
		cari produk hukum
		 */
		
		$web['cari_berita'] 		= $this->db->query("SELECT * FROM berita WHERE judul LIKE '%".$q."%' OR isi LIKE '%".$q."%' ")->result();
		//$web['cari_download'] 		= $this->db->query("SELECT * FROM download WHERE nama LIKE '%".$q."%' OR ket LIKE '%".$q."%' ")->result();
		//$web['cari_portofolio'] 	= $this->db->query("SELECT * FROM portofolio WHERE nama LIKE '%".$q."%' OR ket LIKE '%".$q."%' ")->result();
	
		//$this->load->view('t_atas', $web);
		//$this->load->view('v_cari', $web);
		//$this->load->view('t_footer');
		$web['page_name'] = 'v_cari';
		$this->_generate_page($web);
	}
		
	//invalid post id
	public function invalid() {
		$web['title']		= "Invalid ID ";
		//$this->load->view('t_atas', $web);
		//$this->load->view('invalid');
		//$this->load->view('t_footer');
		$web['page_name'] = 'invalid';
		$this->_generate_page($web);
	}
	
	/* UNTUK LOGIN ADMIN */
	public function login() {
		$web['info']	= "";
		$this->load->view('login', $web);
	}
	
	public function do_login() {
		$web['info']	= "";
        $u = $this->security->xss_clean($this->input->post('u'));
        $p = md5($this->security->xss_clean($this->input->post('p')));
         
		//$q_cek	= $this->db->query("SELECT * FROM admin WHERE u = '".$u."' AND p = '".$p."' AND ");
		$q_cek  = $this->basecrud_m->get_where('admin',
												array('u' => $u,
													  'p' => $p,
													  'aktif' => 'Y',
													  'terhapus' => 'N'
			                                    )
		                                      );
		$j_cek	= $q_cek->num_rows();
		$d_cek	= $q_cek->row();
		
		
        if($j_cek == 1) {
            $data = array(
					'user_id'   => $d_cek->id,                                        
					'user'      => $d_cek->u,                                        
					'validated' => true,
					'menu_list' => $d_cek->menu_list
                    );
            $this->session->set_userdata($data);
            redirect('manage/index');
        } else {	
			$web['info']	= "<div style='margin: 15px 15px -10px 15px; background: red; padding: 5px 0 5px 0; text-align: center'>Upss.. Username atau Passwod Salah</div>";
			$this->load->view('login', $web);
		}
	}

	
	/*
	public function do_login_siswa() {
		$web['info']	= "";
        $u = $this->security->xss_clean($this->input->post('user_siswa'));
        $p = md5($this->security->xss_clean($this->input->post('pass_siswa')));
         
		$q_cek	= $this->db->query("SELECT * FROM data_siswa WHERE nis = '".$u."' AND pass = '".$p."'");
		$j_cek	= $q_cek->num_rows();
		$d_cek	= $q_cek->row();
		
		
        if($j_cek == 1) {
            $data = array(
                    'siswa_id' => $d_cek->id,
                    'siswa_nis' => $d_cek->nis,
                    'siswa_nama' => $d_cek->nama,
					'siswa_validated' => true
                    );
            $this->session->set_userdata($data);
            redirect('tampil/halaman_siswa/');
        } else {	
			$this->session->set_flashdata("k", "<div class='alert alert-danger'>Maaf, anda gagal login. Username atau password Anda salah</div>");
			redirect('tampil');
		}
	}
	
	public function halaman_siswa() {
		if(! $this->session->userdata('siswa_validated')){
			$this->session->set_flashdata("k", "<div class='alert alert-danger'>Maaf, Anda HARUS Login dulu...!!!</div>");
            redirect('tampil');
        }
		
		$web['title']		= "Halaman setelah login siswa";
		$this->load->view('t_atas', $web);
		$this->load->view('v_halaman_siswa');
		$this->load->view('t_footer');
	}
	
	public function logout_siswa() {
		$array_items = array('siswa_id' => '', 'siswa_nis' => '', 'siswa_nama' => '', 'siswa_validated' => false);
		$this->session->unset_userdata($array_items);
		redirect('tampil');
	}
	*/

	function generate_event_calendar(){
		header('Content-type: text/json');
		echo "[\n";
		$separator = "";
		
		$var_agenda = $this->basecrud_m->get('tbl_agenda');		
		
		$str = "";
		foreach($var_agenda->result() as $agenda){
			
			$tgl = $agenda->tgl_mulai;
			$tgl_selesai = $agenda->tgl_selesai;
			while(strtotime($tgl) <= strtotime($tgl_selesai)){
				$str .= ' { "date": "' . date("Y-m-d H:i:00",strtotime($tgl . " " . $agenda->jam)) . '", "type": "Agenda Kegiatan", "title" : "' . $agenda->title . '", "description": "' . $agenda->content . '", "url": "#" },' . "\n";
				$tgl = date("Y-m-d",strtotime("+1 day",strtotime($tgl)));
			}			
		}
		
		echo  substr($str,0,strlen($str)-2);
		echo "]";		
	}

}