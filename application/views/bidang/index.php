  
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
                      <th class="text-center" style="vertical-align: middle;">#</th>
                      <th class="text-center" style="vertical-align: middle;">Kode Bidang</th>
                      <th class="text-center" style="vertical-align: middle;">Nama Bidang</th>
                      <th class="text-center" style="vertical-align: middle;">Aksi</th>
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
                       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-folder"></i> Master Bidang</h4>
                   </div>
                   <div class="modal-body">

                    <input type="hidden" name="bidang_id" id="bidang_id">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-5">Kode Bidang</label>
                          <div class="col-md-7">
                              <input type="text" name="bidang_kd" id="bidang_kd" class="form-control" placeholder="Kode Bidang" readonly value="<?php echo $code;?>">
                          </div>
                       </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label col-md-5">Nama Bidang</label>
                            <div class="col-md-7">
                               <input type="text" name="bidang_nama" id="bidang_nama" class="form-control" placeholder="Nama Bidang" required>
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
                url: '<?php echo base_url();?>master/bidang/getDetail/'+id,
                // data: data,
                method: 'POST',
                dataType: 'json',
                // crossDomain: true,
                // contentType: 'application/json; charset=utf-8',
                success: function(result) {
                    console.log(result);

                    if(result.code==200)
                    { 
                        $("#bidang_id").val(result.bidang_id);
                        $("#bidang_kd").val(result.bidang_kd);
                        $("#bidang_nama").val(result.bidang_nama);

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
            url : dns + 'master/bidang/delete/'+idhps,
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

        // hapus val ketika modal ditutup
        $('#myModal').on('hidden.bs.modal', function () {
          $("#bidang_id").val("");
          $("#bidang_nama").val("");
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
                "url": "<?php echo base_url()?>master/bidang/get_data_bidang",
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
            // { 
            //     "targets": [ 3 ], 
            //     "className" : "text-left",
            //     render: function (data, type, full, meta) {
            //             return "<div class='text-wrap width-200'>" + data + "</div>";
            //         }
            // },
            { 
                "targets": [ 3 ], 
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

            if($('#bidang_id').val() != '') {
              var url = dns + 'master/bidang/proses_edit';

              var data = {
                  bidang_id : $("#bidang_id").val(),
                  bidang_kd : $("#bidang_kd").val(),
                  bidang_nama : $("#bidang_nama").val(),
              };

            } else {
              var url = dns + 'master/bidang/proses_add';

              var data = {
                  bidang_kd : $("#bidang_kd").val(),
                  bidang_nama : $("#bidang_nama").val(),
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
                            location.href = '<?php echo base_url();?>master/bidang';
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
    


    



    
</script>
     