<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang extends CI_Controller {

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

		$data['title'] = 'Master Bidang';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Master Bidang' => '',
        ];
        //$this->layout->set_privilege(1);

        $lastCode = $this->crud->getLastCode("ak_data_bidang","bidang_kd","BID-");
		$data['code'] = $this->codegen->auto("BID-",$lastCode['bidang_kd'],5);

		$main->display("bidang/index",$data);
	
	}


	function get_data_bidang()
    {
    	$list = $this->dtable->get_datatables_bidang();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $field) {

			$aksi = '<button class="btn btn-xs btn-warning" onclick="preEdit('.$field->bidang_id.')" title="Edit">Edit</button>
				<button class="btn btn-danger btn-xs" title="Delete" onclick="preHapus('.$field->bidang_id.')">Delete</button>';

			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $field->bidang_kd;
			$row[] = $field->bidang_nama;
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dtable->count_all_bidang(),
			"recordsFiltered" => $this->dtable->count_filtered_bidang(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

    function proses_add()
	{

			$data = array(
				"bidang_kd" => $this->input->post('bidang_kd'),
				"bidang_nama" => $this->input->post('bidang_nama'),
				"created_by" => $this->session->userdata('user_id'),
				"created_date" => date("Y-m-d H:i:s")
			);


			if($data['bidang_kd']==null || $data['bidang_nama']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['bidang_kd']==null) $response['message'] .= 'Kode Bidang, ';
				if($data['bidang_nama']==null) $response['message'] .= 'Nama Bidang, ';
			}
			else {
				$cek = $this->crud->getsingledatatablewhere("ak_data_bidang","bidang_kd",$data['bidang_kd']);
				if(count($cek) > 0)
				{
					// $response = array(
					// 	'code' => 1,
					// 	'message' => "Kode sudah ada..."
					// );

					$lastCode = $this->crud->getLastCode("ak_data_bidang","bidang_kd","BID-");
					$data['bidang_kd'] = $this->codegen->auto("BID-",$lastCode['bidang_kd'],5);

					$response = $this->crud->allInsertSave($data,'ak_data_bidang');
				}
				else
				{
					$response = $this->crud->allInsertSave($data,'ak_data_bidang');
				}
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	function proses_edit()
	{
			$id = $this->input->post("bidang_id");

			$data = array(
				"bidang_kd" => $this->input->post('bidang_kd'),
				"bidang_nama" => $this->input->post('bidang_nama'),
				"updated_by" => $this->session->userdata('user_id'),
				"last_update" => date("Y-m-d H:i:s")
			);


			if($data['bidang_kd']==null || $data['bidang_nama']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['bidang_kd']==null) $response['message'] .= 'Kode Bidang, ';
				if($data['bidang_nama']==null) $response['message'] .= 'Nama Bidang, ';
			}
			else {
				$response = $this->crud->allEditSave($data,$id,"ak_data_bidang","bidang_id");
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	public function getDetail($id = null) {
	    header('Content-type: text/javascript');
	    $data = $this->crud->getsingledatatablewhere("ak_data_bidang","bidang_id",$id);
	    if(count($data) > 0) {
	      echo json_encode(array(
	        'code'		    => '200',
	        'bidang_id'          => $data['bidang_id'],
	        'bidang_kd'        => $data['bidang_kd'],
	        'bidang_nama'        => $data['bidang_nama'])
	      );
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
		$response = $this->crud->allEditSave($data,$idnya,"ak_data_bidang","bidang_id");
		header('Access-Control-Allow-Origin: *');
		echo json_encode($response);

	}




	





}
