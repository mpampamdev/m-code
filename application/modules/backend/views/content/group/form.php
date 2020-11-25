<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form id="form" action="<?=$action?>" autocomplete="off">
          <div class="form-group">
            <label id="group">Group </label><i class="text-danger">*</i>
            <input type="text" class="form-control form-control-sm" name="group" value="<?=$group?>">
          </div>

          <div class="form-group">
            <label id="definition">Definition </label>
            <textarea class="form-control" name="definition" rows="3" cols="80"><?=$definition?></textarea>
          </div>

          <input type="hidden" name="button" value="<?=strtolower($button)?>">

          <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
          <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary"><?=cclang("save")?></button>

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
