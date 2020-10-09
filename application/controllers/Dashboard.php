<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		
	}
	
	public function index()
	{
		require_once(APPPATH.'libraries/Template.php');
		$main = new template();

		$data['title'] = 'Dashboard';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        //$this->layout->set_privilege(1);
  //       $data['page'] = 'Dashboard/Index';
		// $this->load->view('template/backend', $data);

		$data['countInvestasi'] = $this->crud->countAllInvestasi();

		$data['countEksploitasi'] = $this->crud->countAllEksploitasi();

		$data['countAdendum'] = $this->crud->countAllAdendum();

		$data['investasiSeminggu'] = $this->getInvestasiSeminggu();
		$data['eksploitasiSeminggu'] = $this->getEksploitasiSeminggu();
		$data['adendumSeminggu'] = $this->getAdendumSeminggu();

		$data['investasiDuaMinggu'] = $this->getInvestasiDuaMinggu();
		$data['eksploitasiDuaMinggu'] = $this->getEksploitasiDuaMinggu();
		$data['adendumDuaMinggu'] = $this->getAdendumDuaMinggu();

		$data['investasiSebulan'] = $this->getInvestasiSebulan();
		$data['eksploitasiSebulan'] = $this->getEksploitasiSebulan();
		$data['adendumSebulan'] = $this->getAdendumSebulan();

		$data['investasiMelewati'] = $this->getInvestasiMelewati();
		$data['eksploitasiMelewati'] = $this->getEksploitasiMelewati();
		$data['adendumMelewati'] = $this->getAdendumMelewati();

		$main->display("Dashboard/Index",$data);
	
	}


	public function getInvestasiSeminggu() //1 Bulan
	{
		$hasil = $this->crud->getAllInvestasi();

		$count = 0;
		foreach($hasil AS $v)
		{
			$cek_adendum = $this->crud->getAdendumInvestasiBy($v->investasi_id);
                      
	        if($cek_adendum['adendum_selesai_pekerjaan'] == null)
	        {
	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->investasi_selesai_pekerjaan)));
	                //$selisih_hari = date_diff($tanggal2,$tanggal1);

	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                if($selisih_hari >= 30)
	                {
	                        if($selisih_hari < 30 && $selisih_hari >= 21)
	                        {     
	                                $count += 1;
	                        }
	                        // echo '<pre>';
	                        // print_r($selisih_hari);exit();
	                        // echo '</pre>';
	                }

	                                
	    	}
	        else
	        {

	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($cek_adendum['adendum_selesai_pekerjaan'])));
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                                
	                if($selisih_hari >= 30 )
	                { 
	                	   if($selisih_hari < 30 && $selisih_hari >= 21 )
	                         {                
	                    		$count += 1;
	                    	 }
	                }                    
	             }
		   }

		   return $count;
	}

	public function getEksploitasiSeminggu() //1 Bulan
	{
		$hasil = $this->crud->getAllEksploitasi();

		$count = 0;
		foreach($hasil AS $v)
		{
			$cek_adendum = $this->crud->getAdendumEksploitasiBy($v->eksploitasi_id);
                      
	        if($cek_adendum['adendum_selesai_pekerjaan'] == null)
	        {
	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->eksploitasi_selesai_pekerjaan)));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                if($selisih_hari >= 30)
	                {
	                        if($selisih_hari < 30 && $selisih_hari >= 21)
	                        {     
	                                $count += 1;
	                        }
	                }      
	                           
	    	}
	        else
	        {

	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($cek_adendum['adendum_selesai_pekerjaan'])));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                                
	                if ( $selisih_hari >= 30 ) 
	                {  
	                	if($selisih_hari < 30 && $selisih_hari >= 21)
	                        {                       
	                   		 $count += 1;
	                }
	             }   
	                                
	        }
		}
		return $count;
		



	}


	public function getInvestasiDuaMinggu() //KURANG DARI 1 BULAN
	{
		$hasil = $this->crud->getAllInvestasi();

		$count = 0;
		foreach($hasil AS $v)
		{
			$cek_adendum = $this->crud->getAdendumInvestasiBy($v->investasi_id);
                      
	        if($cek_adendum['adendum_selesai_pekerjaan'] == null)
	        {
	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->investasi_selesai_pekerjaan)));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);

	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");


	                if($selisih_hari >= 21 )
	                {
	                        // if($selisih_hari < 14 && $selisih_hari >= 7)
	                        // {     
	                                $count += 1;
	                        }
	                        
	                // }
	                
	                                
	    	}
	        else
	        {

	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($cek_adendum['adendum_selesai_pekerjaan'])));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                if ($selisih_hari >= 21) 
	                {                
		                // if($selisih_hari < 14 && $selisih_hari >= 7)
		                // {                     
		                    $count += 1;
		                }
	                // }
	                                
	        }
		}
		return $count;
		



	}

	public function getEksploitasiDuaMinggu() //KURANG DARI 1 BULAN
	{
		$hasil = $this->crud->getAllEksploitasi();

		$count = 0;
		foreach($hasil AS $v)
		{
			$cek_adendum = $this->crud->getAdendumEksploitasiBy($v->eksploitasi_id);
                      
	        if($cek_adendum['adendum_selesai_pekerjaan'] == null)
	        {
	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->eksploitasi_mulai_pelaksanaan)));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                if($selisih_hari >= 21)
	                {
	                        // if($selisih_hari < 14 && $selisih_hari >= 7)
	                        // {     
	                                $count += 1;
	                        }
	                        
	                // }
	                
	                                
	    	}
	        else
	        {

	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($cek_adendum['adendum_selesai_pekerjaan'])));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");


	                                
	                if($selisih_hari >= 21)
	                {                     
	                    $count += 1;
	                }
	                
	                                
	        }
		}
		return $count;
		



	}



	public function getInvestasiSebulan() // 2 MINGGU
	{
		$hasil = $this->crud->getAllInvestasi();

		$count = 0;
		foreach($hasil AS $v)
		{
			$cek_adendum = $this->crud->getAdendumInvestasiBy($v->investasi_id);
                      
	        if($cek_adendum['adendum_selesai_pekerjaan'] == null)
	        {
	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->investasi_selesai_pekerjaan)));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);

	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                if($selisih_hari >= 14)
	                {
	                        // if($selisih_hari < 7 && $selisih_hari >= 1)
	                        // {     
	                                $count += 1;
	                        }
	                        
	                // }

	    	}
	        else
	        {

	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($cek_adendum['adendum_selesai_pekerjaan'])));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");
	                                
	                if($selisih_hari >= 14)
	                {                     
	                    $count += 1;
	                }
	                
	                                
	        }
		}
		return $count;
		



	}


	public function getEksploitasiSebulan() // 2 MINGGU
	{
		$hasil = $this->crud->getAllEksploitasi();

		$count = 0;
		foreach($hasil AS $v)
		{
			$cek_adendum = $this->crud->getAdendumEksploitasiBy($v->eksploitasi_id);
                      
	        if($cek_adendum['adendum_selesai_pekerjaan'] == null)
	        {
	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->eksploitasi_selesai_pekerjaan)));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);

	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                if($selisih_hari >= 14)
	                {
	                        // if($selisih_hari < 7 && $selisih_hari >= 1)
	                        // {     
	                                $count += 1;
	                        }
	                        
	                // }
	                
	                                
	    	}
	        else
	        {

	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($cek_adendum['adendum_selesai_pekerjaan'])));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                                
	                if($selisih_hari >= 14)
	                {                     
	                    $count += 1;
	                }
	                
	                                
	        }
		}
		return $count;
		



	}


	public function getInvestasiMelewati() // 0 HARI
	{
		$hasil = $this->crud->getAllInvestasi();

		$count = 0;
		foreach($hasil AS $v)
		{
			$cek_adendum = $this->crud->getAdendumInvestasiBy($v->investasi_id);
                      
	        if($cek_adendum['adendum_selesai_pekerjaan'] == null)
	        {
	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->investasi_selesai_pekerjaan)));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");
	                	# code...
	                
	                if($selisih_hari == 0)
	                {
	                        // if($selisih_hari ==)
	                        // {     
	                                $count += 1;
	                        }
	                        
	                // }
	                
	                                
	    	}
	        else
	        {

	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($cek_adendum['adendum_selesai_pekerjaan'])));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                                
	                if($selisih_hari == 0)
	                {                     
	                    $count += 1;
	                }
	                
	                                
	        }
		}
		return $count;
		



	}


	public function getEksploitasiMelewati() // 0 Hari
	{
		$hasil = $this->crud->getAllEksploitasi();

		$count = 0;
		foreach($hasil AS $v)
		{
			$cek_adendum = $this->crud->getAdendumEksploitasiBy($v->eksploitasi_id);
                      
	        if($cek_adendum['adendum_selesai_pekerjaan'] == null)
	        {
	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->eksploitasi_selesai_pekerjaan)));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                if($selisih_hari == 0)
	                {
	                        // if($selisih_hari->format("%r%a") > 30)
	                        // {     
	                                $count += 1;
	                        }
	                        
	                // }
	                
	                                
	    	}
	        else
	        {

	                $tanggal1 = new DateTime(date("Y-m-d"));
	                $tanggal2 = new DateTime(date("Y-m-d",strtotime($cek_adendum['adendum_selesai_pekerjaan'])));
	                // $selisih_hari = date_diff($tanggal2,$tanggal1);
	                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

	                                
	                if($selisih_hari == 0)
	                {                     
	                    $count += 1;
	                }
	                
	                                
	        }
		}
		return $count;
		



	}




	// adendum


	public function getAdendumSeminggu() // 1 BULAN
	{
		$hasil = $this->crud->getAllAdendum();

		$count = 0;
		foreach($hasil AS $v)
		{
			
	                $tanggal1 = date_create(date("Y-m-d"));
	                $tanggal2 = date_create(date("Y-m-d",strtotime($v->created_date)));
	                $selisih_hari = date_diff($tanggal2,$tanggal1);

	                if($tanggal2 <= $tanggal1)
	                {
	                        if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
	                        {     
	                                $count += 1;
	                        }
	                        
	                }
	                
	                                
	    	
		}
		
		return $count;
		
	}

	public function getAdendumDuaMinggu() // KURANG 1 BULAN
	{
		$hasil = $this->crud->getAllAdendum();

		$count = 0;
		foreach($hasil AS $v)
		{
			
	                $tanggal1 = date_create(date("Y-m-d"));
	                $tanggal2 = date_create(date("Y-m-d",strtotime($v->created_date)));
	                $selisih_hari = date_diff($tanggal2,$tanggal1);

	                if($tanggal2 <= $tanggal1)
	                {
	                        if($selisih_hari->format("%r%a") >= 15 && $selisih_hari->format("%r%a") <= 27)
	                        {     
	                                $count += 1;
	                        }
	                        
	                }
	                
	                                
	    	
		}
		return $count;
		
	}

	public function getAdendumSebulan() // 2 MINGGU
	{
		$hasil = $this->crud->getAllAdendum();

		$count = 0;
		foreach($hasil AS $v)
		{
			
	                $tanggal1 = date_create(date("Y-m-d"));
	                $tanggal2 = date_create(date("Y-m-d",strtotime($v->created_date)));
	                $selisih_hari = date_diff($tanggal2,$tanggal1);

	                if($tanggal2 <= $tanggal1)
	                {
	                        if($selisih_hari->format("%r%a") >= 28 && $selisih_hari->format("%r%a") <= 30)
	                        {     
	                                $count += 1;
	                        }
	                        
	                }
	                
	                                
	    	
		}
		return $count;
		
	}

	public function getAdendumMelewati() // 0 HARI
	{
		$hasil = $this->crud->getAllAdendum();

		$count = 0;
		foreach($hasil AS $v)
		{
			
	                $tanggal1 = date_create(date("Y-m-d"));
	                $tanggal2 = date_create(date("Y-m-d",strtotime($v->created_date)));
	                $selisih_hari = date_diff($tanggal2,$tanggal1);

	                if($tanggal2 <= $tanggal1)
	                {
	                        if($selisih_hari->format("%r%a") > 30)
	                        {     
	                                $count += 1;
	                        }
	                        
	                }
	                
	                                
	    	
		}
		return $count;
		
	}










	

}
