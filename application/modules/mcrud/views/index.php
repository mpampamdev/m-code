<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>M-CRUD</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/ti-icons/css/themify-icons.css">
    <link href="<?=base_url()?>_temp/backend/css/icons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/css/vendor.bundle.base.css">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/jquery-toast-plugin/jquery.toast.min.css">
    <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?=base_url()?>_temp/backend/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>_temp/backend/css/custom.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?=base_url()?>_temp/backend/images/favicon.png" />

    <!-- plugins:js -->
    <script src="<?=base_url()?>_temp/backend/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="<?=base_url()?>_temp/backend/vendors/sweetalert/sweetalert.min.js"></script>
    <script src="<?=base_url()?>_temp/backend/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
    <script src="<?=base_url()?>_temp/backend/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="<?=base_url()?>_temp/backend/vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->

    <style media="screen">
      /* .select2-container{
        width: 100%!important;
      } */

      select{
        color:#2f2f2f!important;
      }

      #content ul.success{
        list-style: none;
      }

      #content ul.success li{
        padding: 10px;
        font-weight: 600;
        color:rgb(49, 156, 42);
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial -->
      <div class="main-panel" style="width:100%!important;min-height:650px!important">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-9 mx-auto">
              <div class="card">
                <div class="card-body">
                  <h5>M-CRUD</h5>
                  <div class="row">
                    <div class="col-sm-12 mb-3 pb-3" style="border-bottom:1px solid #d0d0d0">
                        <div class="card-description">
                          <p> M-CRUD adalah sebuah tools crud generator untuk mempermudah pembuatan module pada panel M-Code web/app yang telah di sediakan.</p>
                          <ul>
                            <li>Codeigniter <?=CI_VERSION?></li>
                            <li>dev : mpampam</li>
                            <li>fb : <a href="https://facebook.com/mpampam" target="_blank">@mpampam</a></li>
                            <li>fanspage : <a href="https://web.facebook.com/programmerjalanan" target="_blank">@programmerjalanan</a></li>
                          </ul>
                          <p>Untuk membantu kami mengembangkan tools ini bisa dengan cara donasi <i class="mdi mdi-coffee"></i> :)</p>
                          <ul>
                            <li>BNI 0330538612 / Muh.irfan ibnu</li>
                          </ul>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &amp; made with <i class="ti-heart text-danger ml-1"></i></span>
                      </div>
                    </div>



                    <div class="col-sm-6">
                      <div class="form-group">
                        <select class="form-control" name="db-table" id="db-table">
                          <option value="">-- pilih table --</option>
                          <?php foreach ($table_name as $tb_name): ?>
                            <option value="<?=$tb_name?>"><?=$tb_name?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <button type="submit" class="btn btn-sm btn-primary" id="submit-select-table" name="submit-select-table">Generate</button>
                      <div class="alert-module mt-3"></div>

                    </div>
                  </div>


                </div>
              </div>

              <div id="content"></div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- js -->
    <script src="<?=base_url()?>_temp/backend/js/off-canvas.js"></script>
    <script src="<?=base_url()?>_temp/backend/js/hoverable-collapse.js"></script>
    <script src="<?=base_url()?>_temp/backend/js/template.js"></script>
    <script src="<?=base_url()?>_temp/backend/js/settings.js"></script>
    <script src="<?=base_url()?>_temp/backend/js/todolist.js"></script>

    <script type="text/javascript">
      $(document).on("click","#submit-select-table",function(e){
        e.preventDefault();
        var value = $("#db-table option:selected").val();
        $("#db-table").closest(".form-group").find(".text-danger").remove();
          $.ajax({
                  url             : "<?=base_url()?>mcrud/get",
                  type            : 'POST',
                  data            : "values="+value,
                  dataType        : 'JSON',
                  success:function(json){
                    if (json.success==true) {
                      $(".alert-module").hide().fadeOut(300);
                      $("#content").hide().fadeIn(300).html(json.content);
                    }else {
                      $("#db-table").after('<span style="font-size:12px" class="m-t-2 text-danger">*'+json.alert+'</span>');
                    }
                  }
                });

      });
</script>
  </body>
</html>
