<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sewa_kategori extends CI_Controller {

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

		$data['title'] = 'Master Sewa Kategori';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Master Sewa Kategori' => '',
        ];
        //$this->layout->set_privilege(1);

        $lastCode = $this->crud->getLastCode("ak_data_sewa_kategori","sewa_kategori_kd","SWK-");
		$data['code'] = $this->codegen->auto("SWK-",$lastCode['sewa_kategori_kd'],5);

		$main->display("sewa_kategori/index",$data);
	
	}


	function get_data_sewa_kategori()
    {
    	$list = $this->dtable->get_datatables_sewa_kategori();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $field) {

			$aksi = '<button class="btn btn-xs btn-warning" onclick="preEdit('.$field->sewa_kategori_id.')" title="Edit">Edit</button>
				<button class="btn btn-danger btn-xs" title="Delete" onclick="preHapus('.$field->sewa_kategori_id.')">Delete</button>';

			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $field->sewa_kategori_kd;
			$row[] = $field->sewa_kategori_nama;
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dtable->count_all_sewa_kategori(),
			"recordsFiltered" => $this->dtable->count_filtered_sewa_kategori(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

    function proses_add()
	{

			$data = array(
				"sewa_kategori_kd" => $this->input->post('sewa_kategori_kd'),
				"sewa_kategori_nama" => $this->input->post('sewa_kategori_nama'),
				"created_by" => $this->session->userdata('user_id'),
				"created_date" => date("Y-m-d H:i:s")
			);


			if($data['sewa_kategori_kd']==null || $data['sewa_kategori_nama']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['sewa_kategori_kd']==null) $response['message'] .= 'Kode Sewa Kategori, ';
				if($data['sewa_kategori_nama']==null) $response['message'] .= 'Nama Sewa Kategori, ';
			}
			else {
				$cek = $this->crud->getsingledatatablewhere("ak_data_sewa_kategori","sewa_kategori_kd",$data['sewa_kategori_kd']);
				if(count($cek) > 0)
				{
					// $response = array(
					// 	'code' => 1,
					// 	'message' => "Kode sudah ada..."
					// );

					$lastCode = $this->crud->getLastCode("ak_data_sewa_kategori","sewa_kategori_kd","SWK-");
					$data['sewa_kategori_kd'] = $this->codegen->auto("SWK-",$lastCode['sewa_kategori_kd'],5);

					$response = $this->crud->allInsertSave($data,'ak_data_sewa_kategori');
				}
				else
				{
					$response = $this->crud->allInsertSave($data,'ak_data_sewa_kategori');
				}
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	function proses_edit()
	{
			$id = $this->input->post("sewa_kategori_id");

			$data = array(
				"sewa_kategori_kd" => $this->input->post('sewa_kategori_kd'),
				"sewa_kategori_nama" => $this->input->post('sewa_kategori_nama'),
				"updated_by" => $this->session->userdata('user_id'),
				"last_update" => date("Y-m-d H:i:s")
			);


			if($data['sewa_kategori_kd']==null || $data['sewa_kategori_nama']==null){
				$response = array(
	                'code' => 1,
	                'message' => "Data belum lengkap! : "
	            );
				if($data['sewa_kategori_kd']==null) $response['message'] .= 'Kode Sewa Kategori, ';
				if($data['sewa_kategori_nama']==null) $response['message'] .= 'Nama Sewa Kategori, ';
			}
			else {
				$response = $this->crud->allEditSave($data,$id,"ak_data_sewa_kategori","sewa_kategori_id");
			}

			header('Access-Control-Allow-Origin: *');
			echo json_encode($response);


	}

	public function getDetail($id = null) {
	    header('Content-type: text/javascript');
	    $data = $this->crud->getsingledatatablewhere("ak_data_sewa_kategori","sewa_kategori_id",$id);
	    if(count($data) > 0) {
	      echo json_encode(array(
	        'code'		    => '200',
	        'sewa_kategori_id'          => $data['sewa_kategori_id'],
	        'sewa_kategori_kd'        => $data['sewa_kategori_kd'],
	        'sewa_kategori_nama'        => $data['sewa_kategori_nama'])
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
		$response = $this->crud->allEditSave($data,$idnya,"ak_data_sewa_kategori","sewa_kategori_id");
		header('Access-Control-Allow-Origin: *');
		echo json_encode($response);

	}




	





}
