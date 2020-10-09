<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

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

		$data['title'] = 'Master Vendor';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Master Vendor' => '',
        ];
        //$this->layout->set_privilege(1);

        $lastCode = $this->crud->getLastCode("ak_data_vendor","vendor_kd","VEN-");
		$data['code'] = $this->codegen->auto("VEN-",$lastCode['vendor_kd'],5);

		$main->display("vendor/index",$data);
	
	}


	function get_data_vendor()
    {
    	$list = $this->dtable->get_datatables_vendor();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $field) {

			$aksi = '<button class="btn btn-xs btn-warning" onclick="preEdit('.$field->vendor_id.')" title="Edit">Edit</button>
				<button class="btn btn-danger btn-xs" title="Delete" onclick="preHapus('.$field->vendor_id.')">Delete</button>';

			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $field->vendor_kd;
			$row[] = $field->vendor_nama;
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dtable->count_all_vendor(),
			"recordsFiltered" => $this->dtable->count_filtered_vendor(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

    function proses_add()
	{

			$data = array(
				"vendor_kd" => $this->input->post('vendor_kd'),
				"vendor_nama" => $this->input->post('vendor_nama'),
				"created_by" => $this->session->userdata('user_id'),
				"created_date" => date("Y-m-d H:i:s")
			);


			if($data['vendor_kd']==null || $data['vendor_nama']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['vendor_kd']==null) $response['message'] .= 'Kode Vendor, ';
				if($data['vendor_nama']==null) $response['message'] .= 'Nama Vendor, ';
			}
			else {
				$cek = $this->crud->getsingledatatablewhere("ak_data_vendor","vendor_kd",$data['vendor_kd']);
				if(count($cek) > 0)
				{
					// $response = array(
					// 	'code' => 1,
					// 	'message' => "Kode sudah ada..."
					// );

					$lastCode = $this->crud->getLastCode("ak_data_vendor","vendor_kd","VEN-");
					$data['vendor_kd'] = $this->codegen->auto("VEN-",$lastCode['vendor_kd'],5);

					$response = $this->crud->allInsertSave($data,'ak_data_vendor');
				}
				else
				{
					$response = $this->crud->allInsertSave($data,'ak_data_vendor');
				}
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	function proses_edit()
	{
			$id = $this->input->post("vendor_id");

			$data = array(
				"vendor_kd" => $this->input->post('vendor_kd'),
				"vendor_nama" => $this->input->post('vendor_nama'),
				"updated_by" => $this->session->userdata('user_id'),
				"last_update" => date("Y-m-d H:i:s")
			);


			if($data['vendor_kd']==null || $data['vendor_nama']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['vendor_kd']==null) $response['message'] .= 'Kode Vendor, ';
				if($data['vendor_nama']==null) $response['message'] .= 'Nama Vendor, ';
			}
			else {
				$response = $this->crud->allEditSave($data,$id,"ak_data_vendor","vendor_id");
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	public function getDetail($id = null) {
	    header('Content-type: text/javascript');
	    $data = $this->crud->getsingledatatablewhere("ak_data_vendor","vendor_id",$id);
	    if(count($data) > 0) {
	      echo json_encode(array(
	        'code'		    => '200',
	        'vendor_id'          => $data['vendor_id'],
	        'vendor_kd'        => $data['vendor_kd'],
	        'vendor_nama'        => $data['vendor_nama'])
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
		$response = $this->crud->allEditSave($data,$idnya,"ak_data_vendor","vendor_id");
		header('Access-Control-Allow-Origin: *');
		echo json_encode($response);

	}




	





}
