<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investasi extends CI_Controller {

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

		$data['title'] = 'Investasi';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Investasi' => '',
        ];
        //$this->layout->set_privilege(1);

        $lastCode = $this->crud->getLastCode("ak_data_investasi","investasi_kd","INV-");
		$data['code'] = $this->codegen->auto("INV-",$lastCode['investasi_kd'],9);

		$data['bidang'] = $this->crud->getalldatatablewhere("ak_data_bidang","deleted",0);

		$data['vendor'] = $this->crud->getalldatatablewhere("ak_data_vendor","deleted",0);

		$main->display("investasi/index",$data);
	
	}


	function get_data_investasi()
    {
    	$list = $this->dtable->get_datatables_investasi();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $field) {

			$aksi = '<button class="btn btn-xs btn-warning" onclick="preEdit('.$field->investasi_id.')" title="Edit">Edit</button>
				<button class="btn btn-info btn-xs" title="Adendum" onclick="preAdendum('.$field->investasi_id.')">Adendum</button>
				<button class="btn btn-danger btn-xs" title="Delete" onclick="preHapus('.$field->investasi_id.')">Delete</button>';


			// $cek_adendum = $this->crud->getAdendumInvestasiBy($field->investasi_id);
			//cek dahulu apakah null
            if($field->investasi_selesai_pekerjaan != null){
			// if($field->tgl_adendum == null)
			// if($cek_adendum['created_date'] == null)
            //{
               /* $tanggal1 = date_create(date("Y-m-d"));
                $tanggal2 = date_create(date("Y-m-d",strtotime($field->investasi_selesai_pekerjaan)));
                $selisih_hari = date_diff($tanggal2,$tanggal1);*/

                $tanggal1  = strtotime(date("Y-m-d"));
				$tanggal2 = strtotime(date("Y-m-d",strtotime($field->investasi_selesai_pekerjaan))); 

				// $selisih_hari = $tanggal2->diff($tanggal1)->format("%r%a");

				// $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

				$selisih_hari = $tanggal2 - $tanggal1;

				$beda_hari = ($selisih_hari/24/60/60);

				// print_r($selisih_hari);exit();

				// $beda_hari = $selisih_hari/$beda/24/60/60

				if($selisih_hari > 0){

						if($beda_hari == 14){

							$indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
									}
						elseif($beda_hari == 21){

						    $indikator = "<span><i class='fa fa-circle' style='color:yellow;'></i></span>";
								}
						elseif($beda_hari == 30){

					 		$indikator = "<span><i class='fa fa-circle' style='color:lime;'></i></span>";
					 	}else{

					 		$indikator = "<span><i class='fa fa-circle' style='color:lime;'></i></span>";
					 	}

				}else{

					$indikator = "<span><i class='fa fa-circle' style='color:purple;'></i></span>";
				}
			}

                /* ----INI CODINGAN PERTAMA CREATE TANGGAL 24/09/2019----

                if($tanggal2 < $tanggal1)
                {
	                if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 30)
	                {
	                    // $indikator = "<span class='label label-default' style='background:#777;color:#fafafa;'>".$selisih_hari->format("%r%a")." hari</span>";
	                    $indikator = "<span><i class='fa fa-circle' style='color:lime;'></i></span>";
	                }
	                elseif($selisih_hari->format("%r%a") >= 27 && $selisih_hari->format("%r%a") <= 30)
	                {
	                    // $indikator = "<span class='label label-danger'>".$selisih_hari->format("%r%a")." hari</span>";
	                    $indikator = "<span><i class='fa fa-circle' style='color:yellow;'></i></span>";
	                }
	                elseif($selisih_hari->format("%r%a") >= 27 && $selisih_hari->format("%r%a") <= 14)
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
                else
                {
                	// $indikator = "N/A";
                	$indikator = "<span><i class='fa fa-circle' style='color:lime;'></i></span>";
                }
                
            }
            else
            {
            	$indikator = "<span><i class='fa fa-circle' style='color:lime;'></i></span>";
            }



            -----BATAS-CODINGAN LAMA--- TANGAL 24/04/2019*/





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
            // print_r($output);exit();


			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $field->investasi_po_number;
			$row[] = $field->bidang_nama;
			$row[] = $field->investasi_uraian_pekerjaan;
			$row[] = $field->vendor_nama;
			$row[] = "Rp. ".number_format($field->investasi_nilai_pekerjaan,0,',','.');
			$row[] = date("d/m/Y",strtotime($field->investasi_mulai_pelaksanaan));
			$row[] = $indikator;
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dtable->count_all_investasi(),
			"recordsFiltered" => $this->dtable->count_filtered_investasi(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);


		//  echo '<pre>';
		// var_dump($output);exit();
		// echo '</pre>';
  	}

    function proses_add()
	{

			// UBAH FORMAT TANGGAL JADI TANGGAL MYSQL
	    	$tgl_mulai = $this->input->post('investasi_mulai_pelaksanaan');
			if($tgl_mulai != "" && $tgl_mulai != null)
			{
				$ubah_tglmulai = date("Y-m-d", strtotime($tgl_mulai));
			}
			else
			{
				$ubah_tglmulai = null;
			}

			$tgl_selesai = $this->input->post('investasi_selesai_pekerjaan');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_jaminan = $this->input->post('investasi_tanggal_jaminan_pelaksanaan');
			if($tgl_jaminan != "" && $tgl_jaminan != null)
			{
				$ubah_tgljaminan = date("Y-m-d", strtotime($tgl_jaminan));
			}
			else
			{
				$ubah_tgljaminan = null;
			}

			$data = array(
				"investasi_kd" => $this->input->post('investasi_kd'),
				"vendor_id" => $this->input->post('vendor_id'),
				"bidang_id" => $this->input->post('bidang_id'),
				"investasi_pr_number" => $this->input->post('investasi_pr_number'),
				"investasi_po_number" => $this->input->post('investasi_po_number'),
				"investasi_uraian_pekerjaan" => $this->input->post('investasi_uraian_pekerjaan'),
				"investasi_no_kontrak" => $this->input->post('investasi_no_kontrak'),
				"investasi_nilai_pekerjaan" => $this->input->post('investasi_nilai_pekerjaan'),
				"investasi_mulai_pelaksanaan" => $ubah_tglmulai,
				"investasi_selesai_pekerjaan" => $ubah_tglselesai,
				"investasi_tanggal_jaminan_pelaksanaan" => $ubah_tgljaminan,

				"created_by" => $this->session->userdata('user_id'),
				"created_date" => date("Y-m-d H:i:s")
			);


			if($data['investasi_kd']==null || $data['vendor_id']==null || $data['bidang_id']==null || $data['investasi_pr_number']==null || $data['investasi_po_number']==null || $data['investasi_uraian_pekerjaan']==null || $data['investasi_no_kontrak']==null || $data['investasi_nilai_pekerjaan']==null || $data['investasi_mulai_pelaksanaan']==null || $data['investasi_selesai_pekerjaan']==null || $data['investasi_tanggal_jaminan_pelaksanaan']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['investasi_kd']==null) $response['message'] .= 'Kode Investasi, ';
				if($data['vendor_id']==null) $response['message'] .= 'Vendor, ';
				if($data['bidang_id']==null) $response['message'] .= 'Bidang, ';
				if($data['investasi_pr_number']==null) $response['message'] .= 'PR Number, ';
				if($data['investasi_po_number']==null) $response['message'] .= 'PO Number, ';
				if($data['investasi_uraian_pekerjaan']==null) $response['message'] .= 'Uraian Pekerjaan, ';
				if($data['investasi_no_kontrak']==null) $response['message'] .= 'Kontrak, ';
				if($data['investasi_nilai_pekerjaan']==null) $response['message'] .= 'Nilai Pekerjaan, ';
				if($data['investasi_mulai_pelaksanaan']==null) $response['message'] .= 'Mulai Pekerjaan, ';
				if($data['investasi_selesai_pekerjaan']==null) $response['message'] .= 'Selesai Pekerjaan, ';
				if($data['investasi_tanggal_jaminan_pelaksanaan']==null) $response['message'] .= 'Jaminan Selesai, ';
			}
			else {
				$cek = $this->crud->getsingledatatablewhere("ak_data_investasi","investasi_kd",$data['investasi_kd']);
				if(count($cek) > 0)
				{

					$lastCode = $this->crud->getLastCode("ak_data_investasi","investasi_kd","INV-");
					$data['investasi_kd'] = $this->codegen->auto("INV-",$lastCode['investasi_kd'],9);

					$response = $this->crud->allInsertSave($data,'ak_data_investasi');
				}
				else
				{
					$response = $this->crud->allInsertSave($data,'ak_data_investasi');
				}
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	function proses_edit()
	{
			$id = $this->input->post("investasi_id");

			// UBAH FORMAT TANGGAL JADI TANGGAL MYSQL
	    	$tgl_mulai = $this->input->post('investasi_mulai_pelaksanaan');
			if($tgl_mulai != "" && $tgl_mulai != null)
			{
				$ubah_tglmulai = date("Y-m-d", strtotime($tgl_mulai));
			}
			else
			{
				$ubah_tglmulai = null;
			}

			$tgl_selesai = $this->input->post('investasi_selesai_pekerjaan');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_jaminan = $this->input->post('investasi_tanggal_jaminan_pelaksanaan');
			if($tgl_jaminan != "" && $tgl_jaminan != null)
			{
				$ubah_tgljaminan = date("Y-m-d", strtotime($tgl_jaminan));
			}
			else
			{
				$ubah_tgljaminan = null;
			}


			$data = array(
				"investasi_kd" => $this->input->post('investasi_kd'),
				"vendor_id" => $this->input->post('vendor_id'),
				"bidang_id" => $this->input->post('bidang_id'),
				"investasi_pr_number" => $this->input->post('investasi_pr_number'),
				"investasi_po_number" => $this->input->post('investasi_po_number'),
				"investasi_uraian_pekerjaan" => $this->input->post('investasi_uraian_pekerjaan'),
			    "investasi_no_kontrak" => $this->input->post('investasi_no_kontrak'),
				"investasi_nilai_pekerjaan" => $this->input->post('investasi_nilai_pekerjaan'),
				"investasi_mulai_pelaksanaan" => $ubah_tglmulai,
				"investasi_selesai_pekerjaan" => $ubah_tglselesai,
				"investasi_tanggal_jaminan_pelaksanaan" => $ubah_tgljaminan,

				"updated_by" => $this->session->userdata('user_id'),
				"last_update" => date("Y-m-d H:i:s")
			);
			// echo '<pre>';
			// print_r($data);exit();
			// echo '<pre>';


			if($data['investasi_kd']==null || $data['vendor_id']==null || $data['bidang_id']==null || $data['investasi_pr_number']==null || $data['investasi_po_number']==null || $data['investasi_uraian_pekerjaan']==null || $data['investasi_no_kontrak']==null || $data['investasi_nilai_pekerjaan']==null || $data['investasi_mulai_pelaksanaan']==null || $data['investasi_selesai_pekerjaan']==null || $data['investasi_tanggal_jaminan_pelaksanaan']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['investasi_kd']==null) $response['message'] .= 'Kode Investasi, ';
				if($data['vendor_id']==null) $response['message'] .= 'Vendor, ';
				if($data['bidang_id']==null) $response['message'] .= 'Bidang, ';
				if($data['investasi_pr_number']==null) $response['message'] .= 'PR Number, ';
				if($data['investasi_po_number']==null) $response['message'] .= 'PO Number, ';
				if($data['investasi_uraian_pekerjaan']==null) $response['message'] .= 'Uraian Pekerjaan, ';
				if($data['investasi_no_kontrak']==null) $response['message'] .= 'Kontrak, ';
				if($data['investasi_nilai_pekerjaan']==null) $response['message'] .= 'Nilai Pekerjaan, ';
				if($data['investasi_mulai_pelaksanaan']==null) $response['message'] .= 'Mulai Pekerjaan, ';
				if($data['investasi_selesai_pekerjaan']==null) $response['message'] .= 'Selesai Pekerjaan, ';
				if($data['investasi_tanggal_jaminan_pelaksanaan']==null) $response['message'] .= 'Jaminan Selesai, ';
			}
			else {
				$response = $this->crud->allEditSave($data,$id,"ak_data_investasi","investasi_id");
			}
			// print_r($response);exit();

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}


	function proses_adendum()
	{
			$id = $this->input->post("investasi_id");

			// UBAH FORMAT TANGGAL JADI TANGGAL MYSQL
			$tgl_selesai = $this->input->post('investasi_selesai_pekerjaan');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_jaminan = $this->input->post('investasi_tanggal_jaminan_pelaksanaan');
			if($tgl_jaminan != "" && $tgl_jaminan != null)
			{
				$ubah_tgljaminan = date("Y-m-d", strtotime($tgl_jaminan));
			}
			else
			{
				$ubah_tgljaminan = null;
			}


			$data = array(
				"investasi_kd" => $this->input->post('investasi_kd'),
				
				"investasi_pr_number" => $this->input->post('investasi_pr_number'),
				"investasi_po_number" => $this->input->post('investasi_po_number'),
				
				"investasi_no_kontrak" => $this->input->post('investasi_no_kontrak'),
				"investasi_nilai_pekerjaan" => $this->input->post('investasi_nilai_pekerjaan'),
				
				"investasi_selesai_pekerjaan" => $ubah_tglselesai,
				"investasi_tanggal_jaminan_pelaksanaan" => $ubah_tgljaminan,

				"updated_by" => $this->session->userdata('user_id'),
				"last_update" => date("Y-m-d H:i:s")
			);


			if($data['investasi_kd']==null || $data['investasi_pr_number']==null || $data['investasi_no_kontrak']==null || $data['investasi_po_number']==null || $data['investasi_nilai_pekerjaan']==null || $data['investasi_selesai_pekerjaan']==null || $data['investasi_tanggal_jaminan_pelaksanaan']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['investasi_kd']==null) $response['message'] .= 'Kode Investasi, ';
				
				if($data['investasi_pr_number']==null) $response['message'] .= 'PR Number, ';
				if($data['investasi_po_number']==null) $response['message'] .= 'PO Number, ';
				
				if($data['investasi_no_kontrak']==null) $response['message'] .= 'Kontrak, ';
				if($data['investasi_nilai_pekerjaan']==null) $response['message'] .= 'Nilai Pekerjaan, ';
				
				if($data['investasi_selesai_pekerjaan']==null) $response['message'] .= 'Selesai Pekerjaan, ';
				if($data['investasi_tanggal_jaminan_pelaksanaan']==null) $response['message'] .= 'Jaminan Selesai, ';
			}
			else {
				// $response = $this->crud->allEditSave($data,$id,"ak_data_investasi","investasi_id");

				// insert di tabel adendum
				$ins_adendum = array(
					"adendum_kd" => $this->input->post('investasi_kd'),
					"investasi_id" => $id,
					
					"adendum_pr_number" => $this->input->post('investasi_pr_number'),
					"adendum_po_number" => $this->input->post('investasi_po_number'),
					
					"adendum_no_kontrak" => $this->input->post('investasi_no_kontrak'),
					"adendum_nilai_pekerjaan" => $this->input->post('investasi_nilai_pekerjaan'),
					
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
	    $data = $this->crud->getsingledatatablewhere("ak_data_investasi","investasi_id",$id);
	    if(count($data) > 0) {
	      echo json_encode(array(
	        'code'		    => '200',

	        "investasi_id" => $data['investasi_id'],
	        "investasi_kd" => $data['investasi_kd'],
			"vendor_id" => $data['vendor_id'],
			"bidang_id" => $data['bidang_id'],
			"investasi_pr_number" => $data['investasi_pr_number'],
			"investasi_po_number" => $data['investasi_po_number'],
			"investasi_uraian_pekerjaan" => $data['investasi_uraian_pekerjaan'],
			"investasi_no_kontrak" => $data['investasi_no_kontrak'],
			"investasi_nilai_pekerjaan" => $data['investasi_nilai_pekerjaan'],
			"investasi_mulai_pelaksanaan" => date("d-m-Y",strtotime($data['investasi_mulai_pelaksanaan'])),
			"investasi_selesai_pekerjaan" => date("d-m-Y",strtotime($data['investasi_selesai_pekerjaan'])),
			"investasi_tanggal_jaminan_pelaksanaan" => date("d-m-Y",strtotime($data['investasi_tanggal_jaminan_pelaksanaan']))
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
		$response = $this->crud->allEditSave($data,$idnya,"ak_data_investasi","investasi_id");
		header('Access-Control-Allow-Origin: *');
		echo json_encode($response);

	}




	





}
