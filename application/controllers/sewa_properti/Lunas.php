<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lunas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		
		date_default_timezone_set('Asia/Jakarta');

		$user = $this->ion_auth->user()->row();
        if($user->role != 1 && $user->role !=3)
        {
            redirect(base_url()."dashboard", 'refresh');
        }
	}

	public function index()
	{
		require_once(APPPATH.'libraries/Template.php');
		$main = new template();

		$data['title'] = 'Penyewaan Properti - Lunas';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Sewa Properti' => '',
            'Lunas' => '',
        ];
        //$this->layout->set_privilege(1);

        $lastCode = $this->crud->getLastCode("sewa_properti","sewa_properti_kd","SEWA-");
		$data['code'] = $this->codegen->auto("SEWA-",$lastCode['sewa_properti_kd'],9);

		$data['kategori'] = $this->crud->getalldatatablewhere("ak_data_sewa_kategori","deleted",0);

		$main->display("sewa_properti/lunas/index",$data);
	
	}


	function get_data_sp_lunas()
    {
    	$list = $this->dtable->get_datatables_sp_lunas();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $field) {

			$aksi = '<button class="btn btn-primary btn-xs" title="Detail" onclick="preDetail('.$field->sewa_properti_id.')">Detail</button>
				<button class="btn btn-xs btn-warning" onclick="preEdit('.$field->sewa_properti_id.')" title="Edit">Edit</button>
				<button class="btn btn-danger btn-xs" title="Delete" onclick="preHapus('.$field->sewa_properti_id.')">Delete</button>';

			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $field->nama_penyewa;
			$row[] = $field->sewa_kategori_nama;
			$row[] = $field->jumlah;
			$row[] = date("d/m/Y",strtotime($field->tgl_mulai));
			$row[] = date("d/m/Y",strtotime($field->tgl_selesai));
			$row[] = $field->status_sewa;
			$row[] = "Rp. ".number_format($field->nominal,0,',','.');
			$row[] = $field->status_pembayaran;
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dtable->count_all_sp_lunas(),
			"recordsFiltered" => $this->dtable->count_filtered_sp_lunas(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

    function proses_add()
	{

			// UBAH FORMAT TANGGAL JADI TANGGAL MYSQL
	    	$tgl_mulai = $this->input->post('tgl_mulai');
			if($tgl_mulai != "" && $tgl_mulai != null)
			{
				$ubah_tglmulai = date("Y-m-d", strtotime($tgl_mulai));
			}
			else
			{
				$ubah_tglmulai = null;
			}

			$tgl_selesai = $this->input->post('tgl_selesai');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_kontrak = $this->input->post('tgl_kontrak');
			if($tgl_kontrak != "" && $tgl_kontrak != null)
			{
				$ubah_tglkontrak = date("Y-m-d", strtotime($tgl_kontrak));
			}
			else
			{
				$ubah_tglkontrak = null;
			}

			if($this->input->post("status_pembayaran") == "Hutang")
			{
				if($this->input->post("status_sewa") == "Bulanan")
				{
					// get 30 days from date
					$tgl_batas_pembayaran = date( "Y-m-d", strtotime( $ubah_tglmulai." +30 days" ) );
				}
				else
				{
					// get 360 days from date
					$tgl_batas_pembayaran = date( "Y-m-d", strtotime( $ubah_tglmulai." +360 days" ) );
				}
			}
			else
			{
				$tgl_batas_pembayaran = null;
			}

			$data = array(
				"sewa_properti_kd" => $this->input->post('sewa_properti_kd'),
				"status_pembayaran" => $this->input->post("status_pembayaran"),
				// "status_pembayaran" => "Lunas",
				"nama_penyewa" => $this->input->post('nama_penyewa'),
				"sewa_kategori_id" => $this->input->post('sewa_kategori_id'),
				"jumlah" => $this->input->post('jumlah'),
				"nominal" => $this->input->post('nominal'),
				"tgl_mulai" => $ubah_tglmulai,
				"tgl_selesai" => $ubah_tglselesai,
				"no_kontrak" => $this->input->post('no_kontrak'),
				"tgl_kontrak" => $ubah_tglkontrak,
				"status_sewa" => $this->input->post('status_sewa'),
				"tgl_batas_pembayaran" => $tgl_batas_pembayaran,

				"created_by" => $this->session->userdata('user_id'),
				"created_date" => date("Y-m-d H:i:s")
			);


			if($data['sewa_properti_kd']==null || $data['nama_penyewa']==null || $data['sewa_kategori_id']==null || $data['jumlah']==null || $data['nominal']==null || $data['tgl_mulai']==null || $data['tgl_selesai']==null || $data['no_kontrak']==null || $data['tgl_kontrak']==null || $data['status_sewa']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['sewa_properti_kd']==null) $response['message'] .= 'Kode Sewa, ';
				if($data['nama_penyewa']==null) $response['message'] .= 'Nama Penyewa, ';
				if($data['sewa_kategori_id']==null) $response['message'] .= 'Kategori Sewa, ';
				if($data['jumlah']==null) $response['message'] .= 'Banyaknya, ';
				if($data['nominal']==null) $response['message'] .= 'Nominal, ';
				if($data['tgl_mulai']==null) $response['message'] .= 'Tgl.Mulai, ';
				if($data['tgl_selesai']==null) $response['message'] .= 'Tgl.Selesai, ';
				if($data['no_kontrak']==null) $response['message'] .= 'No.Kontrak, ';
				if($data['tgl_kontrak']==null) $response['message'] .= 'Tgl.Kontrak, ';
				if($data['status_sewa']==null) $response['message'] .= 'Status Sewa, ';
				
			}
			else {
				$cek = $this->crud->getsingledatatablewhere("sewa_properti","sewa_properti_kd",$data['sewa_properti_kd']);
				if(count($cek) > 0)
				{

					$lastCode = $this->crud->getLastCode("sewa_properti","sewa_properti_kd","SEWA-");
					$data['sewa_properti_kd'] = $this->codegen->auto("SEWA-",$lastCode['sewa_properti_kd'],9);

					$response = $this->crud->allInsertSave($data,'sewa_properti');
				}
				else
				{
					$response = $this->crud->allInsertSave($data,'sewa_properti');
				}
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	function proses_edit()
	{
			$id = $this->input->post("sewa_properti_id");

			// UBAH FORMAT TANGGAL JADI TANGGAL MYSQL
	    	$tgl_mulai = $this->input->post('tgl_mulai');
			if($tgl_mulai != "" && $tgl_mulai != null)
			{
				$ubah_tglmulai = date("Y-m-d", strtotime($tgl_mulai));
			}
			else
			{
				$ubah_tglmulai = null;
			}

			$tgl_selesai = $this->input->post('tgl_selesai');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_kontrak = $this->input->post('tgl_kontrak');
			if($tgl_kontrak != "" && $tgl_kontrak != null)
			{
				$ubah_tglkontrak = date("Y-m-d", strtotime($tgl_kontrak));
			}
			else
			{
				$ubah_tglkontrak = null;
			}

			if($this->input->post("status_pembayaran") == "Hutang")
			{
				if($this->input->post("status_sewa") == "Bulanan")
				{
					// get 30 days from date
					$tgl_batas_pembayaran = date( "Y-m-d", strtotime( $ubah_tglmulai." +30 days" ) );
				}
				else
				{
					// get 360 days from date
					$tgl_batas_pembayaran = date( "Y-m-d", strtotime( $ubah_tglmulai." +360 days" ) );
				}
			}
			else
			{
				$tgl_batas_pembayaran = null;
			}

			$data = array(
				"sewa_properti_kd" => $this->input->post('sewa_properti_kd'),
				"status_pembayaran" => $this->input->post("status_pembayaran"),
				// "status_pembayaran" => "Lunas",
				"nama_penyewa" => $this->input->post('nama_penyewa'),
				"sewa_kategori_id" => $this->input->post('sewa_kategori_id'),
				"jumlah" => $this->input->post('jumlah'),
				"nominal" => $this->input->post('nominal'),
				"tgl_mulai" => $ubah_tglmulai,
				"tgl_selesai" => $ubah_tglselesai,
				"no_kontrak" => $this->input->post('no_kontrak'),
				"tgl_kontrak" => $ubah_tglkontrak,
				"status_sewa" => $this->input->post('status_sewa'),
				"tgl_batas_pembayaran" => $tgl_batas_pembayaran,

				"created_by" => $this->session->userdata('user_id'),
				"created_date" => date("Y-m-d H:i:s")
			);


			if($data['sewa_properti_kd']==null || $data['nama_penyewa']==null || $data['sewa_kategori_id']==null || $data['jumlah']==null || $data['nominal']==null || $data['tgl_mulai']==null || $data['tgl_selesai']==null || $data['no_kontrak']==null || $data['tgl_kontrak']==null || $data['status_sewa']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['sewa_properti_kd']==null) $response['message'] .= 'Kode Sewa, ';
				if($data['nama_penyewa']==null) $response['message'] .= 'Nama Penyewa, ';
				if($data['sewa_kategori_id']==null) $response['message'] .= 'Kategori Sewa, ';
				if($data['jumlah']==null) $response['message'] .= 'Banyaknya, ';
				if($data['nominal']==null) $response['message'] .= 'Nominal, ';
				if($data['tgl_mulai']==null) $response['message'] .= 'Tgl.Mulai, ';
				if($data['tgl_selesai']==null) $response['message'] .= 'Tgl.Selesai, ';
				if($data['no_kontrak']==null) $response['message'] .= 'No.Kontrak, ';
				if($data['tgl_kontrak']==null) $response['message'] .= 'Tgl.Kontrak, ';
				if($data['status_sewa']==null) $response['message'] .= 'Status Sewa, ';
				
			}
			else {
				$response = $this->crud->allEditSave($data,$id,"sewa_properti","sewa_properti_id");
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	public function getDetail($id = null) {
	    header('Content-type: text/javascript');

	    $data = $this->crud->getSewaPropertiBy($id);

	    if(count($data) > 0) {
	      echo json_encode(array(
	        'code'		    => '200',

	        "sewa_properti_id" => $data['sewa_properti_id'],
	        "sewa_properti_kd" => $data['sewa_properti_kd'],
	        "status_pembayaran" => $data['status_pembayaran'],
	        "nama_penyewa" => $data['nama_penyewa'],
	        "sewa_kategori_id" => $data['sewa_kategori_id'],
	        "jumlah" => $data['jumlah'],
	        "nominal" => $data['nominal'],
	        "tgl_mulai" => date("d-m-Y",strtotime($data['tgl_mulai'])),
	        "tgl_selesai" => date("d-m-Y",strtotime($data['tgl_selesai'])),
	        "no_kontrak" => $data['no_kontrak'],
	        "tgl_kontrak" => date("d-m-Y",strtotime($data['tgl_kontrak'])),
	        "status_sewa" => $data['status_sewa'],

		));
	    } else {
	      echo json_encode(array(
	        'code'			=> '400',
	        'status'		=> 'error',
	        'message' 	=> 'Bad Request')
	      );
	    }
	 }


	function delete($idnya){

		$data = array(
			"deleted" => 1
		);
		$response = $this->crud->allEditSave($data,$idnya,"sewa_properti","sewa_properti_id");
		header('Access-Control-Allow-Origin: *');
		echo json_encode($response);

	}




	





}
