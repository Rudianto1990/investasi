<!-- Default box -->
<?php
$user = $this->ion_auth->user()->row();
?>
<?php if($user->role == 1 || $user->role == 2):?>
<div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">INVESTASI</span>
              <span class="info-box-number"><?php echo $countInvestasi;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total Investasi
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-suitcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">EKSPLOITASI</span>
              <span class="info-box-number"><?php echo $countEksploitasi;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total Eksploitasi
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ADENDUM</span>
              <span class="info-box-number"><?php echo $countAdendum;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Transaksi Adendum
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        
        <div class="col-md-12 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">GRAFIK MONITORING INVESTASI</h3> -->
              <h3 class="box-title">GRAFIK MONITORING</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body" style="min-height: 150px">
              <div class="chart">
                <canvas id="barChart" style="height:270px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div>




        <!-- <div class="col-md-4 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Last Login</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body" style="height:295px">
              <table class="table table-bordered table-striped">
                <thead>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Waktu</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Superadmin</td>
                    <td>12/11/2018</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Admin</td>
                    <td>12/11/2018</td>
                  </tr>
                  <tr>
                  
                </tbody>
              </table>
            </div>
           
            <div class="box-footer">
            </div>
           
          </div>
          
        </div> -->
      </div>  
      <?php endif;?>

      <p>Under Project </p>





<script src="<?php echo base_url();?>assets/bower_components/chart.js/Chart-2-8.min.js"></script>
<script>


    var chartData = {
      labels: ['1 BULAN', 'DIBAWAH 1 BULAN', '2 MINGGU', 'MELEWATI'],
       datasets: [
        {
            label: "Investasi",
            backgroundColor:"#337ab7",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [<?php echo $investasiSeminggu;?>, <?php echo $investasiDuaMinggu;?>, <?php echo $investasiSebulan;?>, <?php echo $investasiMelewati;?>]
        },
        {
            label: "Eksploitasi",
            backgroundColor:"#dd4b39",
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [<?php echo $eksploitasiSeminggu;?>, <?php echo $eksploitasiDuaMinggu;?>, <?php echo $eksploitasiSebulan;?>, <?php echo $eksploitasiMelewati;?>]
        },
        {
            label: "Adendum",
            backgroundColor:"#f39c12",
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [<?php echo $adendumSeminggu;?>, <?php echo $adendumDuaMinggu;?>, <?php echo $adendumSebulan;?>, <?php echo $adendumMelewati;?>]
        }
      ]

    };
    
   
      var ctx = document.getElementById('barChart').getContext('2d');
      myMixedChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
          responsive: true,
          title: {
            display: true,
            text: 'Grafik Monitoring Investasi & Eksploitasi'
          },
          tooltips: {
            mode: 'index',
            intersect: true
          }
        }
      });
      // console.log(myMixedChart);
   

    
  </script>
     