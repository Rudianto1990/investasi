  
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <!-- <h3 class="box-title"></h3> -->
               <button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
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
                      <th class="text-center" style="vertical-align: middle">PO NUMBER</th>
                      <th class="text-center" style="vertical-align: middle">NAMA BIDANG</th>
                      <th class="text-center" style="vertical-align: middle">URAIAN PEKERJAAN</th>
                      <th class="text-center" style="vertical-align: middle">NAMA VENDOR</th>
                      <th class="text-center" style="vertical-align: middle">NILAI PEKERJAAN</th>
                      <th class="text-center" style="vertical-align: middle">MULAI PEKERJAAN</th>
                      <th class="text-center" style="vertical-align: middle">INDIKATOR</th>
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
                       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-briefcase"></i> <span id="text">Form Investasi</span></h4>
                   </div>
                   <div class="modal-body">

                    <input type="hidden" name="investasi_id" id="investasi_id">
                    <input type="hidden" name="aksi" id="aksi">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">Kode Investasi</label>
                          <div class="col-md-7">
                              <input type="text" name="investasi_kd" id="investasi_kd" class="form-control" placeholder="Kode Vendor" readonly value="<?php echo $code;?>">
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Uraian Pekerjaan</label>
                            <div class="col-md-7">
                               <input type="text" name="investasi_uraian_pekerjaan" id="investasi_uraian_pekerjaan" class="form-control" placeholder="Uraian Pekerjaan" required>
                           </div>
                        </div>
                      </div>  

                    </div> 

                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">PR Number</label>
                          <div class="col-md-7">
                              <input type="number" name="investasi_pr_number" id="investasi_pr_number" class="form-control" placeholder="PR Number" onKeyPress="validasi('#investasi_pr_number');">
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">PO Number</label>
                            <div class="col-md-7">
                               <input type="number" name="investasi_po_number" id="investasi_po_number" class="form-control" placeholder="PO Number" required onKeyPress="validasi('#investasi_po_number');">
                           </div>
                        </div>
                      </div>

                      
                      <div class="col-md-6"><br />
                          <div class="form-group">
                            <label class="control-label col-md-5">Status KOntrak</label>
                            <div class="col-md-7">
                               <select class="form-control select2-sp" id="#" name="" style="width: 100%;">
                                 <option value="#">ON Progress</option>
                                 <option value="#">Done</option>
                               </select>
                           </div>
                        </div>
                      </div> 

                 
                      <div class="col-md-6"><br />
                          <div class="form-group">
                            <label class="control-label col-md-5">Kontrak</label>
                            <div class="col-md-7">
                               <input type="text" name="investasi_no_kontrak" id="investasi_no_kontrak" class="form-control" placeholder="TR.00/00/8/1/G5/HN/W.TPK-11" required>
                           </div>
                        </div>
                      </div>
                    </div>     

                    
                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">Nama Bidang</label>
                          <div class="col-md-7">
                              <select class="form-control select2-bidang" name="bidang_id" id="bidang_id" style="width: 100%;">
                                <option></option>
                                <?php foreach($bidang AS $v_b):?>
                                <option value="<?php echo $v_b->bidang_id;?>"><?php echo $v_b->bidang_nama;?></option>
                                <?php endforeach;?>
                              </select>
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Nama Vendor</label>
                            <div class="col-md-7">
                               <select class="form-control select2-vendor" name="vendor_id" id="vendor_id" style="width: 100%;">
                                <option></option>
                                <?php foreach($vendor AS $v_v):?>
                                <option value="<?php echo $v_v->vendor_id;?>"><?php echo $v_v->vendor_nama;?></option>
                                <?php endforeach;?>
                              </select>
                           </div>
                        </div>
                      </div>  

                    </div> 

                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">Nilai</label>
                          <div class="col-md-7">
                              <input type="text" name="investasi_nilai_pekerjaan" id="investasi_nilai_pekerjaan" class="form-control">
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Mulai Pekerjaan</label>
                            <div class="col-md-7">
                              <div class="input-group">
                                  <input type="text" name="investasi_mulai_pelaksanaan" id="investasi_mulai_pelaksanaan" class="form-control" placeholder="Mulai Pekerjaan" required>
                                  <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                           </div>
                        </div>
                      </div>  

                    </div>  

                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">Selesai Pekerjaan</label>
                          <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" name="investasi_selesai_pekerjaan" id="investasi_selesai_pekerjaan" class="form-control" placeholder="Selesai Pekerjaan">
                                <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Jaminan Selesai</label>
                            <div class="col-md-7">
                              <div class="input-group">
                                 <input type="text" name="investasi_tanggal_jaminan_pelaksanaan" id="investasi_tanggal_jaminan_pelaksanaan" class="form-control" placeholder="Jaminan Selesai" required>
                                <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fas fa-calendar-alt"></i></span>
                              </div>
                           </div>
                        </div>
                      </div>  

                    </div> 
                        
 
                   </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button id="simpan" class="btn btn-success" onclick="insertData();">Save</button>
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
                url: '<?php echo base_url();?>investasi/getDetail/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    // console.log(result);

                    if(result.code==200)
                    { 
                        $("#text").text("Edit Investasi");

                        $("#aksi").val("edit");

                        $("#investasi_id").val(result.investasi_id);
                        $("#investasi_kd").val(result.investasi_kd);

                        // select 2 trigger untuk set value
                        $("#vendor_id").val(result.vendor_id);
                        $('#vendor_id').select2().trigger('change');
                        $("#bidang_id").val(result.bidang_id);
                        $('#bidang_id').select2().trigger('change');

                        $("#investasi_pr_number").val(result.investasi_pr_number);
                        $("#investasi_po_number").val(result.investasi_po_number);
                        $("#investasi_uraian_pekerjaan").val(result.investasi_uraian_pekerjaan);
                        
                        $("#investasi_no_kontrak").val(result.investasi_no_kontrak);
                        //$("#investasi_no_kontrak").attr("disabled",true);

                        $("#investasi_nilai_pekerjaan").val(result.investasi_nilai_pekerjaan);

                        // datepicker set value
                        $('#investasi_mulai_pelaksanaan').datepicker('setDate', result.investasi_mulai_pelaksanaan);
                        $('#investasi_selesai_pekerjaan').datepicker('setDate', result.investasi_selesai_pekerjaan);
                        $('#investasi_tanggal_jaminan_pelaksanaan').datepicker('setDate', result.investasi_tanggal_jaminan_pelaksanaan);

                    }
                   

                }

            });


          $("#myModal").modal();
        
    }

     // modal adendum
    function preAdendum(id)
    {      
            $.ajax({
                url: '<?php echo base_url();?>investasi/getDetail/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    // console.log(result);

                    if(result.code==200)
                    { 
                        $("#text").text("Adendum Investasi");

                        $("#aksi").val("adendum");

                        $("#investasi_id").val(result.investasi_id);
                        $("#investasi_kd").val(result.investasi_kd);

                        // select 2 trigger untuk set value
                        $("#vendor_id").val(result.vendor_id);
                        $('#vendor_id').select2().trigger('change');
                        $("#vendor_id").attr("disabled",true);
                        $("#bidang_id").val(result.bidang_id);
                        $('#bidang_id').select2().trigger('change');
                        $("#bidang_id").attr("disabled",true);

                        $("#investasi_pr_number").val(result.investasi_pr_number);
                        $("#investasi_po_number").val(result.investasi_po_number);

                        $("#investasi_uraian_pekerjaan").val(result.investasi_uraian_pekerjaan);
                        $("#investasi_uraian_pekerjaan").attr("disabled",true);
                        
                        $("#investasi_no_kontrak").val(result.investasi_no_kontrak);

                        $("#investasi_nilai_pekerjaan").val(result.investasi_nilai_pekerjaan);

                        // datepicker set value
                        $('#investasi_mulai_pelaksanaan').datepicker('setDate', result.investasi_mulai_pelaksanaan);
                        $("#investasi_mulai_pelaksanaan").attr("disabled",true);

                        $('#investasi_selesai_pekerjaan').datepicker('setDate', result.investasi_selesai_pekerjaan);
                        $('#investasi_tanggal_jaminan_pelaksanaan').datepicker('setDate', result.investasi_tanggal_jaminan_pelaksanaan);

                    }
                   

                }

            });


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
            url : dns + 'investasi/delete/'+idhps,
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

        // date picker
        $('#investasi_mulai_pelaksanaan, #investasi_selesai_pekerjaan, #investasi_tanggal_jaminan_pelaksanaan').datepicker({
            todayBtn: "linked",
            format: 'dd-mm-yyyy',
            // default: true,
            autoclose: true
        });

        // select2
        $('.select2-bidang').select2({
            // minimumResultsForSearch: Infinity,
            // allowClear: true,
            width: '100%',
            placeholder: "Pilih Bidang...",
            // tags: true
        });

        $('.select2-vendor').select2({
            // minimumResultsForSearch: Infinity,
            // allowClear: true,
            width: '100%',
            placeholder: "Pilih Vendor...",
            // tags: true
        });

        // min number
        $("#investasi_pr_number, #investasi_po_number").attr({
            "min" : 0
        });

        // mask nomor kontrak
        $("#investasi_no_kontrak").inputmask("aa.99/99/9/9/a9/aa/a.aaa-99");  //static mask
        // $("#investasi_no_kontrak").inputmask("99-9999999");  //static mask
        // $(selector).inputmask({"mask": "(999) 999-9999"}); //specifying options
        // $(selector).inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax
        $("#investasi_nilai_pekerjaan").inputmask("currency", {'autoUnmask' : true});

        // hapus val ketika modal ditutup
        $('#myModal').on('hidden.bs.modal', function () {

            $("#text").text("Form Investasi");

            $("#aksi").val("");
            $("#investasi_id").val("");

            // select2 trigger untuk set value
            $("#vendor_id").val("");
            $('#vendor_id').select2().trigger('change');
            $("#vendor_id").attr("disabled",false);
            $("#bidang_id").val("");
            $('#bidang_id').select2().trigger('change');
            $("#bidang_id").attr("disabled",false);

            $("#investasi_pr_number").val("");
            $("#investasi_po_number").val("");

            $("#investasi_uraian_pekerjaan").val("");
            $("#investasi_uraian_pekerjaan").attr("disabled",false);

            $("#investasi_no_kontrak").val("");
            $("#investasi_no_kontrak").attr("disabled",false);

            $("#investasi_nilai_pekerjaan").val("");

            // datepicker set value
            $('#investasi_mulai_pelaksanaan').datepicker('setDate', "");
            $("#investasi_mulai_pelaksanaan").attr("disabled",false);

            $('#investasi_selesai_pekerjaan').datepicker('setDate', "");
            $('#investasi_tanggal_jaminan_pelaksanaan').datepicker('setDate', "");

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
                "url": "<?php echo base_url()?>investasi/get_data_investasi",
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
                "orderable": false,
                "className" : "text-center"
            },
            { 
                "targets": [ 8 ], 
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

            if($('#investasi_id').val() != '' && $('#aksi').val() == 'edit') {
              var url = dns + 'investasi/proses_edit';

              var data = {
                  investasi_id : $("#investasi_id").val(),
                  investasi_kd : $("#investasi_kd").val(),
                  vendor_id : $("#vendor_id").val(),
                  bidang_id : $("#bidang_id").val(),
                  investasi_pr_number : $("#investasi_pr_number").val(),
                  investasi_po_number : $("#investasi_po_number").val(),
                  investasi_uraian_pekerjaan : $("#investasi_uraian_pekerjaan").val(),
                   investasi_no_kontrak : $("#investasi_no_kontrak").val(),
                  investasi_nilai_pekerjaan : $("#investasi_nilai_pekerjaan").val(),
                  investasi_mulai_pelaksanaan : $("#investasi_mulai_pelaksanaan").val(),
                  investasi_selesai_pekerjaan : $("#investasi_selesai_pekerjaan").val(),
                  investasi_tanggal_jaminan_pelaksanaan : $("#investasi_tanggal_jaminan_pelaksanaan").val(),
              };

            } 
            else if($('#investasi_id').val() != '' && $('#aksi').val() == 'adendum') {
              var url = dns + 'investasi/proses_adendum';

              var data = {
                  investasi_id : $("#investasi_id").val(),
                  investasi_kd : $("#investasi_kd").val(),
                  // vendor_id : $("#vendor_id").val(),
                  // bidang_id : $("#bidang_id").val(),
                  investasi_pr_number : $("#investasi_pr_number").val(),
                  investasi_po_number : $("#investasi_po_number").val(),
                  // investasi_uraian_pekerjaan : $("#investasi_uraian_pekerjaan").val(),
                  investasi_no_kontrak : $("#investasi_no_kontrak").val(),
                  investasi_nilai_pekerjaan : $("#investasi_nilai_pekerjaan").val(),
                  // investasi_mulai_pelaksanaan : $("#investasi_mulai_pelaksanaan").val(),
                  investasi_selesai_pekerjaan : $("#investasi_selesai_pekerjaan").val(),
                  investasi_tanggal_jaminan_pelaksanaan : $("#investasi_tanggal_jaminan_pelaksanaan").val(),
              };

            }
            else {
              var url = dns + 'investasi/proses_add';

              var data = {
                  investasi_kd : $("#investasi_kd").val(),
                  vendor_id : $("#vendor_id").val(),
                  bidang_id : $("#bidang_id").val(),
                  investasi_pr_number : $("#investasi_pr_number").val(),
                  investasi_po_number : $("#investasi_po_number").val(),
                  investasi_uraian_pekerjaan : $("#investasi_uraian_pekerjaan").val(),
                  investasi_no_kontrak : $("#investasi_no_kontrak").val(),
                  investasi_nilai_pekerjaan : $("#investasi_nilai_pekerjaan").val(),
                  investasi_mulai_pelaksanaan : $("#investasi_mulai_pelaksanaan").val(),
                  investasi_selesai_pekerjaan : $("#investasi_selesai_pekerjaan").val(),
                  investasi_tanggal_jaminan_pelaksanaan : $("#investasi_tanggal_jaminan_pelaksanaan").val(),
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
                            location.href = '<?php echo base_url();?>investasi';
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
     