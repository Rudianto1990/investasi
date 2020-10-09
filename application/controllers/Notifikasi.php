<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->layout->auth();
		
		date_default_timezone_set('Asia/Jakarta');
	}

	public function getAllNotifikasi()
	{
		$response = array();

  		$hasil = $this->crud->getAllInvestasi();
  		
  		if(count($hasil) > 0)
  		{
  			
  			$response2 = array(
  				"code" => 0
  			);
		
			foreach($hasil AS $v)
			{
				// $cek_adendum = $this->crud->getAdendumInvestasiBy($v->investasi_id);
	                      
		  //       if($cek_adendum['created_date'] == null)
				if($v->investasi_mulai_pelaksanaan != null)
		        {
		                $tanggal1 = date_create(date("Y-m-d"));
		                $tanggal2 = date_create(date("Y-m-d",strtotime($v->investasi_mulai_pelaksanaan)));
		                $selisih_hari = date_diff($tanggal2,$tanggal1);

		                if($tanggal2 < $tanggal1)
		                {
		                        if($selisih_hari->format("%r%a") > 30)
		                        {     
		                                $val = array(
		                                	"kode" => $v->investasi_kd,
		                                	"tgl" => date("Y-m-d", strtotime($v->investasi_mulai_pelaksanaan)),
		                                	"teks" => "Sudah 1 Bulan",
		                                	"url" => base_url().'investasi'
		                                );
		                                $response[] = $val;
		                        }
		                        
		                }
		                
		                                
		    	}
		        // else
		        // {

		        //         $tanggal1 = date_create(date("Y-m-d"));
		        //         $tanggal2 = date_create(date("Y-m-d",strtotime($cek_adendum['created_date'])));
		        //         $selisih_hari = date_diff($tanggal2,$tanggal1);

		                                
		        //         if($selisih_hari->format("%r%a") > 30)
		        //         {                     
		        //            		$val = array(
		        //                     "kode" => $v->investasi_kd,
		        //                     "tgl" => date("Y-m-d", strtotime($cek_adendum['created_date'])),
		        //                     "teks" => "Sudah 1 Bulan",
		        //                     "url" => base_url().'investasi'
		        //                 );
		        //                 $response[] = $val;
		        //         }
		                
		                                
		        // }
			}

			
  		}


  		$hasil2 = $this->crud->getAllEksploitasi();
  		if(count($hasil2) > 0)
  		{
  			
  			$response2 = array(
  				"code" => 0
  			);
		
			foreach($hasil2 AS $v2)
			{
				// $cek_adendum2 = $this->crud->getAdendumEksploitasiBy($v2->eksploitasi_id);
	                      
		  //       if($cek_adendum2['created_date'] == null)
				if($v2->eksploitasi_mulai_pelaksanaan != null)
		        {
		                $tanggal3 = date_create(date("Y-m-d"));
		                $tanggal4 = date_create(date("Y-m-d",strtotime($v2->eksploitasi_mulai_pelaksanaan)));
		                $selisih_hari2 = date_diff($tanggal4,$tanggal3);

		                if($tanggal4 < $tanggal3)
		                {
		                        if($selisih_hari2->format("%r%a") > 30)
		                        {     
		                                $val2 = array(
		                                	"kode" => $v2->eksploitasi_kd,
		                                	"tgl" => date("Y-m-d", strtotime($v2->eksploitasi_mulai_pelaksanaan)),
		                                	"teks" => "Sudah 1 Bulan",
		                                	"tone" => base_url().'assets/sound/serious-strike.mp3',
		                                	"url" => base_url().'eksploitasi'
		                                );
		                                $response[] = $val2;
		                        }
		                        
		                }
		                
		                                
		    	}
		        // else
		        // {

		        //         $tanggal3 = date_create(date("Y-m-d"));
		        //         $tanggal4 = date_create(date("Y-m-d",strtotime($cek_adendum2['created_date'])));
		        //         $selisih_hari2 = date_diff($tanggal4,$tanggal3);

		                                
		        //         if($selisih_hari2->format("%r%a") > 30)
		        //         {                     
		        //            		$val2 = array(
		        //                     "kode" => $v2->eksploitasi_kd,
		        //                     "tgl" => date("Y-m-d", strtotime($cek_adendum2['created_date'])),
		        //                     "teks" => "Sudah 1 Bulan",
		        //                     "url" => base_url().'eksploitasi'
		        //                 );
		        //                 $response[] = $val2;
		        //         }
		                
		                                
		        // }
			}

			
  		}

  		$hasil3 = $this->crud->getAllAdendum();
  		if(count($hasil3) > 0)
  		{
  			
  			$response2 = array(
  				"code" => 0
  			);
		
			foreach($hasil3 AS $v3)
			{
				
				if($v3->created_date != null)
		        {
		                $tanggal5 = date_create(date("Y-m-d"));
		                $tanggal6 = date_create(date("Y-m-d",strtotime($v3->created_date)));
		                $selisih_hari3 = date_diff($tanggal6,$tanggal5);

		                if($tanggal6 < $tanggal5)
		                {
		                        if($selisih_hari3->format("%r%a") > 30)
		                        {     
		                                $val3 = array(
		                                	"kode" => $v3->adendum_kd,
		                                	"tgl" => date("Y-m-d", strtotime($v3->created_date)),
		                                	"teks" => "Sudah 1 Bulan",

		                                	"url" => base_url().'adendum'
		                                );
		                                $response[] = $val3;
		                        }
		                        
		                }
		                
		                                
		    	}
		        
			}

			
  		}

  		// order array by tgl
  		if(sizeof($response) > 0)
  		{
  			$tgl = array_column($response, 'tgl');
			array_multisort($tgl, SORT_DESC, $response);
  		}
  		


  		if(count($response) == 0)
  		{
  			
  			$response = array(
  				"kode" => null,
  				"tgl" => null,
  				"teks" => null,
  				"tone" => null,
  				"url" => null
  			);
  			$response2 = array(
  				"code" => 1
  			);
  			//var_dump($response);die();

  		}


  		header('Access-Control-Allow-Origin: *');
		echo json_encode(array($response,$response2));
  		
		
	  	
	
	}


	




	





}
