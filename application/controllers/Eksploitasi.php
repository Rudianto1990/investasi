<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eksploitasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		
		date_default_timezone_set('Asia/Jakarta');

		$user = $this->ion_auth->user()->row();
        if($user->role != 1 && $user->role !=2)
        {
            redirect(base_url()."dashboard", 'refresh');
        }
	}

	public function index()
	{
		require_once(APPPATH.'libraries/Template.php');
		$main = new template();

		$data['title'] = 'Eksploitasi';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Eksploitasi' => '',
        ];
        //$this->layout->set_privilege(1);

        $lastCode = $this->crud->getLastCode("ak_data_eksploitasi","eksploitasi_kd","EXP-");
		$data['code'] = $this->codegen->auto("EXP-",$lastCode['eksploitasi_kd'],9);

		$data['bidang'] = $this->crud->getalldatatablewhere("ak_data_bidang","deleted",0);

		$data['vendor'] = $this->crud->getalldatatablewhere("ak_data_vendor","deleted",0);

		$main->display("eksploitasi/index",$data);
	
	}


	function get_data_eksploitasi()
    {
    	$list = $this->dtable->get_datatables_eksploitasi();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $field) {

			$aksi = '<button class="btn btn-xs btn-warning" onclick="preEdit('.$field->eksploitasi_id.')" title="Edit">Edit</button>
				<button class="btn btn-info btn-xs" title="Adendum" onclick="preAdendum('.$field->eksploitasi_id.')">Adendum</button>
				<button class="btn btn-danger btn-xs" title="Delete" onclick="preHapus('.$field->eksploitasi_id.')">Delete</button>';


			// $cek_adendum = $this->crud->getAdendumEksploitasiBy($field->eksploitasi_id);
			// if($cek_adendum['created_date'] == null)
			if($field->eksploitasi_selesai_pekerjaan != null)
            {
                $tanggal1 = new DateTime(date("Y-m-d"));
                $tanggal2 = new DateTime(date("Y-m-d",strtotime($field->eksploitasi_selesai_pekerjaan)));
                // $selisih_hari = date_diff($tanggal2,$tanggal1);

                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

                if($selisih_hari >= 30)
                {
	                // if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
	                // {
	                    // $indikator = "<span class='label label-default' style='background:#777;color:#fafafa;'>".$selisih_hari->format("%r%a")." hari</span>";
	                    $indikator = "<span><i class='fa fa-circle' style='color:lime;'></i></span>";
	                }
	                elseif($selisih_hari < 30 && $selisih_hari >= 21)
	                {
	                    // $indikator = "<span class='label label-danger'>".$selisih_hari->format("%r%a")." hari</span>";
	                    $indikator = "<span><i class='fa fa-circle' style='color:yellow;'></i></span>";
	                }
	                elseif($selisih_hari < 21 && $selisih_hari >= 14)
	                {
	                    // $indikator = "<span class='label label-danger'>".$selisih_hari->format("%r%a")." hari</span>";
	                    $indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
	                }
	                else
	                {
	                	// $indikator = "<span class='label label-danger'>".$selisih_hari->format("%r%a")." hari</span>";
	                	$indikator = "<span><i class='fa fa-circle' style='color:purple;'></i></span>";
	                }
                }

           /*--Batas1    
            else
                {
                	// $indikator = "N/A";
                	$indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
                }
                
            }
             else
            {
            	$indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
            }

           Batas 2 */

            // else
            // {

            //     $tanggal1 = date_create(date("Y-m-d"));
            //     $tanggal2 = date_create(date("Y-m-d",strtotime($cek_adendum['created_date'])));
            //     $selisih_hari = date_diff($tanggal2,$tanggal1);

                
	           //  if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
	           //  {	                    
	           //          $indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
	           //  }
	           //  elseif($selisih_hari->format("%r%a") >= 15 && $selisih_hari->format("%r%a") <= 27)
	           //  {
	           //          $indikator = "<span><i class='fa fa-circle' style='color:yellow;'></i></span>";
	           //  }
	           //  elseif($selisih_hari->format("%r%a") >= 28 && $selisih_hari->format("%r%a") <= 30)
	           //  {	                    
	           //          $indikator = "<span><i class='fa fa-circle' style='color:green;'></i></span>";
	           //  }
	           //  else
	           //  {	                	
	           //      	$indikator = "<span><i class='fa fa-circle' style='color:purple;'></i></span>";
	           //  }
                
            // }


			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $field->eksploitasi_po_number;
			$row[] = $field->bidang_nama;
			$row[] = $field->eksploitasi_uraian_pekerjaan;
			$row[] = $field->vendor_nama;
			$row[] = "Rp. ".number_format($field->eksploitasi_nilai_pekerjaan,0,',','.');
			$row[] = date("d/m/Y",strtotime($field->eksploitasi_mulai_pelaksanaan));
			$row[] = $indikator;
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dtable->count_all_eksploitasi(),
			"recordsFiltered" => $this->dtable->count_filtered_eksploitasi(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

    function proses_add()
	{

			// UBAH FORMAT TANGGAL JADI TANGGAL MYSQL
	    	$tgl_mulai = $this->input->post('eksploitasi_mulai_pelaksanaan');
			if($tgl_mulai != "" && $tgl_mulai != null)
			{
				$ubah_tglmulai = date("Y-m-d", strtotime($tgl_mulai));
			}
			else
			{
				$ubah_tglmulai = null;
			}

			$tgl_selesai = $this->input->post('eksploitasi_selesai_pekerjaan');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_jaminan = $this->input->post('eksploitasi_tanggal_jaminan_pelaksanaan');
			if($tgl_jaminan != "" && $tgl_jaminan != null)
			{
				$ubah_tgljaminan = date("Y-m-d", strtotime($tgl_jaminan));
			}
			else
			{
				$ubah_tgljaminan = null;
			}

			$data = array(
				"eksploitasi_kd" => $this->input->post('eksploitasi_kd'),
				"vendor_id" => $this->input->post('vendor_id'),
				"bidang_id" => $this->input->post('bidang_id'),
				"eksploitasi_pr_number" => $this->input->post('eksploitasi_pr_number'),
				"eksploitasi_po_number" => $this->input->post('eksploitasi_po_number'),
				"eksploitasi_uraian_pekerjaan" => $this->input->post('eksploitasi_uraian_pekerjaan'),
				"eksploitasi_no_kontrak" => $this->input->post('eksploitasi_no_kontrak'),
				"eksploitasi_nilai_pekerjaan" => $this->input->post('eksploitasi_nilai_pekerjaan'),
				"eksploitasi_mulai_pelaksanaan" => $ubah_tglmulai,
				"eksploitasi_selesai_pekerjaan" => $ubah_tglselesai,
				"eksploitasi_tanggal_jaminan_pelaksanaan" => $ubah_tgljaminan,

				"created_by" => $this->session->userdata('user_id'),
				"created_date" => date("Y-m-d H:i:s")
			);


			if($data['eksploitasi_kd']==null || $data['vendor_id']==null || $data['bidang_id']==null || $data['eksploitasi_pr_number']==null || $data['eksploitasi_po_number']==null || $data['eksploitasi_uraian_pekerjaan']==null || $data['eksploitasi_no_kontrak']==null || $data['eksploitasi_nilai_pekerjaan']==null || $data['eksploitasi_mulai_pelaksanaan']==null || $data['eksploitasi_selesai_pekerjaan']==null || $data['eksploitasi_tanggal_jaminan_pelaksanaan']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['eksploitasi_kd']==null) $response['message'] .= 'Kode Eksploitasi, ';
				if($data['vendor_id']==null) $response['message'] .= 'Vendor, ';
				if($data['bidang_id']==null) $response['message'] .= 'Bidang, ';
				if($data['eksploitasi_pr_number']==null) $response['message'] .= 'PR Number, ';
				if($data['eksploitasi_po_number']==null) $response['message'] .= 'PO Number, ';
				if($data['eksploitasi_uraian_pekerjaan']==null) $response['message'] .= 'Uraian Pekerjaan, ';
				if($data['eksploitasi_no_kontrak']==null) $response['message'] .= 'Kontrak, ';
				if($data['eksploitasi_nilai_pekerjaan']==null) $response['message'] .= 'Nilai Pekerjaan, ';
				if($data['eksploitasi_mulai_pelaksanaan']==null) $response['message'] .= 'Mulai Pekerjaan, ';
				if($data['eksploitasi_selesai_pekerjaan']==null) $response['message'] .= 'Selesai Pekerjaan, ';
				if($data['eksploitasi_tanggal_jaminan_pelaksanaan']==null) $response['message'] .= 'Jaminan Selesai, ';
			}
			else {
				$cek = $this->crud->getsingledatatablewhere("ak_data_eksploitasi","eksploitasi_kd",$data['eksploitasi_kd']);
				if(count($cek) > 0)
				{

					$lastCode = $this->crud->getLastCode("ak_data_eksploitasi","eksploitasi_kd","EXP-");
					$data['eksploitasi_kd'] = $this->codegen->auto("EXP-",$lastCode['eksploitasi_kd'],9);

					$response = $this->crud->allInsertSave($data,'ak_data_eksploitasi');
				}
				else
				{
					$response = $this->crud->allInsertSave($data,'ak_data_eksploitasi');
				}
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	function proses_edit()
	{
			$id = $this->input->post("eksploitasi_id");

			// UBAH FORMAT TANGGAL JADI TANGGAL MYSQL
	    	$tgl_mulai = $this->input->post('eksploitasi_mulai_pelaksanaan');
			if($tgl_mulai != "" && $tgl_mulai != null)
			{
				$ubah_tglmulai = date("Y-m-d", strtotime($tgl_mulai));
			}
			else
			{
				$ubah_tglmulai = null;
			}

			$tgl_selesai = $this->input->post('eksploitasi_selesai_pekerjaan');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_jaminan = $this->input->post('eksploitasi_tanggal_jaminan_pelaksanaan');
			if($tgl_jaminan != "" && $tgl_jaminan != null)
			{
				$ubah_tgljaminan = date("Y-m-d", strtotime($tgl_jaminan));
			}
			else
			{
				$ubah_tgljaminan = null;
			}


			$data = array(
				"eksploitasi_kd" => $this->input->post('eksploitasi_kd'),
				"vendor_id" => $this->input->post('vendor_id'),
				"bidang_id" => $this->input->post('bidang_id'),
				"eksploitasi_pr_number" => $this->input->post('eksploitasi_pr_number'),
				"eksploitasi_po_number" => $this->input->post('eksploitasi_po_number'),
				"eksploitasi_uraian_pekerjaan" => $this->input->post('eksploitasi_uraian_pekerjaan'),
				// "eksploitasi_no_kontrak" => $this->input->post('eksploitasi_no_kontrak'),
				"eksploitasi_nilai_pekerjaan" => $this->input->post('eksploitasi_nilai_pekerjaan'),
				"eksploitasi_mulai_pelaksanaan" => $ubah_tglmulai,
				"eksploitasi_selesai_pekerjaan" => $ubah_tglselesai,
				"eksploitasi_tanggal_jaminan_pelaksanaan" => $ubah_tgljaminan,

				"updated_by" => $this->session->userdata('user_id'),
				"last_update" => date("Y-m-d H:i:s")
			);


			if($data['eksploitasi_kd']==null || $data['vendor_id']==null || $data['bidang_id']==null || $data['eksploitasi_pr_number']==null || $data['eksploitasi_po_number']==null || $data['eksploitasi_uraian_pekerjaan']==null || $data['eksploitasi_nilai_pekerjaan']==null || $data['eksploitasi_mulai_pelaksanaan']==null || $data['eksploitasi_selesai_pekerjaan']==null || $data['eksploitasi_tanggal_jaminan_pelaksanaan']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['eksploitasi_kd']==null) $response['message'] .= 'Kode Eksploitasi, ';
				if($data['vendor_id']==null) $response['message'] .= 'Vendor, ';
				if($data['bidang_id']==null) $response['message'] .= 'Bidang, ';
				if($data['eksploitasi_pr_number']==null) $response['message'] .= 'PR Number, ';
				if($data['eksploitasi_po_number']==null) $response['message'] .= 'PO Number, ';
				if($data['eksploitasi_uraian_pekerjaan']==null) $response['message'] .= 'Uraian Pekerjaan, ';
				// if($data['eksploitasi_no_kontrak']==null) $response['message'] .= 'Kontrak, ';
				if($data['eksploitasi_nilai_pekerjaan']==null) $response['message'] .= 'Nilai Pekerjaan, ';
				if($data['eksploitasi_mulai_pelaksanaan']==null) $response['message'] .= 'Mulai Pekerjaan, ';
				if($data['eksploitasi_selesai_pekerjaan']==null) $response['message'] .= 'Selesai Pekerjaan, ';
				if($data['eksploitasi_tanggal_jaminan_pelaksanaan']==null) $response['message'] .= 'Jaminan Selesai, ';
			}
			else {
				$response = $this->crud->allEditSave($data,$id,"ak_data_eksploitasi","eksploitasi_id");
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}


	function proses_adendum()
	{
			$id = $this->input->post("eksploitasi_id");

			// UBAH FORMAT TANGGAL JADI TANGGAL MYSQL
			$tgl_selesai = $this->input->post('eksploitasi_selesai_pekerjaan');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_jaminan = $this->input->post('eksploitasi_tanggal_jaminan_pelaksanaan');
			if($tgl_jaminan != "" && $tgl_jaminan != null)
			{
				$ubah_tgljaminan = date("Y-m-d", strtotime($tgl_jaminan));
			}
			else
			{
				$ubah_tgljaminan = null;
			}


			$data = array(
				"eksploitasi_kd" => $this->input->post('eksploitasi_kd'),
				
				"eksploitasi_pr_number" => $this->input->post('eksploitasi_pr_number'),
				"eksploitasi_po_number" => $this->input->post('eksploitasi_po_number'),
				
				"eksploitasi_no_kontrak" => $this->input->post('eksploitasi_no_kontrak'),
				"eksploitasi_nilai_pekerjaan" => $this->input->post('eksploitasi_nilai_pekerjaan'),
				
				"eksploitasi_selesai_pekerjaan" => $ubah_tglselesai,
				"eksploitasi_tanggal_jaminan_pelaksanaan" => $ubah_tgljaminan,

				"updated_by" => $this->session->userdata('user_id'),
				"last_update" => date("Y-m-d H:i:s")
			);


			if($data['eksploitasi_kd']==null || $data['eksploitasi_pr_number']==null || $data['eksploitasi_no_kontrak']==null || $data['eksploitasi_po_number']==null || $data['eksploitasi_nilai_pekerjaan']==null || $data['eksploitasi_selesai_pekerjaan']==null || $data['eksploitasi_tanggal_jaminan_pelaksanaan']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['eksploitasi_kd']==null) $response['message'] .= 'Kode Eksploitasi, ';
				
				if($data['eksploitasi_pr_number']==null) $response['message'] .= 'PR Number, ';
				if($data['eksploitasi_po_number']==null) $response['message'] .= 'PO Number, ';
				
				if($data['eksploitasi_no_kontrak']==null) $response['message'] .= 'Kontrak, ';
				if($data['eksploitasi_nilai_pekerjaan']==null) $response['message'] .= 'Nilai Pekerjaan, ';
				
				if($data['eksploitasi_selesai_pekerjaan']==null) $response['message'] .= 'Selesai Pekerjaan, ';
				if($data['eksploitasi_tanggal_jaminan_pelaksanaan']==null) $response['message'] .= 'Jaminan Selesai, ';
			}
			else {
				// $response = $this->crud->allEditSave($data,$id,"ak_data_eksploitasi","eksploitasi_id");

				// insert di tabel adendum
				$ins_adendum = array(
					"adendum_kd" => $this->input->post('eksploitasi_kd'),
					"eksploitasi_id" => $id,
					
					"adendum_pr_number" => $this->input->post('eksploitasi_pr_number'),
					"adendum_po_number" => $this->input->post('eksploitasi_po_number'),
					
					"adendum_no_kontrak" => $this->input->post('eksploitasi_no_kontrak'),
					"adendum_nilai_pekerjaan" => $this->input->post('eksploitasi_nilai_pekerjaan'),
					
					"adendum_selesai_pekerjaan" => $ubah_tglselesai,
					"adendum_tanggal_jaminan_pelaksanaan" => $ubah_tgljaminan,

					"created_by" => $this->session->userdata('user_id'),
					"created_date" => date("Y-m-d H:i:s")
				);
				$response = $this->crud->allInsertSave($ins_adendum,"ak_data_adendum");
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	public function getDetail($id = null) {
	    header('Content-type: text/javascript');
	    $data = $this->crud->getsingledatatablewhere("ak_data_eksploitasi","eksploitasi_id",$id);
	    if(count($data) > 0) {
	      echo json_encode(array(
	        'code'		    => '200',

	        "eksploitasi_id" => $data['eksploitasi_id'],
	        "eksploitasi_kd" => $data['eksploitasi_kd'],
			"vendor_id" => $data['vendor_id'],
			"bidang_id" => $data['bidang_id'],
			"eksploitasi_pr_number" => $data['eksploitasi_pr_number'],
			"eksploitasi_po_number" => $data['eksploitasi_po_number'],
			"eksploitasi_uraian_pekerjaan" => $data['eksploitasi_uraian_pekerjaan'],
			"eksploitasi_no_kontrak" => $data['eksploitasi_no_kontrak'],
			"eksploitasi_nilai_pekerjaan" => $data['eksploitasi_nilai_pekerjaan'],
			"eksploitasi_mulai_pelaksanaan" => date("d-m-Y",strtotime($data['eksploitasi_mulai_pelaksanaan'])),
			"eksploitasi_selesai_pekerjaan" => date("d-m-Y",strtotime($data['eksploitasi_selesai_pekerjaan'])),
			"eksploitasi_tanggal_jaminan_pelaksanaan" => date("d-m-Y",strtotime($data['eksploitasi_tanggal_jaminan_pelaksanaan']))
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
		$response = $this->crud->allEditSave($data,$idnya,"ak_data_eksploitasi","eksploitasi_id");
		header('Access-Control-Allow-Origin: *');
		echo json_encode($response);

	}




	





}
