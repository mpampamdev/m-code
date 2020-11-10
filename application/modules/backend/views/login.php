<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LOGIN SYSTEM</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url()?>_temp/backend/css/style.css">
  <link rel="shortcut icon" href="<?=base_url()?>_temp/backend/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="<?=base_url()?>_temp/uploads/logo/<?=setting("logo")?>" alt="logo">
              </div>
              <h4>LOGIN SYSTEM</h4>
              <h6 class="font-weight-light">Please login to manage the system</h6>
              <form class="pt-3" action="<?=site_url("backend/login/action")?>" id="form">
                <input type="text" name="token" class="form-control" value="<?=$this->session->token?>">
                <div class="form-group">
                  <label for="exampleInputEmail">Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" name="email" placeholder="Email">
                  </div>
                  <div id="email"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" name="password" placeholder="Password">
                  </div>
                  <div id="password"></div>
                </div>
                <div class="my-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" id="submit">LOGIN</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; <?=date("Y")?>  All rights reserved.</p>
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
