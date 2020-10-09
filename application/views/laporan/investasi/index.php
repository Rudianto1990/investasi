  
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <div class="box box-default">

            <div class="box-body">
              
             <div class="form-inline text-center">
                
                  <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="START" id="from" name="from" value="<?php if($this->input->get("from")){echo $this->input->get("from");}else{echo "";}?>">
                        <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="time">To</label>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="END" id="to" name="to" value="<?php if($this->input->get("to")){echo $this->input->get("to");}else{echo "";}?>">  
                        <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                      </div>              
                  </div>

                  

                  <div class="form-group">
                      <button class="btn btn-primary btn-block" id="proses">Proses</button>
                  </div>
                
            </div>

            </div>
            
           
          </div>
         
        </div>
        
      </div>



      <?php if($this->input->get("from") && $this->input->get("to")):?>
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <div class="box box-default">
           

            <div class="box-body">

                <div style="margin-bottom: 20px;">
                    <button class="btn btn-primary" id="cetakPDF"><i class="fa fa-print"></i> Cetak PDF</button>
                    <button class="btn btn-success" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                </div>

                <div class="text-center" style="margin-bottom: 20px;">

                  <div style="font-weight: 600;font-size: 20px;">LAPORAN INVESTASI - IPC Pelabuhan II Kantor Cabang Priok</div>
                  <div style="font-size: 15px;">Alamat Kantor : Jl.Raya Pasoso</div>
                  <div style="font-size: 15px;">Periode : <?php echo $this->input->get("from");?> s/d <?php echo $this->input->get("to");?> </div>

                </div>
              
               <div class="table-responsive">
                 <table class="table table-bordered">
                   <tr>
                     <th style="text-align: center;vertical-align: middle">No</th>
                     <th style="text-align: center;vertical-align: middle">PR NUMBER</th>
                     <th style="text-align: center;vertical-align: middle">PO NUMBER</th>
                     <th style="text-align: center;vertical-align: middle">NAMA BIDANG</th>
                     <th style="text-align: center;vertical-align: middle">URAIAN PEKERJAAN</th>
                     <th style="text-align: center;vertical-align: middle">NOMOR KONTRAK</th>
                     <th style="text-align: center;vertical-align: middle">NILAI PEKERJAAN</th>
                     <th style="text-align: center;vertical-align: middle">MULAI PEKERJAAN</th>
                     <th style="text-align: center;vertical-align: middle">SELESAI PEKERJAAN</th>
                     <th style="text-align: center;vertical-align: middle">JAMINAN SELESAI</th>
                     <th style="text-align: center;vertical-align: middle">INDIKATOR</th>
                   </tr>
                   <?php $num=1;foreach($hasil AS $v):?>

                   <?php

                      // $cek_adendum = $this->crud->getAdendumInvestasiBy($v->investasi_id);
                      
                      // if($cek_adendum['created_date'] == null)
                      if($v->investasi_selesai_pekerjaan != null)
                      {
                                $tanggal1 = new DateTime(date("Y-m-d"));
                                $tanggal2 = new DateTime(date("Y-m-d",strtotime($v->investasi_selesai_pekerjaan)));
                                //$selisih_hari = date_diff($tanggal2,$tanggal1);

                                $selisih_hari = $tanggal2->diff($tanggal1)->format("%a");

                                if($selisih_hari >= 30){
                                    
                                      $indikator = "<span><i class='fa fa-circle' style='color:lime;'></i></span>";
                                  }
                                  elseif($selisih_hari < 30 && $selisih_hari >= 21)
                                  {
                                      
                                      $indikator = "<span><i class='fa fa-circle' style='color:yellow;'></i></span>";
                                  }
                                  elseif($selisih_hari < 21 && $selisih_hari >= 14)
                                  {
                                      
                                      $indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
                                  }
                                  else
                                  {
                                    
                                    $indikator = "<span><i class='fa fa-circle' style='color:purple;'></i></span>";
                                  }
                                }
                          /*      else
                                {
                                   // $indikator = "N/A";
                                    $indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
                                }
                                
                      }
                      else
                      {

                            $indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>"; 
                            --BATAS BLOK*/


                              // $tanggal1 = date_create(date("Y-m-d"));
                              // $tanggal2 = date_create(date("Y-m-d",strtotime($cek_adendum['created_date'])));
                              // $selisih_hari = date_diff($tanggal2,$tanggal1);

                                
                              // if($selisih_hari->format("%r%a") >= 0 && $selisih_hari->format("%r%a") <= 14)
                              // {                     
                              //         $indikator = "<span><i class='fa fa-circle' style='color:red;'></i></span>";
                              // }
                              // elseif($selisih_hari->format("%r%a") >= 15 && $selisih_hari->format("%r%a") <= 27)
                              // {
                              //         $indikator = "<span><i class='fa fa-circle' style='color:yellow;'></i></span>";
                              // }
                              // elseif($selisih_hari->format("%r%a") >= 28 && $selisih_hari->format("%r%a") <= 30)
                              // {                     
                              //         $indikator = "<span><i class='fa fa-circle' style='color:green;'></i></span>";
                              // }
                              // else
                              // {                   
                              //       $indikator = "<span><i class='fa fa-circle' style='color:purple;'></i></span>";
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
                 </table>
               </div>

            </div>
            
           
          </div>
         
        </div>
        
      </div>
    <?php endif;?>


      
<script type="text/javascript">

    var dns = "<?php echo base_url();?>";
   
    $(document).ready(function() {

        // date picker
        $('#from, #to').datepicker({
            todayBtn: "linked",
            format: 'dd-mm-yyyy',
            // default: true,
            autoclose: true
        });

    });

   $( "#proses" ).click(function() {
        var from = $("#from").val();
        var to = $("#to").val();
       
        location.href= dns+ "laporan/laporan_investasi/index?from="+from+"&to="+to;
    });

   $("#exportExcel").on("click",function(){
        var from = $("#from").val();
        var to = $("#to").val();
       
        location.href= dns+ "laporan/laporan_investasi/export_excel?from="+from+"&to="+to;
  });

    $("#cetakPDF").on("click",function(){
        var from = $("#from").val();
        var to = $("#to").val();
        
        window.open(dns+ "laporan/laporan_investasi/cetak_pdf?from="+from+"&to="+to);
    });

</script>
     