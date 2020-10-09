   <!DOCTYPE html>
   <html>
   <head>
       <!-- meta data & title -->
            <!-- <meta charset="utf-8"> -->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title><?php echo $title;?></title>
            <!-- <title>CETAK PROFORMA INVOICE</title> -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            
            <!-- CSS dari SII_CI RIZKY -->
            <!-- <link href="<?php //echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
            <link href="<?php //echo base_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
            <script src="<?php //echo base_url('assets/js/bootstrap.js');?>"></script> -->

            <style type="text/css">
                @page { margin: 40px 50px; }

                table{
                  border-collapse: collapse;
                  font-family: arial;
                  color:#000;
                }
                thead th{
                  text-align: left;
                  padding: 10px;
                }
                tbody td{
                  border-top: 1px solid #e3e3e3;
                  padding: 10px;
                }
                tbody tr:nth-child(even){
                  background: #FFF;
                }
                tbody tr:hover{
                  background: #FFF
                }

                .clearfix:after {
                  content: "";
                  display: table;
                  clear: both;
                }

                /*header {
                  padding: 10px 0;
                  margin-bottom: 30px;
                }*/

                #project span {
                  /*color: #5D6975;*/
                  text-align: right;
                  width: 52px;
                  margin-right: 10px;
                  display: inline-block;
                  /*font-size: 0.9em;*/
                  padding-left: 20px;

                  /*font-weight: 600;*/
                }

                #company {
                  /*float: right;*/
                  position: relative;
                  text-align: right;
                  padding-top: -115px; /*120px*/
                  padding-right: 20px;

                  /*font-weight: 600;
                  font-size: 0.9em;*/
                  /*display: inline-block;
                  font-size: 0.9em;
                  width: 52px;*/
                }

                #project div,
                #company div {
                  white-space: nowrap;        
                }

                ::selection{ background-color: white; }
                ::moz-selection{ background-color: white; }
                ::webkit-selection{ background-color: white; }

                /*@page { 
                    margin: 100px 25px; 
                }*/
                header { 
                    position: fixed; 
                    top: -60px; 
                    left: 0px; 
                    right: 0px; 
                    background-color: lightblue; 
                    height: 50px; 
                }
                footer {
                    position: fixed;
                    bottom: -60px;
                    left: 0px;
                    right: 0px;
                    background-color: lightblue; 
                    height: 50px; 
                }
                p { 
                    page-break-after: always; 
                }
                p:last-child {
                    page-break-after: never; 
                }

                /*.logo
                {
                    background-image: url("<?php //echo $logo;?>");
                    background-repeat: no-repeat;
                    display: inline-block;
                    width: 90px;
                    height: 90px;
                }*/

                body {
                    background-color: #fff;
                    /*font: 13px/20px normal Helvetica, Arial, sans-serif;*/
                }
                
                /*.header_fixed
                {
                    position: fixed;
                    padding-top: 45px;
                }*/

                .container_judul
                {
                    padding-top: -35px;
                    padding-left: 100px;
                }

                h2.jdl_awal
                {
                   /* padding-top: -55px;*/
                    font-size: 22px;
                    font-family: normal;
                }

                .isi_judul
                {
                    margin-top: 7px;
                }

                h3.judul
                {
                    text-align: center;
                    font-family: Verdana;
                    padding-top: 15px;
                    padding-bottom: 1px;
                    font-size: 17px;
                }
                
                .tengah
                {
                  text-align: center;
                }
                
                .isi
                {
                    text-align: center;
                    padding-top: 15px;
                    padding-bottom: 15px;
                }

                /*.header,*/
                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                }
                /*.header {
                    top: 0px;
                }*/
                .footer {
                    bottom: 0px;
                }
                .pagenum:before {
                    content: counter(page);
                }

                .dot {
                  height: 25px;
                  width: 90px;
                  background-color: #bbb;
                  border-radius: 50%;
                  display: inline-block;
                }
                
            </style>

            
   </head>   
   <body>
       <!--  <div class="footer">
            Page <span class="pagenum"></span>
        </div> -->

        <div class="tengah" style="margin-bottom: 20px;">
            <div style="font-weight: 600;font-size: 20px;">LAPORAN INVESTASI - IPC Pelabuhan II Kantor Cabang Priok</div>
            <div style="font-size: 15px;">Alamat Kantor : Jl.Raya Pasoso</div>
            <div style="font-size: 15px;">Periode : <?php echo $this->input->get("from");?> s/d <?php echo $this->input->get("to");?></div>
        </div>
                 

        <table width="100%" cellspacing="0" cellpadding="1" style="font-size: 15px;margin-top: 20px;" border="1">
              <thead>
                   <tr>
                    <th style="text-align: center;vertical-align: middle">NO</th>
                     <th style="text-align: center;vertical-align: middle">PR NUMBER</th>
                     <th style="text-align: center;vertical-align: middle">PO NUMBER</th>
                     <th style="text-align: center;vertical-align: middle">NAMA BIDANG</th>
                     <th style="text-align: center;vertical-align: middle">URAIAN PEKERJAAN</th>
                     <th style="text-align: center;vertical-align: middle">NO KONTRAK</th>
                     <th style="text-align: center;vertical-align: middle">NILAI PEKERJAAN</th>
                     <th style="text-align: center;vertical-align: middle">MULAI PEKERJAAN</th>
                     <th style="text-align: center;vertical-align: middle">SELESAI</th>
                     <th style="text-align: center;vertical-align: middle">JAMINAN SELESAI</th>
                     <th style="text-align: center;vertical-align: middle">INDIKATOR</th>
                   </tr>
              </thead>
              <tbody>
                  <?php $num=1;foreach($hasil AS $v):?>

                   <?php

                      // $cek_adendum = $this->crud->getAdendumInvestasiBy($v->investasi_id);
                      
                      // if($cek_adendum['created_date'] == null)
                      if($v->investasi_selesai_pekerjaan != null)
                      {
                                $tanggal1 = new DateTime(date("Y-m-d"));
                                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->investasi_selesai_pekerjaan)));
                                // $selisih_hari = date_diff($tanggal2,$tanggal1);
                                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

                                if($selisih_hari >= 30)
                                {
                                  // if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
                                  // {                                 
                                      $indikator = "<span style='color: lime;font-size: 50px;'>&bull;<span>";
                                  }
                                  elseif($selisih_hari < 30 && $selisih_hari >= 21)
                                  {                                   
                                      $indikator = "<span style='color: yellow;font-size: 50px;'>&bull;<span>";
                                  }
                                  elseif($selisih_hari < 21 && $selisih_hari >= 14)
                                  {                                    
                                      $indikator = "<span style='color: red;font-size: 50px;'>&bull;<span>";
                                  }
                                  else
                                  {
                                    
                                    $indikator = "<span style='color: purple;font-size: 50px;'>&bull;<span>";
                                  }
                                }
                                // else
                                // {
                                //   // $indikator = "N/A";
                                //   $indikator = "<span style='color: red;font-size: 50px;'>&bull;<span>";
                                // }
                                
                      // }
                      /* --batas Blok
                      else
                      {

                            $indikator = "<span style='color: red;font-size: 50px;'>&bull;<span>"; Batas Blok */
                            
                              // $tanggal1 = date_create(date("Y-m-d"));
                              // $tanggal2 = date_create(date("Y-m-d",strtotime($cek_adendum['created_date'])));
                              // $selisih_hari = date_diff($tanggal2,$tanggal1);

                                
                              // if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
                              // {                     
                              //       $indikator = "<span style='color: red;font-size: 50px;'>&bull;<span>";
                              // }
                              // elseif($selisih_hari->format("%r%a") >= 15 && $selisih_hari->format("%r%a") <= 27)
                              // {
                              //       $indikator = "<span style='color: yellow;font-size: 50px;'>&bull;<span>";
                              // }
                              // elseif($selisih_hari->format("%r%a") >= 28 && $selisih_hari->format("%r%a") <= 30)
                              // {                     
                              //       $indikator = "<span style='color: green;font-size: 50px;'>&bull;<span>";
                              // }
                              // else
                              // {                   
                              //       $indikator = "<span style='color: purple;font-size: 50px;'>&bull;<span>";
                              // }
                                
                      // }

                   ;?>
                   
                   <tr>
                     <td style="text-align: center;vertical-align: middle"><?php echo $num;?>.</td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->investasi_pr_number;?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->investasi_po_number;?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->bidang_nama;?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->investasi_uraian_pekerjaan;?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->investasi_no_kontrak;?></td>
                     <td style="text-align: right;vertical-align: middle"><?php echo number_format($v->investasi_nilai_pekerjaan,0,',','.');?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo date("d/m/Y", strtotime($v->investasi_mulai_pelaksanaan));?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo date("d/m/Y", strtotime($v->investasi_selesai_pekerjaan));?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo date("d/m/Y", strtotime($v->investasi_tanggal_jaminan_pelaksanaan));?></td>
                    
                     <td style="text-align: center;vertical-align: middle"><?php echo $indikator;?></td>
                   </tr>
                  <?php $num++;endforeach;?>

                  <?php if(count($hasil) == 0):?>
                  <tr height="150">
                    <td colspan="11" style="vertical-align: middle;text-align: center">Data Tidak Ditemukan...</td>
                  </tr>
                  <?php endif;?>
              </tbody>
        </table>
           
           

        
   </body>
   </html>
    

    