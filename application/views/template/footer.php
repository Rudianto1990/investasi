

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.1.1 <b></b>
    </div>
    <strong>Copyright &copy; 2019 <a href="http://priokport.co.id">Divisi Sistem Informasi - Kantor Cabang Priok</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<script type="text/javascript">
	
	$(function(){
		getAllNotif();
	});

	function getAllNotif()
	{
		$.ajax({
                    url   : '<?php echo base_url();?>notifikasi/getAllNotifikasi',
                    type  : 'POST',
                    dataType : 'json',
                    
                    success: function(result){

                      var data1 =  result[0];
                      var data2 = result[1];
                      var rows = "";
                      if(data2.code==0)
                      {
                                          
                        for (i = 0; i < data1.length; i++) {
                            rows += '<li><a href="'+data1[i].url+'">' + data1[i].kode +' '+ data1[i].teks + '</a></li>';
                              // console.log('sucess!');
                              
                        }
                        $("#notif").append(rows);
                        $(".countNotif").text(data1.length);
                        $(".countNotif").show();
                        
                        $(".withData").show();
                        
                        $(".noData").hide();
                        console.log(data1);
                      }
                      else
                      {
                          $(".countNotif").text("0");
                          $(".countNotif").hide();
                          //$(".notif").hide();


                          $(".withData").hide();
                          $(".noData").show();

                      }
                      // console.log(result);
  
                    
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                    }
                });
	}

</script>

