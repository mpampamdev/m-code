<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=ucwords($title_module)?></title>
  <link rel="shortcut icon" href="<?=base_url()?>_temp/uploads/img/<?=setting("favicon")?>" />
  <!--Animate CSS -->
  <link href="<?=base_url()?>_temp/backend/vendors/animate/animate.min.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url()?>_temp/backend/css/custom.css" rel="stylesheet" type="text/css">
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/ti-icons/css/themify-icons.css">
  <link href="<?=base_url()?>_temp/backend/css/icons.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/css/style.css">
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <link href="<?=base_url()?>_temp/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/fancybox/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/summernote/dist/summernote-bs4.css">
  <!-- End plugin css for this page -->

  <!-- plugins:js -->
  <script src="<?=base_url()?>_temp/backend/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/sweetalert/sweetalert.min.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/fancybox/jquery.fancybox.min.js"></script>
    <script src="<?=base_url()?>_temp/backend/vendors/summernote/dist/summernote-bs4.min.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/clipboard/clipboard.min.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/custom.js"></script>
  <!-- end plugins js -->
  <script>
    var BASE_URL = "<?=base_url()?>";

    $(document).ready(function(){
      var t_message = '<?=$this->session->flashdata('t_message');?>';
      var t_type    = '<?=$this->session->flashdata('t_type');?>';

        if (t_message.length > 0) {
          // showToast(t_type, t_message);
          swal(t_message, {
            icon:t_type
          })
        }
    });
  </script>

</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?=url("dashboard")?>"><img src="<?=base_url()?>_temp/uploads/img/<?=setting("logo")?>" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?=url("dashboard")?>"><img src="<?=base_url()?>_temp/uploads/img/<?=setting("logo_mini")?>" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-layout-grid2"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <?php if (profile('photo') == ""): ?>
                  <img src="<?=base_url()?>_temp/backend/logo-user.png" alt="profile"/>
                <?php else: ?>
                  <img src="<?=base_url()?>_temp/uploads/img/<?=profile('photo')?>" alt="profile"/>
              <?php endif; ?>

            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" id="reset-pwd" href="<?=url("core/reset_password")?>">
                <i class="mdi mdi-key-change text-primary"></i>
                Change Password
              </a>
              <a class="dropdown-item" href="<?=site_url("logout")?>">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-layout-grid2"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <?=$main_menu?>

      <div class="main-panel">
        <div class="content-wrapper">
