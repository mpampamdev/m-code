<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/justdo/template/demo/vertical-default-light/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Jul 2019 23:08:25 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/css/style.css">
  <link rel="shortcut icon" href="<?=base_url()?>_temp/uploads/img/<?=setting("favicon")?>" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background:#142935!important">
        <div class="img-bg">
          <img src="<?=base_url()?>_temp/backend/security.gif" alt="logo" style="width:400px;position:fixed;bottom:0;right:0;">
        </div>
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="border-radius:5px;">
              <div class="brand-logo text-center">
                <img src="<?=base_url()?>_temp/uploads/img/<?=setting("logo")?>" alt="logo">
              </div>
              <div class="text-center">
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Please login to manage the system</h6>
              </div>
              <form class="pt-3" action="<?=site_url(LOGIN_ROUTE."/action")?>" id="form">
                <input type="hidden" name="token" class="form-control" value="<?=$this->session->token?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="email" placeholder="email" name="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" placeholder="password" name="password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" id="submit">LOGIN</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script src="<?=base_url()?>_temp/backend/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/off-canvas.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/template.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/settings.js"></script>
  <script src="<?=base_url()?>_temp/backend/js/todolist.js"></script>
  <script src="<?=base_url()?>_temp/backend/vendors/sweetalert/sweetalert.min.js"></script>


  <script type="text/javascript">
        $("#form").submit(function(e){
        e.preventDefault();
        var me = $(this);
        $("#submit").prop('disabled',true).html('Loading...');
        $(".form-group").find('.text-danger').remove();
        $.ajax({
              url             : me.attr('action'),
              type            : 'post',
              data            :  new FormData(this),
              contentType     : false,
              cache           : false,
              dataType        : 'JSON',
              processData     :false,
              success:function(json){
                if (json.success==true) {
                  if (json.valid==true) {
                    window.location.href = json.url;
                  }else {
                    $("#submit").prop('disabled',false)
                                .html('LOGIN');
                    $("input[type=password]").val("");
                    swal({
                      icon:'error',
                      title: 'Info',
                      text: 'Username Atau Password Salah.',
                      button: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                      }
                    });
                    $('input[name="token"]').val(json.token);
                  }
                }else {
                  $("#submit").prop('disabled',false)
                              .html('Log In');
                  $.each(json.alert, function(key, value) {
                    var element = $('#' + key);
                    $(element)
                    .closest('.form-group')
                    .find('.text-danger').remove();
                    $(element).after(value);
                  });
                }
              }
            });
        });
        </script>
</body>
</html>
