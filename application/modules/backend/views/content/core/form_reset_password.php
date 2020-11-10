<form id="form" action="<?=site_url("backend/core/reset_password_action")?>">
  <div class="form-group row">
      <label class="col-sm-4 col-form-label">Password Lama</label>
      <div class="col-sm-8">
          <input class="form-control" placeholder="******" type="password" name="password" id="password">
      </div>
  </div>

  <hr>

  <div class="form-group row">
      <label class="col-sm-4 col-form-label">Password Baru</label>
      <div class="col-sm-8">
          <input class="form-control" placeholder="******" type="password" name="password_baru" id="password_baru">
      </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-4 col-form-label">Konfirmasi Password</label>
      <div class="col-sm-8">
          <input class="form-control" placeholder="******" type="password" name="konfirmasi_password" id="konfirmasi_password">
      </div>
  </div>


  <div class="text-right">
    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-danger">Cancel</button>
    <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary">Reset Password</button>
  </div>
</form>



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
          $("#modalGue").modal("hide");
            $.toast({
              text: json.alert,
              showHideTransition: 'slide',
              icon: 'success',
              loaderBg: '#f96868',
              position: 'bottom-right',
							hideAfter: 3000
            });
        }else {
          $("#submit").prop('disabled',false)
                      .html('Reset Password');
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
