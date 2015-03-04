<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit', '512M');

class Manage extends MY_Controller {
	

	function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta"); 
        $this->load->model(array('basecrud_m'));
    }

	public function index() {

		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */

		$m['page']		= "awal";
		$this->load->view('manage/tampil', $m);
	}
	
	/**************************@KIRANA*********************************/

	function _generate_page($data){
		$this->load->view('manage/tampil',$data);
	}

	function user($cmd = null,$param = null){

		$this->load->model('user_m');

		$admin_priv = '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20';
		$berita_priv = '1,5,6,7,14,15';

		if($cmd === 'add'){

			$data = array(
							'page'      => 'f_user',						 
							'title'     => 'Tambah User'
						  );

		}elseif($cmd === 'add_act'){
			//simpen			

			$this->form_validation->set_rules('u', 'User Name', 'xss_clean|required|is_unique[admin.u]');			
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'xss_clean');
			$this->form_validation->set_rules('level', 'Level', 'xss_clean');
			$this->form_validation->set_rules('aktif', 'Status', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$level = $this->input->post('level');
				$menu_list = $level === '1' ? $admin_priv : $berita_priv;

				$in = array(
							'u'         => $this->input->post('u'),
							'p'         => md5($this->input->post('u')),
							'nama'      => $this->input->post('nama'),
							'email'     => $this->input->post('email'),
							'level'     => $level,
							'aktif'     => $this->input->post('aktif'),
							'menu_list' => $menu_list
				);
				

				$this->basecrud_m->insert('admin',$in);
				redirect('manage/user','reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_user',							  
								'title'     => 'Tambah User'
				);
				
			}
		}elseif($cmd === 'edt'){

			$data = array(
							'page'      => 'f_user',						 
							'title'     => 'Edit User',
							'data' 		=> $this->basecrud_m->get_where('admin',array('id' => $param))->row()
						  );
			

		}elseif($cmd === 'edt_act'){

			//$this->form_validation->set_rules('u', 'User Name', 'xss_clean|required|is_unique[admin.u]');			
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'xss_clean');
			$this->form_validation->set_rules('level', 'Level', 'xss_clean');
			$this->form_validation->set_rules('aktif', 'Status', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$level = $this->input->post('level');
				$menu_list = $level == 1 ? $admin_priv : $berita_priv;

				$up = array(							
							'nama'      => $this->input->post('nama'),
							'email'     => $this->input->post('email'),
							'level'     => $level,
							'aktif'     => $this->input->post('aktif'),
							'menu_list' => $menu_list
				);
				

				$this->basecrud_m->update('admin',$param,$up);
				redirect('manage/user','reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_user',							  
								'title'     => 'Tambah User',
								'data' 		=> $this->basecrud_m->get_where('admin',array('id' => $param))->row()
				);
				
			}

		}elseif($cmd === 'del'){

			$this->basecrud_m->update('admin',$param,array('aktif'=>'N','terhapus' => 'Y'));
			redirect('manage/user','reload');	

		}else{
			//pagination
			$url = base_url() . 'manage/user/';
			$res = $this->user_m->get('numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->user_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->user_m->offset = $this->uri->segment(3);
	        }else{
	            $this->user_m->offset = 0;
	        }	

			$this->user_m->sort  = 'nama';
	    	$this->user_m->order = 'ASC';
	    	//end pagination
	    	
			$data['data'] = $this->user_m->get('pagging');				
			$data['page'] = 'v_user';

		}

		$this->_generate_page($data);
	}

	function ide_saran($cmd = null,$param = null){
		$this->load->model('ide_saran_m');

		$data = array();
		$data['title']		= "Ide Dan Saran Pengunjung";
		
		if($cmd === 'cari'){

			$filter = $_POST['filter'];
			$this->session->set_userdata('filter',$filter);
			redirect('manage/ide_saran','reload');

		}elseif($cmd === 'set_tampil'){

			$tampil = $_POST['tampil'];
			$id 	= $_POST['id'];
			$this->basecrud_m->update('ide_saran',$id,array('tampil' => $tampil));
			exit(0);

		}elseif($cmd === 'reply_set_tampil'){

			$tampil = $_POST['tampil'];
			$id 	= $_POST['id'];
			$this->basecrud_m->update('ide_saran_tanggapan',$id,array('tampil' => $tampil));
			exit(0);

		}elseif($cmd === 'reply'){

			
			$data['post'] = $this->db->query("SELECT nama,topik,DATE(inserted_at) as tgl
				                             FROM ide_saran
				                             WHERE id = $param")->row();

			$data['tanggapan'] = $this->db->query("SELECT id,nama,komentar,tampil,DATE(inserted_at) as tgl 
				                                  FROM ide_saran_tanggapan 
				                                  WHERE id_ide_saran = $param 
				                                  ORDER BY inserted_at ASC");

			if(!empty($_POST)){
				
				$this->form_validation->set_rules('komentar', 'Komentar', 'required');
				
				if ($this->form_validation->run() == TRUE) {				
					
					$date_now = date('Y-m-d H:i:s');
					
					$in = array(
						'id_ide_saran' => $param,
						'nama'         => 'Administrator',						
						'komentar'     => $this->input->post('komentar'),
						'tampil'	   => 'Y',
						'inserted_at'  => $date_now
					);				

					$this->basecrud_m->insert('ide_saran_tanggapan',$in);
					$this->session->set_flashdata("k", "<div class='alert alert-success'>Tanggapan terkirim</div>");
					redirect('manage/ide_saran/reply/' . $param,'reload');
				
				}else{					
					$web['msg'] = validation_errors();							
				}
			}

			$data['page'] = 'f_ide_saran_tanggapan';

		}elseif($cmd === 'del'){

			$this->basecrud_m->delete('ide_saran',array('id' => $param));
			redirect('manage/ide_saran','reload');

		}else{

			//pagination
			$url = base_url() . 'manage/ide_saran/';
			$res = $this->ide_saran_m->get('numrows','TRUE');
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
	    	
			$data['data'] = $this->ide_saran_m->get('pagging','TRUE');				
			$data['page'] = 'v_ide_saran';

		}

		$this->_generate_page($data);
	}

	function ekspresi($cmd = null,$param = null){
		$this->load->model('ekspresi_m');

		$data = array();
		$data['title']		= "Ekspresi Pengunjung";
		
		if($cmd === 'cari'){

			$filter = $_POST['filter'];
			$this->session->set_userdata('filter',$filter);
			redirect('manage/ekspresi','reload');
			
		}elseif($cmd === 'set_tampil'){

			$tampil = $_POST['tampil'];
			$id 	= $_POST['id'];
			$this->basecrud_m->update('ekspresi',$id,array('tampil' => $tampil));
			exit(0);

		}elseif($cmd === 'reply_set_tampil'){

			$tampil = $_POST['tampil'];
			$id 	= $_POST['id'];
			$this->basecrud_m->update('ekspresi_tanggapan',$id,array('tampil' => $tampil));
			exit(0);

		}elseif($cmd === 'reply'){

			$data['post'] = $this->db->query("SELECT nama,judul,isi_ekspresi,DATE(inserted_at) as tgl
				                              FROM ekspresi
				                              WHERE id = $param")->row();

			$data['tanggapan'] = $this->db->query("SELECT id,nama,komentar,tampil,DATE(inserted_at) as tgl 
				                                  FROM ekspresi_tanggapan 
				                                  WHERE id_ekspresi = $param 
				                                  ORDER BY inserted_at ASC");

			if(!empty($_POST)){
				
				$this->form_validation->set_rules('komentar', 'Komentar', 'required');
				
				if ($this->form_validation->run() == TRUE) {				
					
					$date_now = date('Y-m-d H:i:s');
					
					$in = array(
						'id_ekspresi' => $param,
						'nama'        => 'Administrator',						
						'komentar'    => $this->input->post('komentar'),
						'tampil'	   => 'Y',
						'inserted_at' => $date_now
					);				

					$this->basecrud_m->insert('ekspresi_tanggapan',$in);
					$this->session->set_flashdata("k", "<div class='alert alert-success'>Tanggapan terkirim</div>");
					redirect('manage/ekspresi/reply/' . $param,'reload');
				
				}else{					
					$web['msg'] = validation_errors();							
				}
			}

			$data['page'] = 'f_ekspresi_tanggapan';

		}elseif($cmd === 'del'){
			$this->basecrud_m->delete('ekspresi',array('id' => $param));
			redirect('manage/ekspresi','reload');
		}else{

			//pagination
			$url = base_url() . 'manage/ekspresi/';
			$res = $this->ekspresi_m->get('numrows','TRUE');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->ekspresi_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->ekspresi_m->offset = $this->uri->segment(3);
	        }else{
	            $this->ekspresi_m->offset = 0;
	        }	

			$this->ekspresi_m->sort  = 'inserted_at';
	    	$this->ekspresi_m->order = 'DESC';
	    	//end pagination
	    	
			$data['data'] = $this->ekspresi_m->get('pagging','TRUE');				
			$data['page'] = 'v_ekspresi';

		}

		$this->_generate_page($data);
	}


	function data_produk_hukum($cmd = null,$param = null){

		if($cmd === 'add'){

			$data = array(
							'page'      => 'f_data_produk_hukum',						 
							'title'     => 'Tambah Kategori Produk Hukum'
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'add_act'){
			//simpen			

			$this->form_validation->set_rules('judul', 'Judul Kategori', 'xss_clean|required|is_unique[data_produk_hukum.judul]');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$in = array(
							'judul'	=> $this->input->post('judul')
				);				

				$this->basecrud_m->insert('data_produk_hukum',$in);
				redirect('manage/data_produk_hukum','reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_data_produk_hukum',							  
								'title'     => 'Tambah Kategori Produk Hukum'
				);
				$this->_generate_page($data);
				
			}
		}elseif($cmd === 'edt'){

			$data = array(
							'page'      => 'f_data_produk_hukum',						 
							'title'     => 'Edit Kategori Produk Hukum',
							'data' 		=> $this->basecrud_m->get_where('data_produk_hukum',array('id' => $param))->row()
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'edt_act'){

			$this->form_validation->set_rules('judul', 'Judul Kategori', 'xss_clean|required');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$up = array(
							'judul'	=> $this->input->post('judul')
				);		
				

				$this->basecrud_m->update('data_produk_hukum',$param,$up);
				redirect('manage/data_produk_hukum','reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_data_produk_hukum',							  
								'title'     => 'Tambah Kategori Produk Hukum',								
								'data'   	=> $this->basecrud_m->get_where('data_produk_hukum',array('id' => $param))->row()
				);
				
				$this->_generate_page($data);
				
			}

		}elseif($cmd === 'del'){

			$this->basecrud_m->update('data_produk_hukum',$param,array('terhapus'=>'Y'));
			redirect('manage/data_produk_hukum','reload');			

		}else{

			//get list
			$data = array('page'	=> 'v_data_produk_hukum',
						  'title'	=> 'Data Kategori Produk Hukum',
					      'data'	=>	$this->basecrud_m->get_where('data_produk_hukum',array('terhapus' => 'N'))
					      );
			$this->_generate_page($data);
		}
	}



	function prod_hukum_list($id_produk_hukum,$cmd = null,$param = null,$param1 = null){

		$this->load->model('produk_hukum_m');

		if($cmd === 'file'){

			$data = array(	
							'data'      => $this->basecrud_m->get_where('produk_hukum_files',array('id_prod_hukum_list' => $param)),
							'page'      => 'f_prod_hukum_files',						 
							'title'     => 'Edit Dokument Produk Hukum'
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'file_add'){

			$upl_conf = array(
									'upload_path'   => './upload/download',
									'allowed_types' => 'doc|docx|zip|rar|odt|pdf',
									'encrypt_name'  => TRUE
                                  );
                
                
            $this->load->library('upload', $upl_conf);

			$judul 			= addslashes($this->input->post('judul'));
			
			if (!empty($_FILES['f_dok']['name'])) {
				
				if ($this->upload->do_upload('f_dok') == TRUE) {

					$this->upload->do_upload('f_dok');
					$up_data	 	= $this->upload->data();
					
					$this->basecrud_m->insert('produk_hukum_files',
												array('id_prod_hukum_list'  => $param,
													  'nama_file'    => $up_data['file_name'], 
													  'judul'        => $judul));
				} else {
					$this->session->set_flashdata('k', "<div class=\"alert alert-error\">".$this->upload->display_errors()."</div>");
					redirect('manage/prod_hukum_list/'.$id_produk_hukum . '/file/' . $param);
				}
				
				$this->session->set_flashdata('k', "<div class=\"alert alert-success\">File berhasil diupload</div>");
				redirect('manage/prod_hukum_list/'.$id_produk_hukum . '/file/' . $param);

			} else {
				$this->session->set_flashdata('k', "<div class=\"alert alert-error\">File masih kosong</div>");
				redirect('manage/prod_hukum_list/'.$id_produk_hukum . '/file/' . $param);
			}

		}elseif($cmd === 'file_edt'){

		}elseif($cmd === 'file_del'){
			//http://localhost/disdik/manage/prod_hukum_list/1/file/1
			$this->basecrud_m->delete('produk_hukum_files',array('id' => $param1));
			redirect('manage/prod_hukum_list/' . $id_produk_hukum . '/file/' . $param,'reload');

		}elseif($cmd === 'add'){

			$data = array(
							'page'      => 'f_prod_hukum_list',						 
							'title'     => 'Tambah Data Produk Hukum'
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'add_act'){
			//simpen			

			$this->form_validation->set_rules('nomor', 'Nomor', 'xss_clean');
			$this->form_validation->set_rules('tahun', 'Tahun', 'xss_clean|required');			
			$this->form_validation->set_rules('tentang', 'Tentang', 'xss_clean');			
			$this->form_validation->set_rules('terbit', 'Tanggal Terbit', 'xss_clean');
			
			
			if ($this->form_validation->run() == TRUE) {				
				
				$in = array(
					'id_produk_hukum' => $id_produk_hukum,
					'nomor'           => $this->input->post('nomor'),
					'tahun'           => $this->input->post('tahun'),
					'tentang'         => $this->input->post('tentang'),
					'terbit'          => $this->input->post('terbit')
				);				

				$this->basecrud_m->insert('produk_hukum_list',$in);
				redirect('manage/prod_hukum_list/' . $id_produk_hukum,'reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_prod_hukum_list',							  
								'title'     => 'Tambah Data Produk Hukum'
				);
				$this->_generate_page($data);
				
			}
		}elseif($cmd === 'edt'){

			$data = array(
							'page'      => 'f_prod_hukum_list',						 
							'title'     => 'Edit Data Produk Hukum',
							'data' 		=>  $this->basecrud_m->get_where(
												'produk_hukum_list',
												 array('id' 			 => $param,
												 	   'id_produk_hukum' => $id_produk_hukum)
											)->row()
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'edt_act'){

			$this->form_validation->set_rules('nomor', 'Nomor', 'xss_clean');
			$this->form_validation->set_rules('tahun', 'Tahun', 'xss_clean|required');			
			$this->form_validation->set_rules('tentang', 'Tentang', 'xss_clean');			
			$this->form_validation->set_rules('terbit', 'Tanggal Terbit', 'xss_clean');
			
			
			if ($this->form_validation->run() == TRUE) {				
				
				$up = array(
					'id_produk_hukum' => $id_produk_hukum,
					'nomor'           => $this->input->post('nomor'),
					'tahun'           => $this->input->post('tahun'),
					'tentang'         => $this->input->post('tentang'),
					'terbit'          => $this->input->post('terbit')
				);		
				

				$this->basecrud_m->update('produk_hukum_list',$param,$up);
				redirect('manage/prod_hukum_list/' . $id_produk_hukum,'reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_prod_hukum_list',							  
								'title'     => 'Edit Data Produk Hukum',								
								'data' 		=> $this->basecrud_m->get_where(
												'produk_hukum_list',
												 array('id' 			 => $param,
												 	   'id_produk_hukum' => $id_produk_hukum))->row()
				);
				
				$this->_generate_page($data);
				
			}

		}elseif($cmd === 'del'){

			$this->basecrud_m->update('produk_hukum_list',$param,array('terhapus'=>'Y'));
			redirect('manage/prod_hukum_list/' . $id_produk_hukum,'reload');			

		}else{
			//http://localhost/disdik/manage/prod_hukum_list/1
			
			$url = base_url() . 'manage/prod_hukum_list/' . $id_produk_hukum . '/';
			$res = $this->produk_hukum_m->get($id_produk_hukum,'numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,4);
			$this->pagination->initialize($config);

			$this->produk_hukum_m->limit = $per_page;
			if($this->uri->segment(4) == TRUE){
				$this->produk_hukum_m->offset = $this->uri->segment(4);
			}else{
				$this->produk_hukum_m->offset = 0;
			}	

			$this->produk_hukum_m->sort = 'tahun DESC ,nomor DESC';
			//$this->produk_hukum_m->order = 'ASC';
			//end pagination

			//get list
			$data = array('page'	=> 'v_prod_hukum_list',
						  'title'	=> 'Daftar Data Produk Hukum',
					      'data'	=>	$this->produk_hukum_m->get($id_produk_hukum,'pagging'));
			$this->_generate_page($data);
			/*get list
			$data = array('page'	=> 'v_prod_hukum_list',
						  'title'	=> 'Daftar Data Produk Hukum',
					      'data'	=>	$this->basecrud_m->get_where('produk_hukum_list',
					      	array('terhapus' => 'N','id_produk_hukum' => $id_produk_hukum),"tahun DESC ,nomor DESC"," ")
					      );
			$this->_generate_page($data);
			*/
		}
	}
	

	function kategori_berita($cmd = null,$param = null){
		

		if($cmd === 'add'){

			$data = array(
							'page'      => 'f_kategori',						 
							'title'     => 'Tambah Kategori'
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'add_act'){
			//simpen			

			$this->form_validation->set_rules('nama', 'Nama Kategori', 'xss_clean|required|is_unique[kat.nama]');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$in = array(
							'nama'				 => $this->input->post('nama')
				);
				

				$this->basecrud_m->insert('kat',$in);
				redirect('manage/kategori_berita','reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_kategori',							  
								'title'     => 'Tambah Kategori'
				);
				$this->_generate_page($data);
				
			}
		}elseif($cmd === 'edt'){

			$data = array(
							'page'      => 'f_kategori',						 
							'title'     => 'Edit Kategori',
							'data' 		=> $this->basecrud_m->get_where('kat',array('id' => $param))->row()
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'edt_act'){

			$this->form_validation->set_rules('nama', 'Nama Kategori', 'xss_clean|required');			
			
			if ($this->form_validation->run() == TRUE) {				
				
				$up = array(
							'nama'               => $this->input->post('nama')
							);
				

				$this->basecrud_m->update('kat',$param,$up);
				redirect('manage/kategori_berita','reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_kategori',							  
								'title'     => 'Tambah Kategori',								
								'data'   	=> $this->basecrud_m->get_where('kat',array('id' => $param))
				);
				
				$this->_generate_page($data);
				
			}

		}elseif($cmd === 'del'){

			$this->basecrud_m->update('kat',$param,array('terhapus'=>'Y'));
			redirect('manage/kategori_berita','reload');			

		}else{
			
			$data = array('page'	=> 'v_kategori',
						  'title'	=> 'Data Kategori',
					      'data'	=>	$this->basecrud_m->get_where('kat',array('terhapus' => 'N'))
					      );
			$this->_generate_page($data);
		}
	}


	function data_sekolah($cmd = null,$param = null){

		$this->load->model(array('datasekolah_m'));

		if($cmd === 'cari'){

			$this->form_validation->set_rules('cari', 'Text Cari', 'xss_clean');
			$this->form_validation->set_rules('jenjang', 'Jenjang', 'xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				$this->session->set_userdata('cari',$this->input->post('cari'));
				$this->session->set_userdata('jenjang',$this->input->post('jenjang'));
				$this->session->set_userdata('status',$this->input->post('status'));
			}
			 
			redirect('manage/data_sekolah','reload');

		}elseif($cmd === 'clear_search'){

			$this->session->unset_userdata('cari');
			$this->session->unset_userdata('jenjang');
			$this->session->unset_userdata('status');

			redirect('manage/data_sekolah','reload');

		}elseif($cmd === 'add'){

			$data = array(
							'page'      => 'f_data_sekolah',						 
							'title'     => 'Tambah Data Sekolah',
							'kabupaten' => $this->basecrud_m->get_where('kabupaten',array('id_propinsi' => '1'))
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'add_act'){
			//simpen			

			$this->form_validation->set_rules('npsn', 'Nomor Pokok Sekolah Nasional', 'xss_clean|required|is_unique[data_sekolah.npsn]');
			//$this->form_validation->set_rules('nss', 'Nomor Statistik Sekolah', 'xss_clean|required|is_unique[data_sekolah.nss]');
			$this->form_validation->set_rules('nama', 'Nama Sekolah', 'xss_clean|required');
			//$this->form_validation->set_rules('id_propinsi', 'Propinsi', 'xss_clean|required');
			$this->form_validation->set_rules('id_kabupaten', 'Kabupaten / Kota', 'xss_clean|required');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');
			$this->form_validation->set_rules('kodepos', 'Kodepos', 'xss_clean');
			$this->form_validation->set_rules('no_telp', 'Nomor Telephon', 'xss_clean');
			$this->form_validation->set_rules('no_faks', 'Nomor Faks', 'xss_clean');
			$this->form_validation->set_rules('email', 'email', 'xss_clean|valid_email');
			$this->form_validation->set_rules('waktu_persekolahan', 'Waktu Persekolahan', 'xss_clean');
			$this->form_validation->set_rules('akreditasi', 'Akreditasi', 'xss_clean');
			$this->form_validation->set_rules('jenjang', 'Jenjang', 'xss_clean|required');
			$this->form_validation->set_rules('jumlah_ruang', 'Jumlah Ruang', 'xss_clean');
			$this->form_validation->set_rules('jumlah_lahan', 'Jumlah Lahan', 'xss_clean');
			$this->form_validation->set_rules('jumlah_gedung', 'Jumlah Gedung', 'xss_clean');
			$this->form_validation->set_rules('jumlah_kelas', 'Jumlah Kelas', 'xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'xss_clean');
			$this->form_validation->set_rules('website', 'Website', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$in = array(
							'npsn'				 => $this->input->post('npsn'),
							//'nss'                => $this->input->post('nss'),
							'nama'               => $this->input->post('nama'),
							//'id_propinsi'        => $this->input->post('id_propinsi'),							
							'id_kabupaten'       => $this->input->post('id_kabupaten'),
							'alamat'             => $this->input->post('alamat'),						    					        
							'kodepos'            => $this->input->post('kodepos'),
							'no_telp'            => $this->input->post('no_telp'),
							'no_faks'            => $this->input->post('no_faks'),
							'email'              => $this->input->post('email'),
							'waktu_persekolahan' => $this->input->post('waktu_persekolahan'),
							'akreditasi'         => $this->input->post('akreditasi'),
							'jenjang'            => $this->input->post('jenjang'),
							'jumlah_ruang'       => $this->input->post('jumlah_ruang'),
							'jumlah_lahan'       => $this->input->post('jumlah_lahan'),
							'jumlah_gedung'      => $this->input->post('jumlah_gedung'),
							'jumlah_kelas'       => $this->input->post('jumlah_kelas'),
							'status'             => $this->input->post('status'),
							'website'            => $this->input->post('website')
							);
				

				$this->basecrud_m->insert('data_sekolah',$in);
				redirect('manage/data_sekolah','reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_data_sekolah',							  
								'title'     => 'Tambah Data Sekolah',
								'kabupaten' => $this->basecrud_m->get_where('kabupaten',array('id_propinsi' => '1'))
					);
				$this->_generate_page($data);
				
			}
		}elseif($cmd === 'edt'){

			$data = array(
							'page'      => 'f_data_sekolah',						 
							'title'     => 'Edit Data Sekolah',
							'kabupaten' => $this->basecrud_m->get_where('kabupaten',array('id_propinsi' => '1')),
							'data'   => $this->basecrud_m->get_where('data_sekolah',array('id' => $param))->row()
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'edt_act'){

			$this->form_validation->set_rules('npsn', 'Nomor Pokok Sekolah Nasional', 'xss_clean|required');			
			//$this->form_validation->set_rules('nss', 'Nomor Statistik Sekolah', 'xss_clean|required');
			$this->form_validation->set_rules('nama', 'Nama Sekolah', 'xss_clean|required');
			//$this->form_validation->set_rules('id_propinsi', 'Propinsi', 'xss_clean|required');
			$this->form_validation->set_rules('id_kabupaten', 'Kabupaten / Kota', 'xss_clean|required');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');
			$this->form_validation->set_rules('kodepos', 'Kodepos', 'xss_clean');
			$this->form_validation->set_rules('no_telp', 'Nomor Telephon', 'xss_clean');
			$this->form_validation->set_rules('no_faks', 'Nomor Faks', 'xss_clean');
			$this->form_validation->set_rules('email', 'email', 'xss_clean|valid_email');
			$this->form_validation->set_rules('waktu_persekolahan', 'Waktu Persekolahan', 'xss_clean');
			$this->form_validation->set_rules('akreditasi', 'Akreditasi', 'xss_clean');
			$this->form_validation->set_rules('jenjang', 'Jenjang', 'xss_clean|required');
			$this->form_validation->set_rules('jumlah_ruang', 'Jumlah Ruang', 'xss_clean');
			$this->form_validation->set_rules('jumlah_lahan', 'Jumlah Lahan', 'xss_clean');
			$this->form_validation->set_rules('jumlah_gedung', 'Jumlah Gedung', 'xss_clean');
			$this->form_validation->set_rules('jumlah_kelas', 'Jumlah Kelas', 'xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'xss_clean');
			$this->form_validation->set_rules('website', 'Website', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$up = array(
							'npsn'               => $this->input->post('npsn'),
							//'nss'                => $this->input->post('nss'),
							'nama'               => $this->input->post('nama'),
							//'id_propinsi'        => $this->input->post('id_propinsi'),							
							'id_kabupaten'       => $this->input->post('id_kabupaten'),
							'alamat'             => $this->input->post('alamat'),						    					        
							'kodepos'            => $this->input->post('kodepos'),
							'no_telp'            => $this->input->post('no_telp'),
							'no_faks'            => $this->input->post('no_faks'),
							'email'              => $this->input->post('email'),
							'waktu_persekolahan' => $this->input->post('waktu_persekolahan'),
							'akreditasi'         => $this->input->post('akreditasi'),
							'jenjang'            => $this->input->post('jenjang'),
							'jumlah_ruang'       => $this->input->post('jumlah_ruang'),
							'jumlah_lahan'       => $this->input->post('jumlah_lahan'),
							'jumlah_gedung'      => $this->input->post('jumlah_gedung'),
							'jumlah_kelas'       => $this->input->post('jumlah_kelas'),
							'status'             => $this->input->post('status'),
							'website'            => $this->input->post('website')
							);
				

				$this->basecrud_m->update('data_sekolah',$param,$up);
				redirect('manage/data_sekolah','reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_data_sekolah',							  
								'title'     => 'Tambah Data Sekolah',
								'kabupaten' => $this->basecrud_m->get_where('kabupaten',array('id_propinsi' => '1')),
								'data'   => $this->basecrud_m->get_where('data_sekolah',array('id' => $param))->row()
				);
				
				$this->_generate_page($data);
				
			}

		}elseif($cmd === 'del'){

			$this->basecrud_m->update('data_sekolah',$param,array('terhapus'=>'Y'));
			redirect('manage/data_sekolah','reload');			

		}else{

			//pagination
			$url = base_url() . 'manage/data_sekolah/';
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

			//get list
			$data = array('page'	=> 'v_data_sekolah',
						  'title'	=> 'Data Sekolah',
					      'data'	=>	$this->datasekolah_m->get('pagging'));
			$this->_generate_page($data);
		}
	}


	function sekolah_stats($id_sekolah,$cmd = null, $param = null){
		$this->load->model(array('sekolahstats_m'));

		if($cmd === 'add'){

			$data = array(
							'page'      => 'f_sekolah_stats',						 
							'title'     => 'Tambah Data Statistik'
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'add_act'){
			//simpen			
			$this->form_validation->set_rules('tahun', 'Tahun', 'xss_clean|is_unique[sekolah_stats.tahun]');			
			$this->form_validation->set_rules('rombel', 'Jumlah Rombongan Belajar', 'xss_clean');
			$this->form_validation->set_rules('murid', 'Jumlah Murid', 'xss_clean');
			$this->form_validation->set_rules('guru', 'Jumlah Guru', 'xss_clean');						
			$this->form_validation->set_rules('ruang_kelas', 'Jumlah Ruang Kelas', 'xss_clean');			
			$this->form_validation->set_rules('lulusan', 'Jumlah Lulusan', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$in = array(
							'id_sekolah'  => $id_sekolah,	
							'tahun'       => $this->input->post('tahun'),
							'rombel'      => $this->input->post('rombel'),
							'murid'       => $this->input->post('murid'),							
							'guru'        => $this->input->post('guru'),
							'ruang_kelas' => $this->input->post('ruang_kelas'),						    					        
							'lulusan'     => $this->input->post('lulusan')
				);		
				
               
               $this->basecrud_m->insert('sekolah_stats',$in);
			   redirect('manage/sekolah_stats/' . $id_sekolah ,'reload');				
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_sekolah_stats',							  
								'title'     => 'Tambah Data Statistik'
					);
				$this->_generate_page($data);
				
			}
		}elseif($cmd === 'edt'){

			$data = array(
							'page'      => 'f_sekolah_stats',						 
							'title'     => 'Edit Data Statistik',
							'data'  	=> $this->basecrud_m->get_where('sekolah_stats',array('id' => $param))->row()
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'edt_act'){

			$this->form_validation->set_rules('tahun', 'Tahun', 'xss_clean|required');			
			$this->form_validation->set_rules('rombel', 'Jumlah Rombongan Belajar', 'xss_clean');
			$this->form_validation->set_rules('murid', 'Jumlah Murid', 'xss_clean');
			$this->form_validation->set_rules('guru', 'Jumlah Guru', 'xss_clean');						
			$this->form_validation->set_rules('ruang_kelas', 'Jumlah Ruang Kelas', 'xss_clean');			
			$this->form_validation->set_rules('lulusan', 'Jumlah Lulusan', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$up = array(
							'id_sekolah'  => $id_sekolah,	
							'tahun'       => $this->input->post('tahun'),
							'rombel'      => $this->input->post('rombel'),
							'murid'       => $this->input->post('murid'),							
							'guru'        => $this->input->post('guru'),
							'ruang_kelas' => $this->input->post('ruang_kelas'),						    					        
							'lulusan'     => $this->input->post('lulusan')
				);		
				

				$this->basecrud_m->update('sekolah_stats',$param,$up);
				redirect('manage/sekolah_stats/' . $id_sekolah ,'reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_sekolah_stats',							  
								'title'     => 'Edit Data Statistik',
								'data'   	=> $this->basecrud_m->get_where('sekolah_stats',array('id' => $param))->row()
				);
				
				$this->_generate_page($data);
				
			}

		}elseif($cmd === 'del'){

			//$this->basecrud_m->update('sekolah_stats',$param,array('terhapus'=>'Y'));
			$this->basecrud_m->delete('sekolah_stats',array('id' => $param));
			redirect('manage/sekolah_stats/' . $id_sekolah, 'reload');			

		}else{

			//pagination
			$url = base_url() . 'manage/sekolah_stats/' . $id_sekolah . '/';
			$res = $this->sekolahstats_m->get($id_sekolah,'numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,4);
			$this->pagination->initialize($config);

			$this->sekolahstats_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
            	$this->sekolahstats_m->offset = $this->uri->segment(4);
	        }else{
	            $this->sekolahstats_m->offset = 0;
	        }	

			$this->sekolahstats_m->sort = 'tahun';
        	$this->sekolahstats_m->order = 'DESC';
        	//end pagination

			//get list
			$data = array('page'	=> 'v_sekolah_stats',
						  'title'	=> 'Data Guru',
					      'data'	=>	$this->sekolahstats_m->get($id_sekolah,'pagging'));
			$this->_generate_page($data);

		}
	}

	function data_guru($id_sekolah,$cmd = null, $param = null){
		$this->load->model(array('dataguru_m'));

		if($cmd === 'cari'){

			$this->form_validation->set_rules('cari', 'Text Cari', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				$this->session->set_userdata('cari',$this->input->post('cari'));
			}
			 
			redirect('manage/data_guru/' . $id_sekolah ,'reload');

		}elseif($cmd === 'clear_search'){

			$this->session->unset_userdata('cari');			
			redirect('manage/data_guru/' . $id_sekolah ,'reload');

		}elseif($cmd === 'add'){

			$data = array(
							'page'      => 'f_data_guru',						 
							'title'     => 'Tambah Data Guru'
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'add_act'){
			//simpen			
			$this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'xss_clean|is_unique[data_guru.nip]');
			$this->form_validation->set_rules('nuptk', 'NUPTK', 'xss_clean|required|is_unique[data_guru.nuptk]');
			$this->form_validation->set_rules('nama', 'Nama Guru', 'xss_clean|required');
			$this->form_validation->set_rules('status', 'Status', 'xss_clean|required');
			$this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'xss_clean');						
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'xss_clean');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$in = array(
							'id_sekolah' => $id_sekolah,	
							'nip'        => $this->input->post('nip'),
							'nuptk'      => $this->input->post('nuptk'),
							'nama'       => $this->input->post('nama'),							
							'status'     => $this->input->post('status'),
							'mapel'      => $this->input->post('mapel'),						    					        
							'jk'         => $this->input->post('jk'),
							'alamat'     => $this->input->post('alamat')
				);
				
				$upl_conf = array(
									'upload_path'   => './upload',
									'allowed_types' => 'jpeg|jpg|png|bmp',
									'encrypt_name'  => TRUE
                                  );
                
                
                $this->load->library('upload', $upl_conf);
                
                $msg = null;

                if(!empty($_FILES['foto']['name'])){
                    
                    if (!$this->upload->do_upload('foto')){                    
                    	$msg = $this->upload->display_errors();                       	                 
                    }else{
                        $success = $this->upload->data();
                        $ins['foto'] =  $success['file_name'];
                    }      
                }
               
               $this->basecrud_m->insert('data_sekolah',$in);
			   redirect('manage/data_guru/' . $id_sekolah ,'reload');				
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_data_guru',							  
								'title'     => 'Tambah Data Guru'
					);
				$this->_generate_page($data);
				
			}
		}elseif($cmd === 'edt'){

			$data = array(
							'page'      => 'f_data_guru',						 
							'title'     => 'Edit Data Guru',
							'data'  	=> $this->basecrud_m->get_where('data_guru',array('id' => $param))->row()
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'edt_act'){

			$this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'xss_clean|required');
			$this->form_validation->set_rules('nuptk', 'NUPTK', 'xss_clean|required');
			$this->form_validation->set_rules('nama', 'Nama Guru', 'xss_clean|required');
			$this->form_validation->set_rules('status', 'Status', 'xss_clean|required');
			$this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'xss_clean');						
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'xss_clean');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$up = array(
							'nip'    => $this->input->post('nip'),
							'nuptk'  => $this->input->post('nuptk'),
							'nama'   => $this->input->post('nama'),							
							'status' => $this->input->post('status'),
							'mapel'  => $this->input->post('mapel'),						    					        
							'jk'     => $this->input->post('jk'),
							'alamat' => $this->input->post('alamat')
				);
				

				$this->basecrud_m->update('data_guru',$param,$up);
				redirect('manage/data_guru/' . $id_sekolah ,'reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_data_sekolah',							  
								'title'     => 'Tambah Data Sekolah',
								'data'   	=> $this->basecrud_m->get_where('data_guru',array('id' => $param))->row()
				);
				
				$this->_generate_page($data);
				
			}

		}elseif($cmd === 'del'){

			$this->basecrud_m->update('data_guru',$param,array('terhapus'=>'Y'));
			redirect('manage/data_guru/' . $id_sekolah, 'reload');			

		}else{

			//pagination
			$url = base_url() . 'manage/data_guru/' . $id_sekolah . '/';
			$res = $this->dataguru_m->get($id_sekolah,'numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,4);
			$this->pagination->initialize($config);

			$this->dataguru_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
            	$this->dataguru_m->offset = $this->uri->segment(4);
	        }else{
	            $this->dataguru_m->offset = 0;
	        }	

			$this->dataguru_m->sort = 'nama';
        	$this->dataguru_m->order = 'ASC';
        	//end pagination

			//get list
			$data = array('page'	=> 'v_data_guru',
						  'title'	=> 'Data Guru',
					      'data'	=>	$this->dataguru_m->get($id_sekolah,'pagging'));
			$this->_generate_page($data);

		}
	}

	function data_siswa($id_sekolah,$cmd = null,$param = null){
		$this->load->model(array('datasiswa_m'));

		if($cmd === 'cari'){

			$this->form_validation->set_rules('cari', 'Text Cari', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				$this->session->set_userdata('cari',$this->input->post('cari'));
			}
			 
			redirect('manage/data_siswa/' . $id_sekolah ,'reload');

		}elseif($cmd === 'clear_search'){

			$this->session->unset_userdata('cari');			
			redirect('manage/data_siswa/' . $id_sekolah ,'reload');

		}elseif($cmd === 'add'){

			$data = array(
							'page'      => 'f_data_siswa',						 
							'title'     => 'Tambah Data Siswa'
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'add_act'){
			//simpen			
			$this->form_validation->set_rules('nisn', 'NISN', 'xss_clean|is_unique[data_siswa.nisn]');			
			$this->form_validation->set_rules('nama', 'Nama Sekolah', 'xss_clean|required');
			$this->form_validation->set_rules('jurusan', 'jurusan', 'xss_clean');
			$this->form_validation->set_rules('kelas', 'Kelas', 'xss_clean');						
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'xss_clean');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$in = array(
							'id_sekolah' => $id_sekolah,	
							'nisn'       => $this->input->post('nisn'),
							'nama'       => $this->input->post('nama'),
							'jurusan'    => $this->input->post('jurusan'),							
							'kelas'      => $this->input->post('kelas'),							
							'jk'         => $this->input->post('jk'),
							'alamat'     => $this->input->post('alamat')
				);
				
				$upl_conf = array(
									'upload_path'   => './upload',
									'allowed_types' => 'jpeg|jpg|png|bmp',
									'encrypt_name'  => TRUE
                                  );
                
                
                $this->load->library('upload', $upl_conf);
                
                $msg = null;

                if(!empty($_FILES['foto']['name'])){
                    
                    if (!$this->upload->do_upload('foto')){                    
                    	$msg = $this->upload->display_errors();                    
                    }else{
                        $success = $this->upload->data();
                        $ins['foto'] =  $success['file_name'];
                    }      
                }
               
               $this->basecrud_m->insert('data_siswa',$in);
			   redirect('manage/data_siswa/' . $id_sekolah ,'reload');				
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_data_siswa',							  
								'title'     => 'Tambah Data Siswa'
					);
				$this->_generate_page($data);
				
			}
		}elseif($cmd === 'edt'){

			$data = array(
							'page'      => 'f_data_siswa',						 
							'title'     => 'Edit Data Siswa',
							'data'  	=> $this->basecrud_m->get_where('data_siswa',array('id' => $param))->row()
						  );
			$this->_generate_page($data);

		}elseif($cmd === 'edt_act'){

			$this->form_validation->set_rules('nisn', 'NISN', 'xss_clean|required');			
			$this->form_validation->set_rules('nama', 'Nama Sekolah', 'xss_clean|required');
			$this->form_validation->set_rules('jurusan', 'jurusan', 'xss_clean');
			$this->form_validation->set_rules('kelas', 'Kelas', 'xss_clean');						
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'xss_clean');			
			$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');
			
			if ($this->form_validation->run() == TRUE) {				
				
				$up = array(
							'id_sekolah' => $id_sekolah,	
							'nisn'       => $this->input->post('nisn'),
							'nama'       => $this->input->post('nama'),
							'jurusan'    => $this->input->post('jurusan'),							
							'kelas'      => $this->input->post('kelas'),							
							'jk'         => $this->input->post('jk'),
							'alamat'     => $this->input->post('alamat')
				);
				

				$this->basecrud_m->update('data_siswa',$param,$up);
				redirect('manage/data_siswa/' . $id_sekolah ,'reload');
			
			}else{
				
				$data = array(
								'msg'       => validation_errors(),
								'page'      => 'f_data_siswa',							  
								'title'     => 'Tambah Data Siswa',
								'data'   	=> $this->basecrud_m->get_where('data_siswa',array('id' => $param))->row()
				);
				
				$this->_generate_page($data);
				
			}

		}elseif($cmd === 'del'){

			$this->basecrud_m->update('data_siswa',$param,array('terhapus'=>'Y'));
			redirect('manage/data_siswa/' . $id_sekolah, 'reload');			

		}else{

			//pagination
			$url = base_url() . 'manage/data_siswa/' . $id_sekolah . '/';
			$res = $this->datasiswa_m->get($id_sekolah,'numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,4);
			$this->pagination->initialize($config);

			$this->datasiswa_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
            	$this->datasiswa_m->offset = $this->uri->segment(4);
	        }else{
	            $this->datasiswa_m->offset = 0;
	        }	

			$this->datasiswa_m->sort = 'nama';
        	$this->datasiswa_m->order = 'ASC';
        	//end pagination

			//get list
			$data = array('page'	=> 'v_data_siswa',
						  'title'	=> 'Data Siswa',
					      'data'	=>	$this->datasiswa_m->get($id_sekolah,'pagging')
			);

			$this->_generate_page($data);

		}
	}




	/***************************************************************************************/

	public function haldep() {
		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$id						= $this->uri->segment(4);
		
		//view tampilan website\
		$m['haldep']		= $this->db->query("SELECT * FROM haldep")->row();
		$m['page']			= "v_haldep";		
		
		if ($mau_ke == "act_edit") {
			$this->db->query("UPDATE haldep SET isi = '".addslashes($this->input->post('isi'))."' WHERE id = '1'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Berhasil diupdate </div>");
			redirect('manage/haldep');
		} else {
			$m['page']	= "v_haldep";
		}

		$this->load->view('manage/tampil', $m);
	}
		
	public function blog() {

		/*
		<img src="<?php echo base_url() . 'timthumb?src=/uploade/' . $img->img_name . '&h=292&w=866&zc=1';?>" alt="" width="866" height="292" />                            
		 */

		//$this->load->model(array('basecrud_m'));

		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */
		
		
		
		

		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$id						= $this->uri->segment(4);
		
		//view tampilan website\
		//$m['blog']		= $this->db->query("SELECT * FROM berita ORDER BY tglPost DESC")->result();
		//$m['page']		= "v_berita";		
		
		if($mau_ke === 'cari'){

			$cari = $_POST['cari'];
			$this->session->set_userdata('cari',$cari);
			redirect('manage/blog','reload');

		}elseif ($mau_ke == "del") {
			
			$q_gbr		= get_value("berita", "id", $id);
			$gbr		= $q_gbr->gambar;
			$this->db->query("DELETE FROM berita WHERE id = '$id'");
			$path 		= './upload/post/'.$gbr;
			@unlink($path);
			//@unlink('./upload/post/small/S_'.$gbr);
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil dihapuskan </div>");
			redirect('manage/blog');

		} else if ($mau_ke == "pub") {
			
			$this->db->query("UPDATE berita SET publish = '1' WHERE id = '$id'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Status postingan : Dipublikasikan </div>");
			redirect('manage/blog');

		} else if ($mau_ke == "unpub") {
			
			$this->db->query("UPDATE berita SET publish = '0' WHERE id = '$id'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Status postingan : Draft </div>");
			redirect('manage/blog');

		} else if ($mau_ke == "add") {

			$m['page']	= "f_berita";

		} else if ($mau_ke == "edit") {
			
			$id_news			= $this->uri->segment(4);
			$m['berita_pilih']	= $this->db->query("SELECT * FROM berita WHERE id = '".$id_news."'")->row();	
			$m['page']			= "f_berita";

		} else if ($mau_ke == "act_add") {
			
			$q_get_kat	= $this->db->query("SELECT * FROM kat ORDER BY id ASC")->result();
					
			$kat = "";
			if (array_key_exists('kategori', $_POST) && !empty($_POST['kategori'])){

				$kategori = $this->input->post('kategori');
				$kat = implode('-',$kategori);
				$kat = "$kat";
			}
		
			$date_now = date('Y-m-d H:i:s');
			//konfigurasi upload file
			
			$this->load->library('upload');
			
			$config['upload_path'] 		= 'upload/post';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp';
			$config['max_size']			= '6000';
			$config['max_width']  		= '6000';
			$config['max_height']  		= '6000';
			$config['encrypt_name']     = TRUE;

			$this->upload->initialize($config);
			
			if (!empty($_FILES['file_gambar']['name'])) {

				if ($this->upload->do_upload('file_gambar')) {
					$img_data	 	= $this->upload->data();
					
					//konfigurasi upload file
					$config['upload_path'] 		= 'upload/post';
					$config['allowed_types'] 	= 'pdf|rar|zip';					
					$config['encrypt_name']     = TRUE;
							
					$this->upload->initialize($config);

					if (!empty($_FILES['file_dokumen']['name'])) {
						if ($this->upload->do_upload('file_dokumen')) {
							//upload gambar ama dokumen	
							$doc_data	 	= $this->upload->data();
							$in = array(
										'judul'     => $this->input->post('judul'),
										'gambar'    => $img_data['file_name'],
										'file_name' => $doc_data['file_name'],
										'isi'       => $this->input->post('isi'),
										'tglPost'   => $date_now,
										'kategori'  => $kat,
										'oleh'      => 'admin',
										'publish'   => '1',
										'sticky'    => $this->input->post('sticky')
										);
							$this->basecrud_m->insert('berita',$in);
							
							$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil ditambahkan bersama gambarnya dan dokumen</div>");
							redirect('manage/blog');
						}else{
							//error
							$m['page']	= "f_berita"; 
							$this->session->set_flashdata("k", "<div class=\"alert alert-important\">".$this->upload->display_errors()."</div>");
							redirect('manage/blog/act_add');
						}
					}else{
						//upload gambar doang
						$in = array(
									'judul'     => $this->input->post('judul'),
									'gambar'    => $img_data['file_name'],									
									'isi'       => $this->input->post('isi'),
									'tglPost'   => $date_now,
									'kategori'  => $kat,
									'oleh'      => 'admin',
									'publish'   => '1',
									'sticky'    => $this->input->post('sticky')
									);
						$this->basecrud_m->insert('berita',$in);
						
						$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil ditambahkan bersama gambarnya Tanpa dokumen</div>");
						redirect('manage/blog');
					}				

				} else {
					$m['page']	= "f_berita";
					$this->session->set_flashdata("k", "<div class=\"alert alert-important\">".$this->upload->display_errors()."</div>");
					redirect('manage/blog/act_add');
				}

			} else {

				//konfigurasi upload file
				$config['upload_path'] 		= 'upload/post';
				$config['allowed_types'] 	= 'pdf|rar|zip';					
				$config['encrypt_name']     = TRUE;
						
				$this->upload->initialize($config);
				
				if (!empty($_FILES['file_dokumen']['name'])) {
					if ($this->upload->do_upload('file_dokumen')) {
						//upload dokumen	
						$doc_data	 	= $this->upload->data();
						$in = array(
									'judul'     => $this->input->post('judul'),								
									'file_name' => $doc_data['file_name'],
									'isi'       => $this->input->post('isi'),
									'tglPost'   => $date_now,
									'kategori'  => $kat,
									'oleh'      => 'admin',
									'publish'   => '1',
									'sticky'    => $this->input->post('sticky')
									);
						$this->basecrud_m->insert('berita',$in);
						
						$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil ditambahkan bersama dokumen Tanpa gambar</div>");
						redirect('manage/blog');
					}else{
						//error 
						$m['page']	= "f_berita";
						$this->session->set_flashdata("k", "<div class=\"alert alert-important\">".$this->upload->display_errors(). $_FILES['file_dokumen']['type'] . "</div>");
						redirect('manage/blog/act_add');
					}
				}else{
					//tanpa upload gambar ama documen
					$in = array(
								'judul'     => $this->input->post('judul'),																
								'isi'       => $this->input->post('isi'),
								'tglPost'   => $date_now,
								'kategori'  => $kat,
								'oleh'      => 'admin',
								'publish'   => '1',
								'sticky'    => $this->input->post('sticky')
								);
					$this->basecrud_m->insert('berita',$in);
					
					$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil ditambahkan Tanpa gambar dan dokumen</div>");
					redirect('manage/blog');
				}	

			}
			
		} else if ($mau_ke == "act_edit") {
			
			$kat_update = "";
			if (array_key_exists('kategori', $_POST) && !empty($_POST['kategori'])){
				$kategori = $this->input->post('kategori');
				$kat = implode('-',$kategori);
				$kat_update = ", kategori = '$kat'";
			}

			$this->load->library('upload');
			
			$config['upload_path'] 		= 'upload/post';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp';
			$config['max_size']			= '6000';
			$config['max_width']  		= '6000';
			$config['max_height']  		= '6000';
			$config['encrypt_name']     = TRUE;

			$this->upload->initialize($config);
			
			if (!empty($_FILES['file_gambar']['name'])) {	
				
				if ($this->upload->do_upload('file_gambar')) {
					$img_data	 	= $this->upload->data();
					
					
					$q_gbr		= get_value("berita", "id", $this->input->post('id_data'));
					$gbr		= $q_gbr->gambar;
					$path 		= './upload/post/'.$gbr;
					@unlink($path);

					//konfigurasi upload file
					$config['upload_path'] 		= 'upload/post';
					$config['allowed_types'] 	= 'pdf|rar|zip';					
					$config['encrypt_name']     = TRUE;
							
					$this->upload->initialize($config);

					if (!empty($_FILES['file_dokumen']['name'])) {
						if ($this->upload->do_upload('file_dokumen')) {
							//upload gambar ama dokumen	
							$doc_data	 	= $this->upload->data();

							$this->db->query("UPDATE berita 
											  SET  judul = '".addslashes($this->input->post('judul'))."', 
											       sticky = '".addslashes($this->input->post('sticky'))."', 
											       gambar = '".$img_data['file_name']."', 
											       file_name = '".$doc_data['file_name']."',
											       isi = '".addslashes($this->input->post('isi'))."' 
											       $kat_update 
											  WHERE id = '".$this->input->post('id_data')."'");
					
							$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil diupdate bersama gambar dan dokumen</div>");
							redirect('manage/blog');

						}else{
							//error
							$m['page']	= "f_berita"; 
							$this->session->set_flashdata("k", "<div class=\"alert alert-important\">".$this->upload->display_errors()."</div>");
							redirect('manage/blog/edit/'.$this->input->post('id_data'));
						}
					}else{
						//upload gambar doang
						$this->db->query("UPDATE berita 
										  SET  judul = '".addslashes($this->input->post('judul'))."', 
										       sticky = '".addslashes($this->input->post('sticky'))."', 
										       gambar = '".$img_data['file_name']."', 											       
										       isi = '".addslashes($this->input->post('isi'))."' 
										       $kat_update 
										  WHERE id = '".$this->input->post('id_data')."'");
					
						$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil diupdate bersama gambar tanpa dokumen</div>");
						redirect('manage/blog');
					}
					
					
				} else {
					$m['page']	= "f_berita"; 
					$this->session->set_flashdata("k", "<div class=\"alert alert-error\">".$this->upload->display_errors()."</div>");
					redirect('manage/blog/edit/'.$this->input->post('id_data'));
				}

			} else {

				//konfigurasi upload file
				$config['upload_path'] 		= 'upload/post';
				$config['allowed_types'] 	= 'pdf|rar|zip';					
				$config['encrypt_name']     = TRUE;
						
				$this->upload->initialize($config);

				if (!empty($_FILES['file_dokumen']['name'])) {
					if ($this->upload->do_upload('file_dokumen')) {
						//upload dokumen	
						$doc_data	 	= $this->upload->data();

						$this->db->query("UPDATE berita 
										  SET  judul = '".addslashes($this->input->post('judul'))."', 
										       sticky = '".addslashes($this->input->post('sticky'))."', 
										       file_name = '".$doc_data['file_name']."', 											       
										       isi = '".addslashes($this->input->post('isi'))."' 
										       $kat_update 
										  WHERE id = '".$this->input->post('id_data')."'");
					
						$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil diupdate bersama dokumen tanpa gambar</div>");
						redirect('manage/blog');

					}else{
						$m['page']	= "f_berita"; 
						$this->session->set_flashdata("k", "<div class=\"alert alert-error\">".$this->upload->display_errors()."</div>");
						redirect('manage/blog/edit/'.$this->input->post('id_data'));
					}
				}else{

					$this->db->query("UPDATE berita 
						              SET  judul = '".addslashes($this->input->post('judul'))."', 
						                   sticky = '".addslashes($this->input->post('sticky'))."', 
						                   isi = '".addslashes($this->input->post('isi'))."' 
						                   $kat_update 
						              WHERE id = '".$this->input->post('id_data')."'");
					
					$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil diedit tanpa gambar dan dokumen</div>");
					redirect('manage/blog');
				}	
			}			

		} else {

			$this->load->model('berita_m');

			//pagination
			$url = base_url() . 'manage/blog/';
			$res = $this->berita_m->get('numrows');
			$per_page = 10;
			$config = paginate($url,$res,$per_page,3);
			$this->pagination->initialize($config);

			$this->berita_m->limit = $per_page;
			if($this->uri->segment(3) == TRUE){
	        	$this->berita_m->offset = $this->uri->segment(3);
	        }else{
	            $this->berita_m->offset = 0;
	        }	

			$this->berita_m->sort = "order_sticky ASC , tglPost DESC";
	    	//$this->berita_m->order = 'DESC';
	    	//end pagination
	    	
			$m['blog'] = $this->berita_m->get('pagging');				
			$m['page'] = 'v_berita';

			//$m['page']	= "v_berita";
		}

		$this->load->view('manage/tampil', $m);
	}
	
	public function galeri() {
		
		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */

		//konfigurasi upload file
		$config['upload_path'] 		= 'upload/galeri';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp';
		$config['max_size']			= '6000';
		$config['max_width']  		= '6000';
		$config['max_height']  		= '6000';
		$config['encrypt_name']     = TRUE;

		$this->load->library('upload', $config);
		
		$ke			= $this->uri->segment(3);
		$idu		= $this->uri->segment(4);
			
		$m['data']	= $this->db->query("SELECT * FROM galeri_album")->result();
		
		$m['page']	= "v_galeri";
		
		if($ke === 'set_slideshow'){

			$id	= addslashes($this->input->post('id'));
			$act = addslashes($this->input->post('act'));

			if($act === 'add_slide'){
				$this->basecrud_m->update('galeri',$id,array('slideshow' => 'Y'));
			}else{
				$this->basecrud_m->update('galeri',$id,array('slideshow' => 'N'));
			}

		}elseif ($ke === "add_album") {

			$nama_album	= addslashes($this->input->post('nama_album'));
			$this->db->query("INSERT INTO galeri_album VALUES ('', '$nama_album')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Album berhasil ditambahkan</div>");
			redirect('manage/galeri');

		} else if ($ke === "del_album") {
			
			$gambar	= $this->db->query("SELECT file FROM galeri WHERE id_album = '$idu'")->result();
			foreach ($gambar as $g) {
				@unlink('./upload/galeri/'.$g->file);
				@unlink('./upload/galeri/small/S_'.$g->file);
			}
			$this->db->query("DELETE FROM galeri WHERE id_album = '$idu'");
			$this->db->query("DELETE FROM galeri_album WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Album berhasil dihapus</div>");
			redirect('manage/galeri');

		} else if ($ke === "atur") {
			
			$m['datdet']	= $this->db->query("SELECT * FROM galeri WHERE id_album = '$idu'")->result();
			$m['detalb']	= $this->db->query("SELECT * FROM galeri_album WHERE id = '$idu'")->row();
			
			$m['page']		= "v_galeri_detil";

		} else if ($ke === "rename_album") {
			
			$id_alb1		= $this->input->post('id_alb1');
			$nama_album		= addslashes($this->input->post('nama_album'));
			$this->db->query("UPDATE galeri_album SET nama = '$nama_album' WHERE id = '$id_alb1'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Album berhasil diubah namanya</div>");
			redirect('manage/galeri/atur/'.$id_alb1);

		} else if ($ke === "upload_foto") {
			
			$id_alb2		= $this->input->post('id_alb2');
			$judul 			= addslashes($this->input->post('judul'));
			$ket			= addslashes($this->input->post('ket'));
			$slideshow      = addslashes($this->input->post('slideshow'));

			if (!empty($_FILES['foto']['name'])) {
				
				if ($this->upload->do_upload('foto') == TRUE) {

					$this->upload->do_upload('foto');
					$up_data	 	= $this->upload->data();
					//gambarSmall($up_data, "galeri");
				
					//$this->db->query("INSERT INTO galeri VALUES ('', '$id_alb2', '".$up_data['file_name']."', '$ket')");
					//
					$this->basecrud_m->insert('galeri',array('id_album'  => $id_alb2,
															 'file'      => $up_data['file_name'], 
															 'judul'     => $judul , 
															 'ket'       => $ket,
															 'slideshow' => $slideshow));
				} else {
					$this->session->set_flashdata('k', "<div class=\"alert alert-error\">".$this->upload->display_errors()."</div>");
					redirect('manage/galeri/atur/'.$id_alb2);
				}
				
				$this->session->set_flashdata('k', "<div class=\"alert alert-success\">Gambar berhasil diupload</div>");
				redirect('manage/galeri/atur/'.$id_alb2);	

			} else {
				$this->session->set_flashdata('k', "<div class=\"alert alert-error\">Gambar masih kosong</div>");
				redirect('manage/galeri/atur/'.$id_alb2);		
			}

		}elseif ($ke === "del_foto") {

			$id_foto		= $this->uri->segment(5);
			
			$q_ambil_foto	= $this->db->query("SELECT file FROM galeri WHERE id = '$id_foto'")->row();
			
			@unlink('./upload/galeri/'.$q_ambil_foto->file);
			//@unlink('./upload/galeri/small/S_'.$q_ambil_foto->file);
			
			$this->db->query("DELETE FROM galeri WHERE id = '$id_foto'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Foto berhasil dihapus</div>");
			redirect('manage/galeri/atur/'.$idu);

		}elseif($ke === 'edit_foto'){

			$id_foto		= $this->uri->segment(5);

			if(!empty($_POST)){

				$this->form_validation->set_rules('judul', 'Judul', 'xss_clean|required');
				$this->form_validation->set_rules('ket', 'keterangan', 'xss_clean');

				$msg = null;
				if ($this->form_validation->run() == TRUE) {

					$up = array('judul' => $this->input->post('judul'),
								'ket' => $this->input->post('ket'),
								'slideshow' => $this->input->post('slideshow'));

					if(!empty($_FILES['foto']['name'])){                    
	                    if (!$this->upload->do_upload('foto')){                    
	                    	$msg = $this->upload->display_errors();                       	                 
	                    }else{
	                        $success = $this->upload->data();
	                        $up['file'] =  $success['file_name'];
	                    }      
	                }
               		
               		$this->basecrud_m->update('galeri',$id_foto,$up);
               		$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil diupdate</div>");
					redirect('manage/galeri/atur/'.$idu);

				}else{
					$m['msg'] = $msg . ' <br>' . validation_errors();
				}	

			}

			//TODO:
			$m['data']	= $this->db->query("SELECT * FROM galeri WHERE id = $id_foto")->row();
			$m['datdet']	= $this->db->query("SELECT * FROM galeri WHERE id_album = '$idu'")->result();
			$m['detalb']	= $this->db->query("SELECT * FROM galeri_album WHERE id = '$idu'")->row();
			
			$m['page']		= "v_galeri_detil";

		}else {
			
			$m['page']	= "v_galeri";

		}
		
		$this->load->view('manage/tampil', $m);
	}


	public function link() {
		
		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */
		
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		
		//variabel post
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
		$alamat					= addslashes($this->input->post('alamat'));
		
		//view tampilan website\
		$m['data']		= $this->db->query("SELECT * FROM link")->result();
		$m['page']		= "v_link";		
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM link WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil dihapuskan </div>");
			redirect('manage/link');
		} else if ($mau_ke == "add") {
			$m['page']	= "f_link";
		} else if ($mau_ke == "edit") {
			$m['datpil']		= $this->db->query("SELECT * FROM link WHERE id = '$idu'")->row();	
			$m['page']			= "f_link";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO link VALUES ('', '$nama', '$alamat')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil ditambahkan</div>");
			redirect('manage/link');
		} else if ($mau_ke == "act_edit") {			
			$this->db->query("UPDATE link SET nama = '$nama',  alamat = '$alamat' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil diedit</div>");
			redirect('manage/link');
		} else {
			$m['page']	= "v_link";
		}

		$this->load->view('manage/tampil', $m);
	}
	
	public function agenda() {
		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */
		
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);

		//variabel post
		$idp					= addslashes($this->input->post('idp'));
		$tgl					= addslashes($this->input->post('tgl'));
		$ket					= addslashes($this->input->post('ket'));
		$tempat					= addslashes($this->input->post('tempat'));
		
		//view tampilan website\
		$m['data']		= $this->db->query("SELECT * FROM tbl_agenda ORDER BY tgl_mulai DESC")->result();
		$m['page']		= "v_agenda";		
		
		if ($mau_ke == "del") {
			
			$this->db->query("DELETE FROM tbl_agenda WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil dihapuskan </div>");
			redirect('manage/agenda');

		} else if ($mau_ke == "add") {

			$m['title']	= "Tambah Agenda";
			$m['page']	= "f_agenda";

		} else if ($mau_ke == "edit") {
			
			$m['datpil'] = $this->db->query("SELECT * FROM tbl_agenda WHERE id = '$idu'")->row();	
			$m['page']   = "f_agenda";
			$m['title']  = "Edit Agenda";


		} else if ($mau_ke == "act_add") {
			
			$in = array('title' => $this->input->post('title'),
						'tgl_mulai' => $this->input->post('tgl_mulai'),
						'tgl_selesai' => $this->input->post('tgl_selesai'),
						'lokasi' => $this->input->post('lokasi'),
						'jam' => $this->input->post('jam'),
						'content' => $this->input->post('content')
						);

			//$this->db->query("INSERT INTO agenda VALUES ('', '$tgl', '$ket', '$tempat')");
			$this->basecrud_m->insert('tbl_agenda',$in);
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil ditambahkan</div>");
			redirect('manage/agenda');

		} else if ($mau_ke == "act_edit") {			
			
			$ed = array('title' => $this->input->post('title'),
						'tgl_mulai' => $this->input->post('tgl_mulai'),
						'tgl_selesai' => $this->input->post('tgl_selesai'),
						'lokasi' => $this->input->post('lokasi'),
						'jam' => $this->input->post('jam'),
						'content' => $this->input->post('content')
						);

			$this->basecrud_m->update('tbl_agenda',$idp,$ed);
			//$this->db->query("UPDATE agenda SET tgl = '$tgl',  ket = '$ket' tempat = '$tempat' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil diedit</div>");
			redirect('manage/agenda');

		} else {
			
			$m['page']	= "v_agenda";
			$m['title']	= "Daftar Agenda";
		}

		$this->load->view('manage/tampil', $m);
	}
	
	/*
	public function kategori() {
		
		
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        
		
		$mau_ke					= $this->uri->segment(3);
		$id						= $this->uri->segment(4);
		
		//view tampilan website\
		$m['kategori']	= $this->db->query("SELECT * FROM kat")->result();
		$m['page']		= "v_kategori";		
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM kat WHERE id = '$id'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Kategori berhasil dihapuskan </div>");
			redirect('manage/kategori');
		} else if ($mau_ke == "add") {
			$m['page']	= "f_kategori";
		} else if ($mau_ke == "edit") {
			$id_kategori		= $this->uri->segment(4);
			$m['kat_pilih']		= $this->db->query("SELECT * FROM kat WHERE id = '".$id_kategori."'")->row();	
			$m['page']			= "f_kategori";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO kat VALUES ('', '".$this->input->post('nama')."')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Kategori berhasil ditambahkan</div>");
			redirect('manage/kategori');
		} else if ($mau_ke == "act_edit") {			
			$this->db->query("UPDATE kat SET  nama = '".addslashes($this->input->post('nama'))."' WHERE id = '".$this->input->post('id_data')."'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Kategori berhasil diedit</div>");
			redirect('manage/kategori');
		} else {
			$m['page']	= "v_kategori";
		}

		$this->load->view('manage/tampil', $m);
	}
	*/
	
	public function profil() {
		
		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */
		
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		//var post 
		$idp		= addslashes($this->input->post('idp'));
		$judul		= addslashes($this->input->post('judul'));
		$isi		= $this->input->post('isi');
		//view tampilan website\
		$m['data']	= $this->db->query("SELECT * FROM profil")->result();
		$m['page']		= "v_profil";		
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM profil WHERE id = '$id'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil dihapuskan </div>");
			redirect('manage/profil');
		} else if ($mau_ke == "add") {
			$m['page']	= "f_profil";
		} else if ($mau_ke == "edit") {
			$m['datpil']		= $this->db->query("SELECT * FROM profil WHERE id = '".$idu."'")->row();	
			$m['page']			= "f_profil";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO profil VALUES ('', '$judul', '$isi')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil ditambahkan</div>");
			redirect('manage/profil');
		} else if ($mau_ke == "act_edit") {			
			
			$this->db->query("UPDATE profil SET  judul = '$judul', isi = '$isi' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil diedit</div>");
			
			redirect('manage/profil');
		} else {
			$m['page']	= "v_profil";
		}

		$this->load->view('manage/tampil', $m);
	}


	/*
	public function data_informasi() {
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
		
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		//var post 
		$idp		= addslashes($this->input->post('idp'));
		$judul		= addslashes($this->input->post('judul'));
		$isi		= addslashes($this->input->post('isi'));
		//view tampilan website\
		$m['data']	= $this->db->query("SELECT * FROM data_informasi")->result();
		$m['page']		= "v_data_informasi";		
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM data_informasi WHERE id = '$id'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil dihapuskan </div>");
			redirect('manage/data_informasi');
		} else if ($mau_ke == "add") {
			$m['page']	= "f_data_informasi";
		} else if ($mau_ke == "edit") {
			$m['datpil']		= $this->db->query("SELECT * FROM data_informasi WHERE id = '".$idu."'")->row();	
			$m['page']			= "f_data_informasi";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO data_informasi VALUES ('', '$judul', '$isi')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil ditambahkan</div>");
			redirect('manage/data_informasi');
		} else if ($mau_ke == "act_edit") {			
			$this->db->query("UPDATE data_informasi SET  judul = '$judul', isi = '$isi' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil diedit</div>");
			redirect('manage/data_informasi');
		} else {
			$m['page']	= "v_data_informasi";
		}

		$this->load->view('manage/tampil', $m);
	}*/
	
	/*
	public function data_produk_hukum() {
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
		
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		//var post 
		$idp		= addslashes($this->input->post('idp'));
		$judul		= addslashes($this->input->post('judul'));
		$isi		= addslashes($this->input->post('isi'));
		//view tampilan website\
		$m['data']	= $this->db->query("SELECT * FROM data_produk_hukum")->result();
		$m['page']		= "v_data_produk_hukum";		
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM data_produk_hukum WHERE id = '$id'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil dihapuskan </div>");
			redirect('manage/data_produk_hukum');
		} else if ($mau_ke == "add") {
			$m['page']	= "f_data_produk_hukum";
		} else if ($mau_ke == "edit") {
			$m['datpil']		= $this->db->query("SELECT * FROM data_produk_hukum WHERE id = '".$idu."'")->row();	
			$m['page']			= "f_data_produk_hukum";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO data_produk_hukum VALUES ('', '$judul', '$isi')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil ditambahkan</div>");
			redirect('manage/data_produk_hukum');
		} else if ($mau_ke == "act_edit") {			
			$this->db->query("UPDATE data_produk_hukum SET  judul = '$judul', isi = '$isi' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil diedit</div>");
			redirect('manage/data_produk_hukum');
		} else {
			$m['page']	= "v_data_produk_hukum";
		}

		$this->load->view('manage/tampil', $m);
	}
	*/

	public function komentar() {
		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
		*/
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$id						= $this->uri->segment(4);
		
		//view tampilan website\
		$m['komen']		= $this->db->query("SELECT * FROM berita_komen")->result();
		$m['page']		= "v_komen";		
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM berita_komen WHERE id = '$id'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil dihapuskan </div>");
			redirect('manage/komentar');
		} else if ($mau_ke == "add") {
			$m['page']	= "f_komen";
		} else if ($mau_ke == "edit") {
			$id			= $this->uri->segment(4);
			$m['komen_pilih']	= $this->db->query("SELECT * FROM berita_komen WHERE id = '".$id."'")->row();	
			$m['page']			= "f_komen";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO berita_komen VALUES ('', '', '".addslashes($this->input->post('nama'))."', '".addslashes($this->input->post('email'))."', '".addslashes($this->input->post('pesan'))."', NOW())");
					
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil ditambahkan</div>");
			redirect('manage/komentar');			
		} else if ($mau_ke == "act_edit") {
			$this->db->query("UPDATE berita_komen SET  nama = '".addslashes($this->input->post('nama'))."', email = '".addslashes($this->input->post('email'))."', komentar = '".addslashes($this->input->post('pesan'))."' WHERE id = '".$this->input->post('id_data')."'");
					
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data berhasil diupdate</div>");
			redirect('manage/komentar');
		} else {
			$m['page']	= "v_komen";
		}

		$this->load->view('manage/tampil', $m);
	}
	
	/*
	public function komentar_by_post() {
		
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        
		
		//ambil variabel URL
		$id						= $this->uri->segment(3);
		
		//view tampilan website\
		$m['komen']		= $this->db->query("SELECT * FROM berita_komen WHERE id_berita = '$id'")->result();
		$m['page']		= "v_komen";		
		$this->load->view('manage/tampil', $m);
	}
	*/
	
	public function bukutamu() {
		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$id						= $this->uri->segment(4);
		
		//view tampilan website\
		$m['pesan']		= $this->db->query("SELECT * FROM pesan")->result();
		$m['page']		= "v_bukutamu";		
		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM pesan WHERE id = '$id'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil dihapuskan </div>");
			redirect('manage/bukutamu');
		} else if ($mau_ke == "add") {
			$m['page']	= "f_bukutamu";
		} else if ($mau_ke == "edit") {
			$id			= $this->uri->segment(4);
			$m['pesan_pilih']	= $this->db->query("SELECT * FROM pesan WHERE id = '".$id."'")->row();	
			$m['page']			= "f_bukutamu";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO pesan VALUES ('', '".addslashes($this->input->post('nama'))."', '".addslashes($this->input->post('email'))."', '".addslashes($this->input->post('pesan'))."', NOW())");
					
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Bukutamu berhasil ditambahkan</div>");
			redirect('manage/bukutamu');			
		} else if ($mau_ke == "act_edit") {
			$this->db->query("UPDATE pesan SET  nama = '".addslashes($this->input->post('nama'))."', email = '".addslashes($this->input->post('email'))."', pesan = '".addslashes($this->input->post('pesan'))."' WHERE id = '".$this->input->post('id_data')."'");
					
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Postingan berhasil diupdate</div>");
			redirect('manage/bukutamu');
		} else {
			$m['page']	= "v_bukutamu";
		}

		$this->load->view('manage/tampil', $m);
	}
	
	public function passwod() {
		/*
		if(! $this->session->userdata('validated')){
            redirect('tampil/login');
        }
        */
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$user_id = $this->session->userdata('user_id');

		//view tampilan website\
		$m['user']		= $this->db->query("SELECT * FROM admin WHERE id = $user_id")->row();
		$m['page']		= "f_passwod";		
		
		if ($mau_ke == "simpan") {
			/*$this->db->query("UPDATE admin 
				              SET  u = '".$this->input->post('u3')."', 
				                   p = '".$this->input->post('p3')."' 
				              WHERE id = $user_id");
			*/
			
			$up = array();

			if(!empty($_POST['p_lama'])){

				$this->form_validation->set_rules('p_lama','Password Lama','xss_clean|required');
		        $this->form_validation->set_rules('p_baru','Password Baru','xss_clean|required');
		        $this->form_validation->set_rules('p_ulangi','Password Ulangan','xss_clean|required|matches[p_baru]');
		        
		        if($this->form_validation->run() == TRUE){ 

		        	if($m['user']->p !== md5($this->input->post('p_lama'))){
		        		$this->session->set_flashdata("k", "<div class=\"alert alert-important\">Password Lama Salah</div>");
						redirect('manage/passwod');
		        	}

		        	$up['p']	= md5($this->input->post('p_baru'));

		        }else{
		        	$this->session->set_flashdata("k", "<div class=\"alert alert-important\">" . validation_errors() ."</div>");
					redirect('manage/passwod');
		        }
			}

			$this->form_validation->set_rules('nama','Nama Lengkap','xss_clean|required');
	        $this->form_validation->set_rules('email','Email','xss_clean|required');
	        
	        if($this->form_validation->run() == TRUE){ 

	        	$up['nama']	= $this->input->post('nama');
	        	$up['email'] = $this->input->post('email');

	        	$this->basecrud_m->update('admin',$user_id,$up);
	        	$this->session->set_flashdata("k", "<div class=\"alert alert-success\">Data Berhasil DiUpdate</div>");
				redirect('manage/passwod');

	        }else{
	        	$this->session->set_flashdata("k", "<div class=\"alert alert-important\">" . validation_errors() ."</div>");
				redirect('manage/passwod');
	        }

			
		} else {
			$m['page']	= "f_passwod";
		}

		$this->load->view('manage/tampil', $m);
	}
	
	public function logout(){
        $this->session->sess_destroy();
        redirect('tampil/login');
    }
}
