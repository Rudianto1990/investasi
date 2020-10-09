<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_sewa_properti extends CI_Controller {

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

		$data['title'] = 'Laporan Sewa Properti';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Laporan' => '',
            'Sewa Properti' => '',
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

        if($this->input->get("type") != null)
        {
        	$type = $this->input->get("type");
        }
        else
        {
        	$type = null;
        }

        $data['hasil'] = $this->crud->getFilterSewaProperti($from,$to,$type);
  		

		$main->display("laporan/sewa_properti/index",$data);
	
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

        if($this->input->get("type") != null)
        {
        	$type = $this->input->get("type");
        }
        else
        {
        	$type = null;
        }

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

      	$object->getActiveSheet()->setCellValue('A1', 'LAPORAN SEWA PROPERTI');
		$object->getActiveSheet()->mergeCells('A1:L1');

		$object->getActiveSheet()->setCellValue('A2', 'Alamat Kantor : Jl.Raya Pondok Gede Bogor');
		$object->getActiveSheet()->mergeCells('A2:L2');

		$object->getActiveSheet()->setCellValue('A3', "Periode : $judulfrom s/d $judulto");
		$object->getActiveSheet()->mergeCells('A3:L3');

		// set center
		$style = array(
        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

	    $object->getDefaultStyle("A1")->applyFromArray($style);
		// end set center untuk judul

      $table_columns = array("No", "Nama Penyewa", "Kategori", "Luas", "Tgl.Mulai", "Tgl.Selesai", "No.Kontrak", "Tgl.Kontrak", "Status Sewa", "Nominal", "Info Tagihan", "Status");

      $column = 0;

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field); // column, row, data

        $column++;

      }

      	// set color and bold for column
      	$colFrom = "A4"; 
		$colTo = "L4"; 
		$object->getActiveSheet()->getStyle("$colFrom:$colTo")->getFont()->setBold( true );
		$object->getActiveSheet()->getStyle("$colFrom:$colTo")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('02d9ef');

		// set data
      $result_data = $this->crud->getFilterSewaProperti($from,$to,$type);

      $excel_row = 5; // data dimulai dari row 5
      $num=1;
      foreach($result_data as $row){

      	if($row->tgl_batas_pembayaran != null)
		{
			$tanggal1 = date_create(date("Y-m-d"));
            $tanggal2 = date_create(date("Y-m-d",strtotime($row->tgl_batas_pembayaran)));
            $selisih_hari = date_diff($tanggal1,$tanggal2);

            $infoTagihan = $selisih_hari->format("%r%a")." hari lagi";
		}
		else
		{
			$infoTagihan = '-';
		}

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $num);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nama_penyewa);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->sewa_kategori_nama);

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, number_format($row->jumlah,0,',','.'));

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, date("d-m-Y", strtotime($row->tgl_mulai)));

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, date("d-m-Y", strtotime($row->tgl_selesai)));

        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->no_kontrak);

        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, date("d-m-Y", strtotime($row->tgl_kontrak)));

        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->status_sewa);

        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, number_format($row->nominal,0,',','.'));

        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $infoTagihan);

        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->status_pembayaran);

        $excel_row++;
        $num++;
      }

      	// set width auto
      	foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
	    $object->getActiveSheet()
	            ->getColumnDimension($col)
	            ->setAutoSize(true);
	    }

      $judul = "Laporan-sewa-properti_".$type."_from-".$judulfrom."_to-".$judulto.".xls";

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

        if($this->input->get("type") != null)
        {
        	$type = $this->input->get("type");
        }
        else
        {
        	$type = null;
        }

        $data['hasil'] = $this->crud->getFilterSewaProperti($from,$to,$type);
    	

        $data['title'] = 'LAPORAN SEWA PROPERTI - '.$type;

        $this->load->view('laporan/sewa_properti/cetak_sewa_properti', $data);

        // $tgl= date("d-m-Y");
      
        $html = $this->output->get_output();
            
        $this->load->library('dompdf_gen');
        $this->dompdf->set_paper("A4", "landscape");
        
        $this->dompdf->load_html($html);
       
        $this->dompdf->render();
        
        // $this->dompdf->stream("LAPORAN_SEWA_PROPERTI-".$type.'-'.$tgl.".pdf",array('Attachment'=>0));
        $this->dompdf->stream("LAPORAN-SEWA-PROPERTI_".$type.'_from-'.$judulfrom.'_to-'.$judulto.".pdf",array('Attachment'=>0));
        
    }
	




	





}
