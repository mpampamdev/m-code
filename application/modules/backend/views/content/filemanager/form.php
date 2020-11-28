<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <i class="ti-pencil-alt"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <form id="form" action="<?=$action?>" autocomplete="off">
					<div class="form-group">
					<label>File Name</label>
						<input type="file" name="img" class="file-upload-default" data-id="filemanager"/>
							<div class="input-group col-xs-12">
								<input type="hidden" class="file-dir" name="file-dir" data-id="filemanager"/>
								<input type="text" class="form-control form-control-sm file-upload-info file-name" data-id="filemanager" readonly name="file_name" value="<?=$file_name?>" />
									<span class="input-group-append">
										<button class="btn-remove-image btn btn-danger btn-sm" data-id="filemanager" type="button" style="display:<?=$file_name!=''?'block':'none'?>;"><i class="ti-trash"></i></button>
										<button class="file-upload-browse btn btn-primary btn-sm" data-id="filemanager" type="button">Select File</button>
									</span>
							</div>
						<div id="file_name"></div>
					</div>

          <div class="form-group">
            <label for="">Ket</label>
            <textarea name="ket" id="ket" class="form-control" rows="2" cols="80">Di upload melalui module File manager</textarea>
          </div>


          <input type="hidden" name="params" value="<?=strtolower($params)?>">

        <div class="mt-4">
          <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
          <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary"><?=cclang("save")?></button>
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
