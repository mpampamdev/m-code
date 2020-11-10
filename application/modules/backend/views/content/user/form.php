<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">

    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
          <?php echo form_open($action, array( 'id' => 'form', 'autocomplete' => 'off' ));?>
          <div class="form-group">
              <label for="example-search-input" class="">Full Name</label>
              <input class="form-control" type="text" name="nama" id="nama" value="<?=$nama?>">
          </div>


          <div class="form-group">
              <label for="example-search-input" class="">Group</label>
                <!-- is_combo($table,$id_name,$id_field,$name_field,$value) -->
                <?=is_combo("auth_group","id_group","id","group",$id_group)?>
          </div>


          <div class="form-group">
              <label for="example-search-input" class="">Is Active</label>
              <select class="form-control" name="is_active" id="is_active">
                <?php if ($button == "tambah"): ?>
                  <option value="">-- Select --</option>
                <?php endif; ?>
                <option <?=($is_active=="1") ? 'selected':''?> value="1">Y</option>
                <option <?=($is_active=="0") ? 'selected':''?> value="0">N</option>
              </select>
          </div>


          <div class="form-group">
              <label for="example-search-input" class="">Email</label>
              <input class="form-control" type="text" name="email" id="email" value="<?=$email?>">
          </div>

          <?php if ($button=="update"): ?>
            <input class="form-control" type="hidden" name="last_email" id="last_email" value="<?=$email?>">
            <p class="text-primary" style="font-size:12px">* Do not fill in if you do not want to change the password</p>
          <?php endif; ?>

          <div class="form-group">
              <label for="example-search-input" class="">Password</label>
              <input class="form-control" type="password" name="password" id="password">
          </div>

          <div class="form-group">
              <label for="example-search-input" class="">Confirm Password</label>
              <input class="form-control" type="password" name="konfirmasi_password" id="konfirmasi_password">
          </div>

          <input type="hidden" name="submit" value="<?=$button?>">

          <div class="text-right">
            <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
            <button type="submit" id="submit" name="submit"  class="btn btn-sm btn-primary"><?=cclang("save")?></button>
          </div>
        </form>


      </div>
    </div>
  </div>
</div>


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
          location.href = json.redirect;
          return;
        }else {
          $("#submit").prop('disabled',false)
                      .html('<?=cclang("save")?>');
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
