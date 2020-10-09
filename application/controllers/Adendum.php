<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adendum extends CI_Controller {

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

		$data['title'] = 'Adendum';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Adendum' => '',
        ];
        //$this->layout->set_privilege(1);

  //       $lastCode = $this->crud->getLastCode("ak_data_eksploitasi","eksploitasi_kd","EXP-");
		// $data['code'] = $this->codegen->auto("EXP-",$lastCode['eksploitasi_kd'],9);

		$data['bidang'] = $this->crud->getalldatatablewhere("ak_data_bidang","deleted",0);

		$data['vendor'] = $this->crud->getalldatatablewhere("ak_data_vendor","deleted",0);


		if($this->input->get('s')==null)
		{
			$data['filter'] = "semua";
		}
		else
		{
			$data['filter'] = $this->input->get('s');
		}

		$main->display("adendum/index",$data);
	
	}


	function get_data_adendum($filter)
    {

    	$list = $this->dtable->get_datatables_adendum($filter);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $field) {

			if($field->investasi_id != null)
			{

					$aksi = '<button class="btn btn-xs btn-primary" onclick="preDetailInvestasi('.$field->adendum_id.')" title="Detail">Detail</button>
					<button class="btn btn-xs btn-warning" onclick="preEditInvestasi('.$field->adendum_id.')" title="Edit">Edit</button>
					<button class="btn btn-danger btn-xs" title="Delete" onclick="preHapus('.$field->adendum_id.')">Delete</button>';

	                $tanggal1 = date_create(date("Y-m-d"));
	                $tanggal2 = date_create(date("Y-m-d",strtotime($field->acd)));
	                $selisih_hari = date_diff($tanggal2,$tanggal1);

	                
		            if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
		            {	                    
		                    $indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
		            }
		            elseif($selisih_hari->format("%r%a") >= 15 && $selisih_hari->format("%r%a") <= 27)
		            {
		                    $indikator = "<span><i class='fa fa-circle' style='color:yellow;'></i></span>";
		            }
		            elseif($selisih_hari->format("%r%a") >= 28 && $selisih_hari->format("%r%a") <= 30)
		            {	                    
		                    $indikator = "<span><i class='fa fa-circle' style='color:green;'></i></span>";
		            }
		            else
		            {	                	
		                	$indikator = "<span><i class='fa fa-circle' style='color:purple;'></i></span>";
		            }
	                

					$no++;
					$row = array();
					$row[] = $no.".";
					$row[] = $field->adendum_kd;
					$row[] = $field->binam1;
					$row[] = $field->invup;
					$row[] = $field->venam1;
					$row[] = "Rp. ".number_format($field->adendum_nilai_pekerjaan,0,',','.');
					$row[] = date("d/m/Y",strtotime($field->invmp));
					$row[] = $indikator;
					$row[] = $aksi;
			}
			else
			{
				
					$aksi = '<button class="btn btn-xs btn-primary" onclick="preDetailEksploitasi('.$field->adendum_id.')" title="Detail">Detail</button>
					<button class="btn btn-xs btn-warning" onclick="preEditEksploitasi('.$field->adendum_id.')" title="Edit">Edit</button>
					<button class="btn btn-danger btn-xs" title="Delete" onclick="preHapus('.$field->adendum_id.')">Delete</button>';

	                $tanggal1 = date_create(date("Y-m-d"));
	                $tanggal2 = date_create(date("Y-m-d",strtotime($field->acd)));
	                $selisih_hari = date_diff($tanggal2,$tanggal1);

	                
		            if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
		            {	                    
		                    $indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
		            }
		            elseif($selisih_hari->format("%r%a") >= 15 && $selisih_hari->format("%r%a") <= 27)
		            {
		                    $indikator = "<span><i class='fa fa-circle' style='color:yellow;'></i></span>";
		            }
		            elseif($selisih_hari->format("%r%a") >= 28 && $selisih_hari->format("%r%a") <= 30)
		            {	                    
		                    $indikator = "<span><i class='fa fa-circle' style='color:green;'></i></span>";
		            }
		            else
		            {	                	
		                	$indikator = "<span><i class='fa fa-circle' style='color:purple;'></i></span>";
		            }
	                

					$no++;
					$row = array();
					$row[] = $no.".";
					$row[] = $field->adendum_kd;
					$row[] = $field->binam2;
					$row[] = $field->eksup;
					$row[] = $field->venam2;
					$row[] = "Rp. ".number_format($field->adendum_nilai_pekerjaan,0,',','.');
					$row[] = date("d/m/Y",strtotime($field->eksmp));
					$row[] = $indikator;
					$row[] = $aksi;
			}


			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dtable->count_all_adendum($filter),
			"recordsFiltered" => $this->dtable->count_filtered_adendum($filter),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

    

	function proses_edit()
	{
			$id = $this->input->post("adendum_id");

			$tgl_selesai = $this->input->post('adendum_selesai_pekerjaan');
			if($tgl_selesai != "" && $tgl_selesai != null)
			{
				$ubah_tglselesai = date("Y-m-d", strtotime($tgl_selesai));
			}
			else
			{
				$ubah_tglselesai = null;
			}

			$tgl_jaminan = $this->input->post('adendum_tanggal_jaminan_pelaksanaan');
			if($tgl_jaminan != "" && $tgl_jaminan != null)
			{
				$ubah_tgljaminan = date("Y-m-d", strtotime($tgl_jaminan));
			}
			else
			{
				$ubah_tgljaminan = null;
			}


			$data = array(
				
				"adendum_pr_number" => $this->input->post('adendum_pr_number'),
				"adendum_po_number" => $this->input->post('adendum_po_number'),

				"adendum_no_kontrak" => $this->input->post('adendum_no_kontrak'),
				
				"adendum_nilai_pekerjaan" => $this->input->post('adendum_nilai_pekerjaan'),
				
				"adendum_selesai_pekerjaan" => $ubah_tglselesai,
				"adendum_tanggal_jaminan_pelaksanaan" => $ubah_tgljaminan,

				"updated_by" => $this->session->userdata('user_id'),
				"last_update" => date("Y-m-d H:i:s")
			);


			if($data['adendum_pr_number']==null || $data['adendum_po_number']==null || $data['adendum_no_kontrak']==null || $data['adendum_nilai_pekerjaan']==null || $data['adendum_selesai_pekerjaan']==null || $data['adendum_tanggal_jaminan_pelaksanaan']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				
				if($data['adendum_pr_number']==null) $response['message'] .= 'PR Number, ';
				if($data['adendum_po_number']==null) $response['message'] .= 'PO Number, ';
				if($data['adendum_no_kontrak']==null) $response['message'] .= 'No Kontrak, ';
				
				if($data['adendum_nilai_pekerjaan']==null) $response['message'] .= 'Nilai Pekerjaan, ';
				
				if($data['adendum_selesai_pekerjaan']==null) $response['message'] .= 'Selesai Pekerjaan, ';
				if($data['adendum_tanggal_jaminan_pelaksanaan']==null) $response['message'] .= 'Jaminan Selesai, ';
			}
			else {
				$response = $this->crud->allEditSave($data,$id,"ak_data_adendum","adendum_id");
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	public function getDetailInvestasi($id_adendum = null) {
	    header('Content-type: text/javascript');

	    $data = $this->crud->getAdendumJoinInvestasiBy($id_adendum);

	    if(count($data) > 0) {
	      echo json_encode(array(
	        'code'		    => '200',

	        "adendum_id" => $data['adendum_id'],
	        "adendum_kd" => $data['adendum_kd'],
			"vendor_id" => $data['invid_ven'],
			"bidang_id" => $data['invid_bid'],
			"adendum_pr_number" => $data['adendum_pr_number'],
			"adendum_po_number" => $data['adendum_po_number'],

			"uraian_pekerjaan" => $data['invup'],

			"adendum_no_kontrak" => $data['adendum_no_kontrak'],
			"adendum_nilai_pekerjaan" => $data['adendum_nilai_pekerjaan'],

			"mulai_pelaksanaan" => date("d-m-Y",strtotime($data['invmp'])),

			"adendum_selesai_pekerjaan" => date("d-m-Y",strtotime($data['adendum_selesai_pekerjaan'])),
			"adendum_tanggal_jaminan_pelaksanaan" => date("d-m-Y",strtotime($data['adendum_tanggal_jaminan_pelaksanaan']))
		));
	    } else {
	      echo json_encode(array(
	        'code'			=> '400',
	        'status'		=> 'error',
	        'message' 	=> 'Bad Request')
	      );
	    }
	 }

	 public function getDetailEksploitasi($id_adendum = null) {
	    header('Content-type: text/javascript');

	    $data = $this->crud->getAdendumJoinEksploitasiBy($id_adendum);

	    if(count($data) > 0) {
	      echo json_encode(array(
	        'code'		    => '200',

	        "adendum_id" => $data['adendum_id'],
	        "adendum_kd" => $data['adendum_kd'],
			"vendor_id" => $data['eksid_ven'],
			"bidang_id" => $data['eksid_bid'],
			"adendum_pr_number" => $data['adendum_pr_number'],
			"adendum_po_number" => $data['adendum_po_number'],

			"uraian_pekerjaan" => $data['eksup'],

			"adendum_no_kontrak" => $data['adendum_no_kontrak'],
			"adendum_nilai_pekerjaan" => $data['adendum_nilai_pekerjaan'],

			"mulai_pelaksanaan" => date("d-m-Y",strtotime($data['eksmp'])),

			"adendum_selesai_pekerjaan" => date("d-m-Y",strtotime($data['adendum_selesai_pekerjaan'])),
			"adendum_tanggal_jaminan_pelaksanaan" => date("d-m-Y",strtotime($data['adendum_tanggal_jaminan_pelaksanaan']))
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
		$response = $this->crud->allEditSave($data,$idnya,"ak_data_adendum","adendum_id");
		header('Access-Control-Allow-Origin: *');
		echo json_encode($response);

	}




	





}
