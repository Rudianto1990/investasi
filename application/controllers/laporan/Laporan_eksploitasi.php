<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_eksploitasi extends CI_Controller {

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

		$data['title'] = 'Laporan Eksploitasi';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Laporan' => '',
            'Eksploitasi' => '',
        ];
        //$this->layout->set_privilege(1);

        if($this->input->get("from") != null)
        {
        	$from = date("Y-m-d", strtotime($this->input->get("from")));
        }
        else
        {
        	$from = null;
        }

        if($this->input->get("to") != null)
        {
        	$to = date("Y-m-d", strtotime($this->input->get("to")));
        }
        else
        {
        	$to = null;
        }

        $data['hasil'] = $this->crud->getFilterEksploitasi($from,$to);
  		

		$main->display("laporan/eksploitasi/index",$data);
	
	}


	function export_excel(){

		if($this->input->get("from") != null)
        {
        	$from = date("Y-m-d", strtotime($this->input->get("from")));
        	$judulfrom = date("d-m-Y", strtotime($this->input->get("from")));
        }
        else
        {
        	$from = null;
        	$judulfrom = null;
        }

        if($this->input->get("to") != null)
        {
        	$to = date("Y-m-d", strtotime($this->input->get("to")));
        	$judulto = date("d-m-Y", strtotime($this->input->get("to")));
        }
        else
        {
        	$to = null;
        	$judulto = null;
        }

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      $object->getActiveSheet()->setCellValue('A1', 'LAPORAN EXPLOITASI- IPC Pelabuhan II Kantor Cabang Priok');
		  $object->getActiveSheet()->mergeCells('A1:K1');

		  $object->getActiveSheet()->setCellValue('A2', 'Alamat Kantor : Jl.Raya Pasoso - Jakata Utara');
		  $object->getActiveSheet()->mergeCells('A2:K2');

		  $object->getActiveSheet()->setCellValue('A3', "Periode : $judulfrom s/d $judulto");
		  $object->getActiveSheet()->mergeCells('A3:K3');

		// set center
		$style = array(
        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

	    $object->getDefaultStyle("A1")->applyFromArray($style);
		// end set center untuk judul

      $table_columns = array("NO", "PR NUMBER", "PO NUMBER", "NAMA BIDANG", "URAIAN PEKERJAAN", "NO KONTRAK", "NILAI PEKERJAAN", "MULAI PEKERJAAN", "SELESAI PEKERJAAN", "JAMINAN SELESAI", "INDIKATOR");

      $column = 0;

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field); // column, row, data

        $column++;

      }

      	// set color and bold for column
      	$colFrom = "A4"; 
		$colTo = "K4"; 
		$object->getActiveSheet()->getStyle("$colFrom:$colTo")->getFont()->setBold( true );
		$object->getActiveSheet()->getStyle("$colFrom:$colTo")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('02d9ef');

		// set data
      $result_data = $this->crud->getFilterEksploitasi($from,$to);

      $excel_row = 5; // data dimulai dari row 5
      $num=1;
      foreach($result_data as $row){

      		// untuk indikator
      		// $cek_adendum = $this->crud->getAdendumEksploitasiBy($row->eksploitasi_id);
                      
        // 	if($cek_adendum['created_date'] == null)
          if($row->eksploitasi_selesai_pekerjaan != null)
        	{
                                $tanggal1 = new DateTime(date("Y-m-d"));
                                $tanggal2 = new DateTime(date("Y-m-d",strtotime($row->eksploitasi_selesai_pekerjaan)));
                                // $selisih_hari = date_diff($tanggal2,$tanggal1);

                                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

                                if($selisih_hari >= 30) //Jika Jumlah Hari Lebih dari 30 Hari
                                {
                                  // if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
                                  // {                                 
                                      $clr = "2FFF00"; /* Lime*/
                                  }
                                  elseif($selisih_hari < 30 && $selisih_hari  >= 21) //Jika hari kurang dari 30 Hari dan Lebih Dari 21 Hari
                                  {                                   
                                      $clr = "F0FF00"; /* kuning*/
                                  }
                                  elseif($selisih_hari < 21 && $selisih_hari >= 14) //Jika hari kurang dari 21 Hari dan Lebih Dari 14 Hari
                                  {                                    
                                      $clr = "F43607"; /* Merah*/
                                  }
                                  else
                                  {
                                     $clr = "F407EA"; /* Ungu*/ //Jika nilai 0 Hari 
                                  }
                                }                                          
                                
       /*--Batas Blok 	}
        	else
        	{


                              $clr = "6C3483";

                            --Batas Blok  */
                              
                              // $tanggal1 = date_create(date("Y-m-d"));
                              // $tanggal2 = date_create(date("Y-m-d",strtotime($cek_adendum['created_date'])));
                              // $selisih_hari = date_diff($tanggal2,$tanggal1);

                                
                              // if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
                              // {                     
                              //       $clr = "FF0000";
                              // }
                              // elseif($selisih_hari->format("%r%a") >= 15 && $selisih_hari->format("%r%a") <= 27)
                              // {
                              //        $clr = "F1C40F";
                              // }
                              // elseif($selisih_hari->format("%r%a") >= 28 && $selisih_hari->format("%r%a") <= 30)
                              // {                     
                              //       $clr = "239B56";
                              // }
                              // else
                              // {                   
                              //       $clr = "6C3483";
                              // }
                                
        	// }

        $str = '&bull;';
		    $str = html_entity_decode($str,ENT_QUOTES,'UTF-8');

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $num);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->eksploitasi_pr_number);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->eksploitasi_po_number);

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->bidang_nama);

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->eksploitasi_uraian_pekerjaan);

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->eksploitasi_no_kontrak);

        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, number_format($row->eksploitasi_nilai_pekerjaan,0,',','.'));

        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, date("d/m/Y", strtotime($row->eksploitasi_mulai_pelaksanaan)));

        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, date("d/m/Y", strtotime($row->eksploitasi_selesai_pekerjaan)));

        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, date("d/m/Y", strtotime($row->eksploitasi_tanggal_jaminan_pelaksanaan)));

        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $str);

        // setting font color pada baris K..
        $textColor = array(
	    'font'  => array(
	        // 'color' => array('rgb' => 'FF0000'),
	        'color' => array('rgb' => $clr),
	        'size'  => 15,
	    ));
        $object->getActiveSheet()->getStyle("K$excel_row")->applyFromArray($textColor);

        $excel_row++;
        $num++;
      }

      	// set width auto
      	foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
	    $object->getActiveSheet()
	            ->getColumnDimension($col)
	            ->setAutoSize(true);
	    }

      $judul = "Laporan-eksploitasi_from-".$judulfrom."_to-".$judulto.".xls";

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="'.$judul.'"');

      // header('Content-Disposition: attachment;filename="Employee Data.xls"');

      $object_writer->save('php://output');

    }


    function cetak_pdf()
    {

        if($this->input->get("from") != null)
        {
        	$from = date("Y-m-d", strtotime($this->input->get("from")));
        	$judulfrom = date("d-m-Y", strtotime($this->input->get("from")));
        }
        else
        {
        	$from = null;
        	$judulfrom = null;
        }

        if($this->input->get("to") != null)
        {
        	$to = date("Y-m-d", strtotime($this->input->get("to")));
        	$judulto = date("d-m-Y", strtotime($this->input->get("to")));
        }
        else
        {
        	$to = null;
        	$judulto = null;
        }

        $data['hasil'] = $this->crud->getFilterEksploitasi($from,$to);
    	

        $data['title'] = 'LAPORAN EKSPLOITASI';

        $this->load->view('laporan/eksploitasi/cetak_eksploitasi', $data);

        // $tgl= date("d-m-Y");
      
        $html = $this->output->get_output();
            
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A4", "landscape");
        
        $this->dompdf->load_html($html);
       
        $this->dompdf->render();
        
        // $this->dompdf->stream("LAPORAN_EKSPLOITASI-".$tgl.".pdf",array('Attachment'=>0));
        $this->dompdf->stream("LAPORAN-EKSPLOITASI_from-".$judulfrom.'_to-'.$judulto.".pdf",array('Attachment'=>0));
        
    }
	




	





}
