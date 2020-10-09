      <div class="row">

        <div class="col-md-12 col-xs-12">
          <div class="box box-default">

            <div class="box-body">
              <div class="form-inline">
                <div class="form-group">
                  <label for="filter">Filter By : </label>
                  <select class="form-control" id="filter" name="filter">
                    <option value="semua" <?php if($this->input->get("s") == null || $this->input->get("s") != "investasi" && $this->input->get("s") != "eksploitasi"){echo "selected";}?>>Semua</option>
                    <option value="investasi" <?php if($this->input->get("s") == "investasi"){echo "selected";}?>>Investasi</option>
                    <option value="eksploitasi" <?php if($this->input->get("s") == "eksploitasi"){echo "selected";}?>>Eksploitasi</option>
                  </select>
                </div>
                <!-- <button type="submit" class="btn btn-default">Filter</button> -->
              </div>
            </div>

          </div>
        </div>
      </div>



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
                      <th class="text-center" style="vertical-align: middle">No</th>
                      <th class="text-center" style="vertical-align: middle">Kode Adendum</th>
                      <th class="text-center" style="vertical-align: middle">Nama Bidang</th>
                      <th class="text-center" style="vertical-align: middle">Uraian Pekerjaan</th>
                      <th class="text-center" style="vertical-align: middle">Nama Vendor</th>
                      <th class="text-center" style="vertical-align: middle">Nilai Pekerjaan</th>
                      <th class="text-center" style="vertical-align: middle">Mulai Pelaksanaan</th>
                      <th class="text-center" style="vertical-align: middle">Indikator</th>
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


 
    <!-- Modal Edit / Detail -->
      
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i> <span id="text">Form Adendum</span></h4>
                   </div>
                   <div class="modal-body">

                    <input type="hidden" name="adendum_id" id="adendum_id">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">Kode Adendum</label>
                          <div class="col-md-7">
                              <input type="text" name="adendum_kd" id="adendum_kd" class="form-control" placeholder="Kode Vendor" readonly>
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Uraian Pekerjaan</label>
                            <div class="col-md-7">
                               <input type="text" name="uraian_pekerjaan" id="uraian_pekerjaan" class="form-control" placeholder="Uraian Pekerjaan" required>
                           </div>
                        </div>
                      </div>  

                    </div> 

                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label col-md-5">PR Number</label>
                          <div class="col-md-7">
                              <input type="number" name="adendum_pr_number" id="adendum_pr_number" class="form-control" placeholder="PR Number" onKeyPress="validasi('#adendum_pr_number');">
                          </div>
                       </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label col-md-5">PO Number</label>
                            <div class="col-md-7">
                               <input type="number" name="adendum_po_number" id="adendum_po_number" class="form-control" placeholder="PO Number" required onKeyPress="validasi('#adendum_po_number');">
                           </div>
                        </div>
                      </div>  

                      <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label col-md-5">Kontrak</label>
                            <div class="col-md-7">
                               <input type="text" name="adendum_no_kontrak" id="adendum_no_kontrak" class="form-control" placeholder="No Kontrak" required>
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
                              <input type="text" name="adendum_nilai_pekerjaan" id="adendum_nilai_pekerjaan" class="form-control">
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Mulai Pekerjaan</label>
                            <div class="col-md-7">
                              <div class="input-group">
                                  <input type="text" name="mulai_pelaksanaan" id="mulai_pelaksanaan" class="form-control" placeholder="Mulai Pekerjaan" required>
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
                                <input type="text" name="adendum_selesai_pekerjaan" id="adendum_selesai_pekerjaan" class="form-control" placeholder="Selesai Pekerjaan">
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
                                 <input type="text" name="adendum_tanggal_jaminan_pelaksanaan" id="adendum_tanggal_jaminan_pelaksanaan" class="form-control" placeholder="Jaminan Selesai" required>
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

    $( "#filter" ).change(function() {
        var filter = $("#filter").val();
        location.href= dns+ "adendum/index?s="+filter;
    });

    function preEditInvestasi(id)
    {      
            $.ajax({
                url: '<?php echo base_url();?>adendum/getDetailInvestasi/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    console.log(result);

                    if(result.code==200)
                    { 

                        $("#text").text("Edit Adendum");

                        $("#adendum_id").val(result.adendum_id);
                        $("#adendum_kd").val(result.adendum_kd);

                        // select 2 trigger untuk set value
                        $("#vendor_id").val(result.vendor_id);
                        $('#vendor_id').select2().trigger('change');
                        $("#vendor_id").attr("disabled",true);
                        $("#bidang_id").val(result.bidang_id);
                        $('#bidang_id').select2().trigger('change');
                        $("#bidang_id").attr("disabled",true);

                        $("#adendum_pr_number").val(result.adendum_pr_number);
                        $("#adendum_po_number").val(result.adendum_po_number);

                        $("#uraian_pekerjaan").val(result.uraian_pekerjaan);
                        $("#uraian_pekerjaan").attr("disabled",true);
                        
                        $("#adendum_no_kontrak").val(result.adendum_no_kontrak);

                        $("#adendum_nilai_pekerjaan").val(result.adendum_nilai_pekerjaan);

                        // datepicker set value
                        $('#mulai_pelaksanaan').datepicker('setDate', result.mulai_pelaksanaan);
                        $("#mulai_pelaksanaan").attr("disabled",true);

                        $('#adendum_selesai_pekerjaan').datepicker('setDate', result.adendum_selesai_pekerjaan);
                        $('#adendum_tanggal_jaminan_pelaksanaan').datepicker('setDate', result.adendum_tanggal_jaminan_pelaksanaan);

                    }
                   

                }

            });

          $("#btn1").show();
          $("#btn2").hide();
          $("#myModal").modal();
        
    }

    function preEditEksploitasi(id)
    {      
            $.ajax({
                url: '<?php echo base_url();?>adendum/getDetailEksploitasi/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    console.log(result);

                    if(result.code==200)
                    { 
                        $("#text").text("Edit Adendum");

                        $("#adendum_id").val(result.adendum_id);
                        $("#adendum_kd").val(result.adendum_kd);

                        // select 2 trigger untuk set value
                        $("#vendor_id").val(result.vendor_id);
                        $('#vendor_id').select2().trigger('change');
                        $("#vendor_id").attr("disabled",true);
                        $("#bidang_id").val(result.bidang_id);
                        $('#bidang_id').select2().trigger('change');
                        $("#bidang_id").attr("disabled",true);

                        $("#adendum_pr_number").val(result.adendum_pr_number);
                        $("#adendum_po_number").val(result.adendum_po_number);

                        $("#uraian_pekerjaan").val(result.uraian_pekerjaan);
                        $("#uraian_pekerjaan").attr("disabled",true);
                        
                        $("#adendum_no_kontrak").val(result.adendum_no_kontrak);

                        $("#adendum_nilai_pekerjaan").val(result.adendum_nilai_pekerjaan);

                        // datepicker set value
                        $('#mulai_pelaksanaan').datepicker('setDate', result.mulai_pelaksanaan);
                        $("#mulai_pelaksanaan").attr("disabled",true);

                        $('#adendum_selesai_pekerjaan').datepicker('setDate', result.adendum_selesai_pekerjaan);
                        $('#adendum_tanggal_jaminan_pelaksanaan').datepicker('setDate', result.adendum_tanggal_jaminan_pelaksanaan);

                    }
                   

                }

            });


          $("#btn1").show();
          $("#btn2").hide();
          $("#myModal").modal();
        
    }

    function preDetailInvestasi(id)
    {      
            $.ajax({
                url: '<?php echo base_url();?>adendum/getDetailInvestasi/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    console.log(result);

                    if(result.code==200)
                    { 
                        $("#text").text("Detail Adendum");

                        $("#adendum_id").val(result.adendum_id);
                        $("#adendum_kd").val(result.adendum_kd);

                        // select 2 trigger untuk set value
                        $("#vendor_id").val(result.vendor_id);
                        $('#vendor_id').select2().trigger('change');
                        $("#vendor_id").attr("disabled",true);
                        $("#bidang_id").val(result.bidang_id);
                        $('#bidang_id').select2().trigger('change');
                        $("#bidang_id").attr("disabled",true);

                        $("#adendum_pr_number").val(result.adendum_pr_number);
                        $("#adendum_pr_number").attr("disabled",true);
                        $("#adendum_po_number").val(result.adendum_po_number);
                        $("#adendum_po_number").attr("disabled",true);

                        $("#uraian_pekerjaan").val(result.uraian_pekerjaan);
                        $("#uraian_pekerjaan").attr("disabled",true);
                        
                        $("#adendum_no_kontrak").val(result.adendum_no_kontrak);
                        $("#adendum_no_kontrak").attr("disabled",true);

                        $("#adendum_nilai_pekerjaan").val(result.adendum_nilai_pekerjaan);
                        $("#adendum_nilai_pekerjaan").attr("disabled",true);

                        // datepicker set value
                        $('#mulai_pelaksanaan').datepicker('setDate', result.mulai_pelaksanaan);
                        $("#mulai_pelaksanaan").attr("disabled",true);

                        $('#adendum_selesai_pekerjaan').datepicker('setDate', result.adendum_selesai_pekerjaan);
                        $("#adendum_selesai_pekerjaan").attr("disabled",true);

                        $('#adendum_tanggal_jaminan_pelaksanaan').datepicker('setDate', result.adendum_tanggal_jaminan_pelaksanaan);
                        $("#adendum_tanggal_jaminan_pelaksanaan").attr("disabled",true);

                    }
                   

                }

            });

          $("#btn1").hide();
          $("#btn2").show();
          $("#myModal").modal();
        
    }

    function preDetailEksploitasi(id)
    {      
            $.ajax({
                url: '<?php echo base_url();?>adendum/getDetailEksploitasi/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    console.log(result);

                    if(result.code==200)
                    { 
                        $("#text").text("Detail Adendum");

                        $("#adendum_id").val(result.adendum_id);
                        $("#adendum_kd").val(result.adendum_kd);

                        // select 2 trigger untuk set value
                        $("#vendor_id").val(result.vendor_id);
                        $('#vendor_id').select2().trigger('change');
                        $("#vendor_id").attr("disabled",true);
                        $("#bidang_id").val(result.bidang_id);
                        $('#bidang_id').select2().trigger('change');
                        $("#bidang_id").attr("disabled",true);

                        $("#adendum_pr_number").val(result.adendum_pr_number);
                        $("#adendum_pr_number").attr("disabled",true);
                        $("#adendum_po_number").val(result.adendum_po_number);
                        $("#adendum_po_number").attr("disabled",true);

                        $("#uraian_pekerjaan").val(result.uraian_pekerjaan);
                        $("#uraian_pekerjaan").attr("disabled",true);
                        
                        $("#adendum_no_kontrak").val(result.adendum_no_kontrak);
                        $("#adendum_no_kontrak").attr("disabled",true);

                        $("#adendum_nilai_pekerjaan").val(result.adendum_nilai_pekerjaan);
                        $("#adendum_nilai_pekerjaan").attr("disabled",true);

                        // datepicker set value
                        $('#mulai_pelaksanaan').datepicker('setDate', result.mulai_pelaksanaan);
                        $("#mulai_pelaksanaan").attr("disabled",true);

                        $('#adendum_selesai_pekerjaan').datepicker('setDate', result.adendum_selesai_pekerjaan);
                        $("#adendum_selesai_pekerjaan").attr("disabled",true);

                        $('#adendum_tanggal_jaminan_pelaksanaan').datepicker('setDate', result.adendum_tanggal_jaminan_pelaksanaan);
                        $("#adendum_tanggal_jaminan_pelaksanaan").attr("disabled",true);

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
            url : dns + 'adendum/delete/'+idhps,
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
        $('#mulai_pelaksanaan, #adendum_selesai_pekerjaan, #adendum_tanggal_jaminan_pelaksanaan').datepicker({
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
        $("#adendum_pr_number, #adendum_po_number").attr({
            "min" : 0
        });

        // mask nomor kontrak
        $("#adendum_no_kontrak").inputmask("aa999.9.9.9.99999");  //static mask
        // $("#adendum_no_kontrak").inputmask("99-9999999");  //static mask
        // $(selector).inputmask({"mask": "(999) 999-9999"}); //specifying options
        // $(selector).inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax
        $("#adendum_nilai_pekerjaan").inputmask("currency", {'autoUnmask' : true});

        // hapus val ketika modal ditutup
        $('#myModal').on('hidden.bs.modal', function () {

            $("#adendum_id").val("");

            // select2 trigger untuk set value
            $("#vendor_id").val("");
            $('#vendor_id').select2().trigger('change');
            $("#vendor_id").attr("disabled",false);
            $("#bidang_id").val("");
            $('#bidang_id').select2().trigger('change');
            $("#bidang_id").attr("disabled",false);

            $("#adendum_pr_number").val("");
            $("#adendum_pr_number").attr("disabled",false);
            $("#adendum_po_number").val("");
            $("#adendum_po_number").attr("disabled",false);

            $("#uraian_pekerjaan").val("");
            $("#uraian_pekerjaan").attr("disabled",false);

            $("#adendum_no_kontrak").val("");
            $("#adendum_no_kontrak").attr("disabled",false);

            $("#adendum_nilai_pekerjaan").val("");
            $("#adendum_nilai_pekerjaan").attr("disabled",false);

            // datepicker set value
            $('#mulai_pelaksanaan').datepicker('setDate', "");
            $("#mulai_pelaksanaan").attr("disabled",false);

            $('#adendum_selesai_pekerjaan').datepicker('setDate', "");
            $("#adendum_selesai_pekerjaan").attr("disabled",false);

            $('#adendum_tanggal_jaminan_pelaksanaan').datepicker('setDate', "");
            $("#adendum_tanggal_jaminan_pelaksanaan").attr("disabled",false);

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
                "url": "<?php echo base_url()?>adendum/get_data_adendum/<?php echo $filter;?>",
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
                "orderable": false, 
                "className" : "text-center"
            },
            { 
                "targets": [ 3 ], 
                "orderable": false, 
                "className" : "text-center"
            },
            { 
                "targets": [ 4 ], 
                "orderable": false, 
                "className" : "text-center"
            },
            { 
                "targets": [ 5 ], 
                "className" : "text-right"
            },
            { 
                "targets": [ 6 ], 
                "orderable": false, 
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
            
            var url = dns + 'adendum/proses_edit';

            var data = {
                  adendum_id : $("#adendum_id").val(),
                  // adendum_kd : $("#adendum_kd").val(),
                  // vendor_id : $("#vendor_id").val(),
                  // bidang_id : $("#bidang_id").val(),
                  adendum_pr_number : $("#adendum_pr_number").val(),
                  adendum_po_number : $("#adendum_po_number").val(),
                  // uraian_pekerjaan : $("#uraian_pekerjaan").val(),
                  adendum_no_kontrak : $("#adendum_no_kontrak").val(),
                  adendum_nilai_pekerjaan : $("#adendum_nilai_pekerjaan").val(),
                  // mulai_pelaksanaan : $("#mulai_pelaksanaan").val(),
                  adendum_selesai_pekerjaan : $("#adendum_selesai_pekerjaan").val(),
                  adendum_tanggal_jaminan_pelaksanaan : $("#adendum_tanggal_jaminan_pelaksanaan").val(),
            };

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
                            location.href = '<?php echo base_url();?>adendum';
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
     