   <!DOCTYPE html>
   <html>
   <head>
       <!-- meta data & title -->
            <meta charset="utf-8">
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


                
            </style>

   </head>   
   <body>
       <!--  <div class="footer">
            Page <span class="pagenum"></span>
        </div> -->

        <div class="tengah" style="margin-bottom: 20px;">
            <div style="font-weight: 600;font-size: 20px;">LAPORAN SEWA PROPERTI</div>
            <div style="font-size: 15px;">IPC Pelabuhan II - Kantor Cabang Priok</div>
            <div style="font-size: 15px;">Periode : <?php echo $this->input->get("from");?> s/d <?php echo $this->input->get("to");?></div>
        </div>
                 

        <table width="100%" cellspacing="0" cellpadding="1" style="font-size: 15px;margin-top: 20px;" border="1">
              <thead>
                   <tr>
                     <th style="text-align: center;vertical-align: middle">No</th>
                     <th style="text-align: center;vertical-align: middle">Nama Penyewa</th>
                     <th style="text-align: center;vertical-align: middle">Kategori</th>
                     <th style="text-align: center;vertical-align: middle">Banyaknya</th>
                     <th style="text-align: center;vertical-align: middle">Tgl.Mulai</th>
                     <th style="text-align: center;vertical-align: middle">Tgl.Selesai</th>
                     <th style="text-align: center;vertical-align: middle">No.Kontrak</th>
                     <th style="text-align: center;vertical-align: middle">Tgl.Kontrak</th>
                     <th style="text-align: center;vertical-align: middle">Status Sewa</th>
                     <th style="text-align: center;vertical-align: middle">Nominal</th>
                     <th style="text-align: center;vertical-align: middle">Info Tagihan</th>
                     <th style="text-align: center;vertical-align: middle">Status</th>
                   </tr>
              </thead>
              <tbody>
                   <?php $num=1;foreach($hasil AS $v):?>
                   <?php
                      if($v->tgl_batas_pembayaran != null)
                      {
                          $tanggal1 = date_create(date("Y-m-d"));
                          $tanggal2 = date_create(date("Y-m-d",strtotime($v->tgl_batas_pembayaran)));
                          $selisih_hari = date_diff($tanggal1,$tanggal2);

                          $infoTagihan = $selisih_hari->format("%r%a")." hari lagi";
                      }
                      else
                      {
                          $infoTagihan = '-';
                      }
                   ;?>
                   <tr>
                     <td style="text-align: center;vertical-align: middle"><?php echo $num;?>.</td>
                     <td style="text-align: center;vertical-align: middle"><?php echo ucwords($v->nama_penyewa);?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->sewa_kategori_nama;?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->jumlah;?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo date("d/m/Y", strtotime($v->tgl_mulai));?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo date("d/m/Y", strtotime($v->tgl_selesai));?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->no_kontrak;?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo date("d/m/Y", strtotime($v->tgl_kontrak));?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->status_sewa;?></td>
                     <td style="text-align: center;vertical-align: middle">Rp. <?php echo number_format($v->nominal,0,',','.');?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $infoTagihan;?></td>
                     <td style="text-align: center;vertical-align: middle"><?php echo $v->status_pembayaran;?></td>
                   </tr>
                  <?php $num++;endforeach;?>

                  <?php if(count($hasil) == 0):?>
                  <tr height="150">
                    <td colspan="12" style="vertical-align: middle;text-align: center">Data Tidak Ditemukan...</td>
                  </tr>
                  <?php endif;?>
              </tbody>
        </table>
           
           

        
   </body>
   </html>
    

    