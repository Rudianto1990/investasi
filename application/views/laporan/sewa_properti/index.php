  
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <div class="box box-default">

            <div class="box-body">
              
             <div class="form-inline text-center">
                
                  <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tgl.Awal" id="from" name="from" value="<?php if($this->input->get("from")){echo $this->input->get("from");}else{echo "";}?>">
                        <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="time">To</label>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tgl.Akhir" id="to" name="to" value="<?php if($this->input->get("to")){echo $this->input->get("to");}else{echo "";}?>">  
                        <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                      </div>              
                  </div>

                  <div class="form-group">
                      <select class="form-control" name="type" id="type">
                        <option value="All" <?php if($this->input->get("type") == null || $this->input->get("type") == "All"){echo "selected";}?>>All</option>
                        <option value="Hutang" <?php if($this->input->get("type") == "Hutang"){echo "selected";}?>>Hutang</option>
                        <option value="Lunas" <?php if($this->input->get("type") == "Lunas"){echo "selected";}?>>Lunas</option>
                      </select>
                  </div>

                  <div class="form-group">
                      <button class="btn btn-primary btn-block" id="proses">Proses</button>
                  </div>
                
            </div>

            </div>
            
           
          </div>
         
        </div>
        
      </div>



      <?php if($this->input->get("from") && $this->input->get("to") && $this->input->get("type")):?>
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <div class="box box-default">
           

            <div class="box-body">

                <div style="margin-bottom: 20px;">
                    <button class="btn btn-primary" id="cetakPDF"><i class="fa fa-print"></i> Cetak PDF</button>
                    <button class="btn btn-success" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                </div>

                <div class="text-center" style="margin-bottom: 20px;">

                  <div style="font-weight: 600;font-size: 20px;">LAPORAN SEWA PROPERTI</div>
                  <div style="font-size: 15px;">IPC Pelabuhan II - Kantor Cabang Priok</div>
                  <div style="font-size: 15px;">Periode : <?php echo $this->input->get("from");?> s/d <?php echo $this->input->get("to");?> </div>

                </div>
              
               <div class="table-responsive">
                 <table class="table table-bordered">
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
                   ?>

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
        var type = $("#type").val();
        location.href= dns+ "laporan/laporan_sewa_properti/index?from="+from+"&to="+to+"&type="+type;
    });

   $("#exportExcel").on("click",function(){
        var from = $("#from").val();
        var to = $("#to").val();
        var type = $("#type").val();
        location.href= dns+ "laporan/laporan_sewa_properti/export_excel?from="+from+"&to="+to+"&type="+type;
  });

    $("#cetakPDF").on("click",function(){
        var from = $("#from").val();
        var to = $("#to").val();
        var type = $("#type").val();
        window.open(dns+ "laporan/laporan_sewa_properti/cetak_pdf?from="+from+"&to="+to+"&type="+type);
    });

</script>
     