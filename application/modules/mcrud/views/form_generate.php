<form  action="<?=base_url()?>mcrud/action" id="form" autocomplete="off">
<div class="card mt-3 mb-3">
  <div class="card-body">
    <h3 class="card-title">Form Generate</h3>

      <div class="row">
         <div class="form-group col-md-6">
           <label for="">Table</label>
           <input type="text" class="form-control" id="table" name="table" value="<?=$table?>" readonly>
         </div>

         <div class="form-group col-md-6">
           <label for="">Title </label><i class="text-danger">**</i>
           <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?=ucwords(str_replace("_"," ",$table))?>">
         </div>

         <div class="form-group col-md-6">
           <label for="">Controller </label><i class="text-danger">**</i>
           <input type="text" class="form-control" id="controller" name="controller" placeholder="Controller" value="<?=ucfirst($table)?>">
         </div>

         <div class="form-group col-md-6">
           <label for="">Model </label><i class="text-danger"> **</i>
           <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="<?=ucfirst($table)?>_model">
         </div>
       </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="form-check form-check-flat form-check-primary mb-3">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" id="check_all">
        <?=cclang("select_all")?>
      <i class="input-helper"></i></label>
    </div>
  </div>


<div class=" col-lg-12">
  <div class="row">
  <?php foreach ($field as $fields): ?>
    <?php $primary_key = $fields->primary_key; ?>
    <div class="col-sm-3 mb-2">
    <div class="card" <?=$primary_key == 1 ? "style='min-height:309px;'":""?>>
      <div class="card-header bg-primary text-white">
        <i class="mdi mdi-cards-outline"></i> <?=$fields->name?> <?=$primary_key==1 ? ' <i class="mdi mdi-key text-warning"></i>':''?>
      </div>
      <div class="card-body">
        <div class="form-check form-check-flat form-check-primary mb-3">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="show_table[<?=$fields->name?>]">
            <?=cclang("show_in_table")?>
          <i class="input-helper"></i></label>
        </div>

        <?php if ($primary_key!=1): ?>
          <div class="form-group">
            <label for=""><?=cclang("type_form")?></label>
            <select class="form-control form-control-smm" id="type_form[<?=$fields->name?>]" name="type_form[<?=$fields->name?>]">
              <option value="text">text</option>
              <option value="textarea">textarea</option>
              <option value="imageupload">image-upload</option>
              <option value="text-editor">text-editor (summernote)</option>
              <option value="date">date</option>
              <option value="time">time</option>
              <option value="datetime-local">datetime</option>
            </select>
          </div>
      <?php endif; ?>

        <?php if ($primary_key!=1): ?>
          <div class="form-group">
            <label for=""><?=cclang("rules_form_validation")?></label>
             <select class="js-multiple-select form-control" style="width:100%!important" name="rules[<?=$fields->name?>][]" id="rules[<?=$fields->name?>][]" multiple="multiple" >
               <option value="required">required</option>
               <option value="numeric">numeric</option>
               <option value="alpha">alpha</option>
               <option value="alpha_numeric">alpha_numeric</option>
               <option value="alpha_numeric_spaces">alpha_numeric_spaces</option>
               <option value="alpha_dash">alpha_dash</option>
               <option value="alpha_underscores">alpha_underscores</option>
               <option value="valid_email">valid_email</option>
               <option value="valid_url">valid_url</option>
               <option value="valid_ip">valid_ip</option>
             </select>
           </div>
        <?php endif; ?>


      </div>
    </div>
  </div>
   <?php endforeach; ?>
    </div>
   </div>
</div>

<div class="float-right mt-2">
  <a href="<?=site_url("mcrud")?>" name="button" class="btn btn-danger cancel"><?=cclang("cancel")?></a>
  <button type="button" class="btn btn-dark restore" name="button"><?=cclang("restore")?></button>
  <button type="submit" name="submit" id="submit" class="btn btn-primary" name="button"><?=cclang("created_module")?></button>
</div>
</form>


<script type="text/javascript">
$(document).ready(function(){
  $(".js-multiple-select").select2();


  $(document).on("change","#check_all",function(e){
      e.preventDefault();
      if (this.checked) {
        $('input:checkbox').prop('checked',true);
      }else {
        $('input:checkbox').prop('checked', false);
      }
  });

  $(".restore").click(function(){
    $("#submit-select-table").trigger("click");
    $("html, body").stop().animate({scrollTop:0}, 500, 'swing');
  })

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
            $("#submit").prop('disabled',false)
                        .html('Create Module');
            $("#db-table").change().val("");
            $("#content").html("<h5 class='mt-4 ml-3'>Create Module Success</h5><ul class='success'></ul>");
            $(".alert-module").html("");
              $.each(json.msg, function(key, value) {
                $("#content ul").hide().fadeIn(300).append("<li><i class='mdi mdi-checkbox-multiple-marked-circle'></i> "+value+"</li>");
              });
          }else {
            $("html, body").stop().animate({scrollTop:0}, 500, 'swing');
            $("#submit").prop('disabled',false)
                        .html('Create Module');
            $(".alert-module").html("");
            $(".alert-module").hide()
                              .fadeIn(300)
                              .html(`<div class="alert alert-danger">
                                      <ul>`
                                      +json.msg+
                                      `</ul>
                                    </div>`
                                    );
          }
        }
      });
  });

});
</script>
