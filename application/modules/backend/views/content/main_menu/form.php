<style media="screen">
  .twitter-typeahead{
    display: block!important;
  }
</style>

<script src="<?=base_url()?>_temp/backend/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
            <?php echo form_open($action, array( 'id' => 'form', 'autocomplete' => 'off' ));?>
            <div class="row">
            <div class="form-group col-sm-6">
              <label  id="menu">Menu Title</label><span class="text-danger"> *</span>
              <input class="form-control form-control-sm" type="text" name="menu" value="<?=$menu?>" placeholder="Menu Title">
            </div>


            <div class="form-group col-sm-6">
              <label>Icon</label>
                <input type="text" id="icon" name="icon" value="<?=$icon?>" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info form-control-sm" id="icons" value="<?=$icon?>" disabled="" placeholder="Icon">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary btn-sm" href="<?=site_url("backend/core/icon")?>" id="icons" type="button">Icon</button>
                    <button class="file-upload-browse btn btn-danger btn-sm" id="icons-remove" type="button"><i class="fa fa-trash"></i></button>
                  </span>
                </div>
            </div>

            <div class="form-group col-sm-6">
              <label id="type">Type</label><span class="text-danger"> *</span>
              <select class="form-control form-control-sm" name="type">
                <option <?=$type=="controller" ? "selected":""?> value="controller">Controller</option>
                <option <?=$type=="url" ? "selected":""?> value="url">Url</option>
              </select>
            </div>

            <div class="form-group col-sm-6">
              <label id="controller">Link</label>
              <input type="text" class="typeahead form-control form-control-sm"  name="controller" placeholder="Link/Controller" value="<?=$controller?>">
            </div>

            <div class="form-group col-sm-6">
              <label for="">Target</label>
              <select class="form-control form-control-sm" name="data_target" id="data_target">
                <option value="">None</option>
                <option <?=$data_target=="_blank" ? "selected":""?> value="_blank">_blank</option>
              </select>
            </div>

            <div class="form-group col-sm-6">
                <label >Is Parent</label>
                <select class="form-control form-control-sm" name="is_parent" id="is_parent">
                  <option <?=$is_parent==0?"selected":""?> value="0">Y</option>
                  <?php $get_menu = $this->db->get_where("main_menu",["id_menu !="=>$id_menu, "is_parent"=> "0"]); ?>
                  <optgroup label="-- Main Menu --">
                  <?php foreach ($get_menu->result() as $menu): ?>
                    <option <?=$is_parent==$menu->id_menu?"selected":""?> value="<?=$menu->id_menu?>"><?=ucfirst($menu->menu)?></option>
                  <?php endforeach; ?>
                </optgroup>
                </select>
            </div>


            <div class="form-group col-sm-6">
                <label id="is_active">Is Active</label><span class="text-danger"> *</span>
                <select class="form-control form-control-sm" name="is_active">
                  <option value=""> -- Select --</option>
                  <option <?=$is_active=="1"?"selected":""?> value="1">Y</option>
                  <option <?=$is_active=="0"?"selected":""?> value="0">N</option>
                </select>
            </div>


            <input type="hidden" name="submit" value="<?=$button?>">

            <div class="col-sm-12 mt-3">
              <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
              <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary"><?=cclang("save")?></button>
            </div>
          </div>
        </form>


      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
$(document).ready(function(){
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


  $(document).on("click","#icons",function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-md')
                      .removeClass('modal-sm')
                      .addClass('modal-lg');
    $("#modalTitle").text('Icon');
    $('#modalContent').load($(this).attr("href"));
    $("#modalGue").modal('show');
  });

  $(document).on("click","#icons-remove",function(e){
    e.preventDefault();
    $("#icon , #icons").val("");
  })
});


var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    var substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    for (var i = 0; i < strs.length; i++) {
      if (substrRegex.test(strs[i])) {
        matches.push(strs[i]);
      }
    }

    cb(matches);
  };
};

var states = [
  <?php $get_controller = $this->userize->combo_controllerlist();
   foreach ($get_controller as $controllers){
    echo "'$controllers',";
    } ?>
];

$('.typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
}, {
  name: 'states',
  source: substringMatcher(states)
});
// constructs the suggestion engine
var states = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // `states` is an array of state names defined in "The Basics"
  local: states
});


</script>
