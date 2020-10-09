<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MONITORING INVESTASI </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/fontawesome/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/datatables/dataTables.checkboxes.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/pace/pace.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/jquery-nestable/jquery.nestable.css">
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/alertify/css/alertify.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/bootstrap-select/css/bootstrap-select.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/tamacms/custom.css">
  <!-- jQuery 3 -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?= base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url();?>assets/bower_components/PACE/pace.min.js"></script>

  <!-- SlimScroll -->
  <script src="<?= base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?= base_url();?>assets/plugins/iCheck/icheck.min.js"></script>

  <!-- AdminLTE App -->
  <!-- DataTables -->
  <!-- <script src="<?= base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
  <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- <script src="<?= base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?= base_url();?>assets/bower_components/datatables/dataTables.checkboxes.js"></script> -->
  <script src="<?= base_url();?>assets/dist/js/adminlte.min.js"></script>
  <script src="<?= base_url();?>assets/plugins/jquery-nestable/jquery.nestable.js"></script>
  <script src="<?= base_url();?>assets/plugins/alertify/alertify.js"></script>
  <script src="<?= base_url();?>assets/plugins/bootstrap-show-password/bootstrap-show-password.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url();?>assets/bower_components/bootstrap-select/js/bootstrap-select.js"></script>
  <style type="text/css">
    .pagination>li>a, .pagination>li>span{
        padding:3px 10px !important;
      }
  </style>

  <style type="text/css">
          /*atur css di datatable*/
          .text-wrap{
              white-space:normal;
              overflow-wrap:break-word;
              overflow: hidden;
              font-size: 1em;
          }
          .width-200{
              width:200px;
          }
  </style>

  <!-- input mask -->
  <script src="<?= base_url();?>assets/dist/js/jquery.inputmask.min.js"></script>

  <!-- datepicker -->
  <link href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

  <!-- select2 -->
  <link href="<?php echo base_url();?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
  <script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>

  <style>
    /*ATUR STYLE SELECT2 AGAR SESUAI*/
    .select2-container .select2-selection--single
    {
        height: 36px!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered
    {
        line-height: 35px!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow
    {
        height: 36px!important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice 
    {
        background-color: rgba(0,0,0,0.41);
        color: whitesmoke;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove 
    {
        color: whitesmoke;
    }
    span.select2-selection.select2-selection--single {
        outline: none;
    }
  </style>

</head>
<!-- <body class="sidebar-mini hold-transition fixed skin-purple sidebar-collapse"> -->
  <body class="sidebar-mini hold-transition skin-purple sidebar-collapse">

<?php echo $_header;?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title; ?>
        <small><?= $subtitle;?></small>
      </h1>
      <?php $this->layout->breadcrumb($crumb) ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo $_content;?>
    </section>
            <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $_footer;?>


        
<!-- AdminLTE for demo purposes -->
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
  $(function () {
    $('#sidebar-form').on('submit', function (e) {
      e.preventDefault();
    });
    $('.sidebar-menu li.active').data('lte.pushmenu.active', true);
      $('#search-input').on('keyup', function () {
        var term = $('#search-input').val().trim();
        if (term.length === 0) {
          $('.sidebar-menu li').each(function () {
            $(this).show(0);
            $(this).removeClass('active');
            if ($(this).data('lte.pushmenu.active')) {
              $(this).addClass('active');
            }
          });
          return;
        }
      $('.sidebar-menu li').each(function () {
        if ($(this).text().toLowerCase().indexOf(term.toLowerCase()) === -1) {
          $(this).hide(0);
          $(this).removeClass('pushmenu-search-found', false);
          if ($(this).is('.treeview')) {
            $(this).removeClass('active');
          }
        } else {
          $(this).show(0);
          $(this).addClass('pushmenu-search-found');
          if ($(this).is('.treeview')) {
            $(this).addClass('active');
          }
          var parent = $(this).parents('li').first();
          if (parent.is('.treeview')) {
            parent.show(0);
          }
        }
        if ($(this).is('.header')) {
          $(this).show();
        }
      });

      $('.sidebar-menu li.pushmenu-search-found.treeview').each(function () {
        $(this).find('.pushmenu-search-found').show(0);
      });
    });
  });

  // To make Pace works on Ajax calls
  $(document).ajaxStart(function () {
    Pace.restart()
  });
  <?php 
    if(isset($this->session->message)){ ?>
   alertify.set('notifier','position', 'top-right');
 alertify.success('<a style="color:white"><?= $this->session->message;?></a>');
  
  <?php } ?>

  //var notification = alertify.notify('sample', 'success', 5, function(){  console.log('dismissed'); });
  

  
  
</script>







</body>
</html>