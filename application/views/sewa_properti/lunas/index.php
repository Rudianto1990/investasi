  
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
               <!-- <button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button> -->
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body" style="min-height: 150px">
              
              <div class="table-responsive">
                <table class="table table-striped" id="table">
                  <thead>
                    <tr>
                      <th class="text-center" style="vertical-align: middle">#</th>
                      <th class="text-center" style="vertical-align: middle">Nama Penyewa</th>
                      <th class="text-center" style="vertical-align: middle">Kategori Sewa</th>
                      <th class="text-center" style="vertical-align: middle">Banyaknya</th>
                      <th class="text-center" style="vertical-align: middle">Tgl.Mulai</th>
                      <th class="text-center" style="vertical-align: middle">Tgl.Selesai</th>
                      <th class="text-center" style="vertical-align: middle">Status Sewa</th>
                      <th class="text-center" style="vertical-align: middle">Nominal</th>
                      <th class="text-center" style="vertical-align: middle">Status</th>
                      <th class="text-center" style="vertical-align: middle">Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>

            </div>
            
            <div class="box-footer">
            </div>
           
          </div>
         
        </div>
        
      </div>


 
    <!-- Modal Add / Edit -->
      
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cubes"></i> <span id="text">Form Sewa Properti - Lunas</span></h4>
                   </div>
                   <div class="modal-body">

                    <input type="hidden" name="sewa_properti_id" id="sewa_properti_id">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">Kode Sewa</label>
                          <div class="col-md-7">
                              <input type="text" name="sewa_properti_kd" id="sewa_properti_kd" class="form-control" placeholder="Kode Sewa" readonly value="<?php echo $code;?>">
                          </div>
                       </div>
                      </div>

                    </div> 

                    <div class="row" style="margin-top: 20px;">

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Status Pembayaran</label>
                            <div class="col-md-7">
                               <select class="form-control select2-sp" id="status_pembayaran" name="status_pembayaran" style="width: 100%;">
                                 <option value="Hutang">Hutang</option>
                                 <option value="Lunas">Lunas</option>
                               </select>
                           </div>
                        </div>
                      </div> 

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Nama Penyewa</label>
                            <div class="col-md-7">
                               <input type="text" name="nama_penyewa" id="nama_penyewa" class="form-control" placeholder="Nama Penyewa" required>
                           </div>
                        </div>
                      </div>  

                    </div>

                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">Kategori Sewa</label>
                          <div class="col-md-7">
                              <select class="form-control select2-ks" name="sewa_kategori_id" id="sewa_kategori_id" style="width: 100%;">
                                <option></option>
                                <?php foreach($kategori AS $v_k):?>
                                <option value="<?php echo $v_k->sewa_kategori_id;?>"><?php echo $v_k->sewa_kategori_nama;?></option>
                                <?php endforeach;?>
                              </select>
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Banyaknya</label>
                            <div class="col-md-7">
                               <input type="text" name="jumlah" id="jumlah" class="form-control" required>
                           </div>
                        </div>
                      </div>                       

                    </div> 

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Nominal</label>
                            <div class="col-md-7">
                                <input type="text" name="nominal" id="nominal" class="form-control">
                            </div>
                         </div>
                        </div> 

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Status Sewa</label>
                            <div class="col-md-7">
                                <select class="form-control select2-ss" name="status_sewa" id="status_sewa" style="width: 100%;">
                                  <option>Bulanan</option>
                                  <option>Tahunan</option>
                                </select>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Tgl.Mulai</label>
                            <div class="col-md-7">
                              <div class="input-group">
                                  <input type="text" name="tgl_mulai" id="tgl_mulai" class="form-control" placeholder="Tanggal Mulai" required>
                                  <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                           </div>
                        </div>
                      </div> 

                       <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Tgl.Selesai</label>
                            <div class="col-md-7">
                              <div class="input-group">
                                  <input type="text" name="tgl_selesai" id="tgl_selesai" class="form-control" placeholder="Tanggal Selesai" required>
                                  <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                           </div>
                        </div>
                      </div> 

                    </div>         

                    

                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">No Kontrak</label>
                            <div class="col-md-7">
                               <input type="text" name="no_kontrak" id="no_kontrak" class="form-control" placeholder="No Kontrak" required>
                           </div>
                        </div>
                      </div> 

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Tgl.Kontrak</label>
                            <div class="col-md-7">
                              <div class="input-group">
                                  <input type="text" name="tgl_kontrak" id="tgl_kontrak" class="form-control" placeholder="Tanggal Kontrak" required>
                                  <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                           </div>
                        </div>
                      </div> 

                    </div>  

                    
                        
 
                   </div>
                   <div class="modal-footer" id="btn1">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button id="simpan" class="btn btn-success" onclick="insertData();">Save</button>
                   </div>
                   <div class="modal-footer" id="btn2">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   </div>
                    </div>
            </div>
         </div>

 
     <!-- Modal Hapus -->
      
         <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" style="top: 25%;">
               <div class="modal-content">
                   
                   <div class="modal-body" style="padding: 30px">
                            <input type="hidden" id="id_hapus" class="form-control">
                            <div class="row">
                              <div class="col-md-12">
                                <strong>ANDA YAKIN AKAN MENGHAPUS DATA INI?</strong>
                              </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                              <div class="col-md-12">
                              <div class="pull-right">
                                  <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-danger btn-lg" onclick="hapusData();">OK</button>
                                </div>
                              </div>
                            </div>
                   </div>
                   
                    </div>
            </div>
         </div>
     
 

 

      
<script type="text/javascript">

    var dns = "<?php echo base_url();?>";

    // modal edit
    function preEdit(id)
    {      
            $.ajax({
                url: '<?php echo base_url();?>sewa_properti/lunas/getDetail/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    // console.log(result);

                    if(result.code==200)
                    { 

                        $("#text").text("Edit Sewa Properti - Lunas");

                        $("#sewa_properti_id").val(result.sewa_properti_id);
                        $("#sewa_properti_kd").val(result.sewa_properti_kd);

                        $("#status_pembayaran").val(result.status_pembayaran);
                        $('#status_pembayaran').select2().trigger('change');

                        $("#nama_penyewa").val(result.nama_penyewa);

                        // select 2 trigger untuk set value
                        $("#sewa_kategori_id").val(result.sewa_kategori_id);
                        $('#sewa_kategori_id').select2().trigger('change');

                        $("#status_sewa").val(result.status_sewa);
                        $('#status_sewa').select2().trigger('change');

                        $("#jumlah").val(result.jumlah);
                        $("#nominal").val(result.nominal);

                        // datepicker set value
                        $('#tgl_mulai').datepicker('setDate', result.tgl_mulai);
                        $('#tgl_selesai').datepicker('setDate', result.tgl_selesai);
                        $('#tgl_kontrak').datepicker('setDate', result.tgl_kontrak);
                        
                         $("#no_kontrak").val(result.no_kontrak);
                        // $("#eksploitasi_no_kontrak").val(result.eksploitasi_no_kontrak);
                        // $("#eksploitasi_no_kontrak").attr("disabled",true);

                        
                    }
                   

                }

            });

          $("#btn1").show();
          $("#btn2").hide();
          $("#myModal").modal();
        
    }

     // modal edit
    function preDetail(id)
    {      
            $.ajax({
                url: '<?php echo base_url();?>sewa_properti/lunas/getDetail/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    // console.log(result);

                    if(result.code==200)
                    { 

                        $("#text").text("Edit Sewa Properti - Lunas");

                        $("#sewa_properti_id").val(result.sewa_properti_id);
                        $("#sewa_properti_kd").val(result.sewa_properti_kd);

                        $("#status_pembayaran").val(result.status_pembayaran);
                        $('#status_pembayaran').select2().trigger('change');
                        $("#status_pembayaran").attr("disabled",true);

                        $("#nama_penyewa").val(result.nama_penyewa);
                        $("#nama_penyewa").attr("disabled",true);

                        // select 2 trigger untuk set value
                        $("#sewa_kategori_id").val(result.sewa_kategori_id);
                        $('#sewa_kategori_id').select2().trigger('change');
                        $("#sewa_kategori_id").attr("disabled",true);

                        $("#status_sewa").val(result.status_sewa);
                        $('#status_sewa').select2().trigger('change');
                        $("#status_sewa").attr("disabled",true);

                        $("#jumlah").val(result.jumlah);
                        $("#jumlah").attr("disabled",true);

                        $("#nominal").val(result.nominal);
                        $("#nominal").attr("disabled",true);

                        // datepicker set value
                        $('#tgl_mulai').datepicker('setDate', result.tgl_mulai);
                        $("#tgl_mulai").attr("disabled",true);
                        $('#tgl_selesai').datepicker('setDate', result.tgl_selesai);
                        $("#tgl_selesai").attr("disabled",true);
                        $('#tgl_kontrak').datepicker('setDate', result.tgl_kontrak);
                        $("#tgl_kontrak").attr("disabled",true);
                        
                         $("#no_kontrak").val(result.no_kontrak);
                         $("#no_kontrak").attr("disabled",true);
                        // $("#eksploitasi_no_kontrak").val(result.eksploitasi_no_kontrak);
                        // $("#eksploitasi_no_kontrak").attr("disabled",true);

                        
                    }
                   

                }

            });

          $("#btn1").hide();
          $("#btn2").show();
          $("#myModal").modal();
        
    }

    // modal hapus
    function preHapus(id)
    {
      $("#id_hapus").val(id);
      $("#modalHapus").modal();
    }

    // proses hapus data
    function hapusData(){
        var idhps = $("#id_hapus").val();
        $.ajax({
            url : dns + 'sewa_properti/lunas/delete/'+idhps,
            type: 'POST',
            dataType: "JSON",
            success: function(data) {
                alertify.set('notifier','position', 'top-right');
                alertify.success('<a style="color:#fff"><i class="fa fa-check-circle"></i> Berhasil hapus data terpilih...</a>');

                setTimeout(function() {
                      location.reload();
                }, 500);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertify.set('notifier','position', 'top-right');
                alertify.warning('<a style="color:#333"><i class="fa fa-exclamation-circle"></i> Gagal hapus data...</a>');
            }
        });
    };

    var table;
   
    $(document).ready(function() {

        $("#btn2").hide();

        // date picker
        $('#tgl_mulai, #tgl_selesai, #tgl_kontrak').datepicker({
            todayBtn: "linked",
            format: 'dd-mm-yyyy',
            // default: true,
            autoclose: true
        });

        // select2
        $('.select2-ks').select2({
            // minimumResultsForSearch: Infinity,
            // allowClear: true,
            width: '100%',
            placeholder: "Pilih Kategori Sewa...",
            // tags: true
        });

         $('.select2-ss').select2({
            // minimumResultsForSearch: Infinity,
            // allowClear: true,
            width: '100%',
            placeholder: "Pilih Status Sewa...",
            // tags: true
        });

          $('.select2-sp').select2({
            // minimumResultsForSearch: Infinity,
            // allowClear: true,
            width: '100%',
            placeholder: "Pilih Status Pembayaran...",
            // tags: true
        });

        // // min number
        // $("#eksploitasi_pr_number, #eksploitasi_po_number").attr({
        //     "min" : 0
        // });

        // mask
        // $("#eksploitasi_no_kontrak").inputmask("aa999.9.9.9.99999");  //static mask
        // $("#eksploitasi_no_kontrak").inputmask("99-9999999");  //static mask
        // $(selector).inputmask({"mask": "(999) 999-9999"}); //specifying options
        // $(selector).inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax
        $("#nominal, #jumlah").inputmask("currency", {'autoUnmask' : true});

        // hapus val ketika modal ditutup
        $('#myModal').on('hidden.bs.modal', function () {

            $("#text").text("Form Sewa Properti - Lunas");

            $("#sewa_properti_id").val("");

            $("#status_pembayaran").val("");
            $('#status_pembayaran').select2().trigger('change');
            $("#status_pembayaran").attr("disabled",false);

            $("#nama_penyewa").val("");
            $("#nama_penyewa").attr("disabled",false);

            // select 2 trigger untuk set value
            $("#sewa_kategori_id").val("");
            $('#sewa_kategori_id').select2().trigger('change');
            $("#sewa_kategori_id").attr("disabled",false);

            $("#status_sewa").val("");
            $('#status_sewa').select2().trigger('change');
            $("#status_sewa").attr("disabled",false);

            $("#jumlah").val("");
            $("#jumlah").attr("disabled",false);

            $("#nominal").val("");
            $("#nominal").attr("disabled",false);

            // datepicker set value
            $('#tgl_mulai').datepicker('setDate', "");
            $("#tgl_mulai").attr("disabled",false);
            $('#tgl_selesai').datepicker('setDate', "");
            $("#tgl_selesai").attr("disabled",false);
            $('#tgl_kontrak').datepicker('setDate', "");
            $("#tgl_kontrak").attr("disabled",false);
                        
            $("#no_kontrak").val("");
            $("#no_kontrak").attr("disabled",false);

            $("#btn1").show();
            $("#btn2").hide();

        })

         // hapus val ketika modal ditutup
        $('#modalHapus').on('hidden.bs.modal', function () {
          $("#id_hapus").val("");
        })


        //datatables
        table = $('#table').DataTable({ 

            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "oLanguage": {
                "sProcessing": '<p style="color: grey"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></p><span class="sr-only">Loading…</span>',
            },
            "ajax": {
                "url": "<?php echo base_url()?>sewa_properti/lunas/get_data_sp_lunas",
                "type": "POST"
            },

            
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
                "className" : "text-center"
            },
            { 
                "targets": [ 1 ], 
                "className" : "text-center"
            },
            { 
                "targets": [ 2 ], 
                "className" : "text-center"
            },
            { 
                "targets": [ 3 ], 
                "className" : "text-center"
            },
            { 
                "targets": [ 4 ], 
                "className" : "text-center"
            },
            { 
                "targets": [ 5 ], 
                "className" : "text-right"
            },
            { 
                "targets": [ 6 ], 
                "className" : "text-center"
            },
            { 
                "targets": [ 7 ], 
                "className" : "text-center"
            },
            { 
                "targets": [ 8 ], 
                "className" : "text-center"
            },
            { 
                "targets": [ 9 ], 
                "orderable": false,
                "className" : "text-center"
            },
            
            ],

            // fnDrawCallback: function() {
            //     $("[name='my-checkbox']").bootstrapToggle({
            //         'size' : 'mini'
            //     });
            // },

        });

    });

    function insertData()
    {   

            if($('#sewa_properti_id').val() != '') {
              var url = dns + 'sewa_properti/lunas/proses_edit';

              var data = {
                  sewa_properti_id : $("#sewa_properti_id").val(),
                  sewa_properti_kd : $("#sewa_properti_kd").val(),
                  status_pembayaran : $("#status_pembayaran").val(),
                  nama_penyewa : $("#nama_penyewa").val(),
                  sewa_kategori_id : $("#sewa_kategori_id").val(),
                  jumlah : $("#jumlah").val(),
                  nominal : $("#nominal").val(),
                  status_sewa : $("#status_sewa").val(),
                  tgl_mulai : $("#tgl_mulai").val(),
                  tgl_selesai : $("#tgl_selesai").val(),
                  no_kontrak : $("#no_kontrak").val(),
                  tgl_kontrak : $("#tgl_kontrak").val(),
              };

            } 
            else {
              var url = dns + 'sewa_properti/lunas/proses_add';

              var data = {
                  sewa_properti_kd : $("#sewa_properti_kd").val(),
                  status_pembayaran : $("#status_pembayaran").val(),
                  nama_penyewa : $("#nama_penyewa").val(),
                  sewa_kategori_id : $("#sewa_kategori_id").val(),
                  jumlah : $("#jumlah").val(),
                  nominal : $("#nominal").val(),
                  status_sewa : $("#status_sewa").val(),
                  tgl_mulai : $("#tgl_mulai").val(),
                  tgl_selesai : $("#tgl_selesai").val(),
                  no_kontrak : $("#no_kontrak").val(),
                  tgl_kontrak : $("#tgl_kontrak").val(),
              };
            }
           
            $.ajax({
                url: url,
                data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    console.log(result);

                    if(result.code==0)
                    {

                        alertify.set('notifier','position', 'top-right');
                        alertify.success('<a style="color:white"><i class="fa fa-check-circle"></i> '+result.message+'</a>');

                        $("#simpan").attr("disabled",true);

                        setTimeout(function() {
                            location.href = '<?php echo base_url();?>sewa_properti/lunas/';
                        }, 1000);

                    }
                    else
                    {
                        alertify.set('notifier','position', 'top-right');
                        alertify.warning('<a style="color:#333"><i class="fa fa-exclamation-circle"></i> '+result.message+'</a>');
                        
                    }

                }

            });
                    

    }
    


    function validasi(selector){

        $(selector).keyup(function(e){
            var key = (e.which) ? e.which : e.keyCode;
            if( key == 13 ){ filterLeads(e) }

            var v = $(selector).val();
            if(v < 0)
            {
                
                $(selector).val("0");
                // return false;
                    
            }
            // console.log(diskon);


        });

    }

</script>
     