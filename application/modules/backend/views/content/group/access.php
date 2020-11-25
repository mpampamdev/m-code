<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <p class="card-description"><?=ucwords($group)?> - <?=$definition?></p>
        <div class="row">
          <div class="col-sm-4">
            <input type="text" id="search" name="search" placeholder="Filter Permission">
          </div>
          <div class="col-sm-2">
            <div class="form-check form-check-primary">
              <label class="form-check-label">
                <input type="checkbox" id="check_all" name="check_all" title="check all" class="form-check-input">
                <?=cclang("select_all")?>
              <i class="input-helper"></i></label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <form class="" action="<?=$action?>" method="post">
      <div class="card-columns mt-3">
        <div id="clist">
          <?=$list?>
        </div>
      </div>
      <hr>
      <a href="<?=url("group")?>" class="btn btn-sm btn-danger"><?=cclang("cancel")?></a>
      <button type="submit" name="submit" class="btn btn-sm btn-primary"><?=cclang("save")?></button>
      <a href="javascript:window.location.reload();" style="display:none" class="btn btn-sm btn-dark restore"> Restore</a>
    </form>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
  $(document).on("change","#check_all",function(e){
      e.preventDefault();
      if (this.checked) {
        $('input:checkbox').prop('checked',true);
      }else {
        $('input:checkbox').prop('checked', false);
      }
  });

  $(document).on("change","#check_all",function(e){
      e.preventDefault();
      if (this.checked) {
        $('input:checkbox').prop('checked',true);
      }else {
        $('input:checkbox').prop('checked', false);
      }
  });

    $(".form-check-input").change(function(){
      $(".restore").show();
    });

    //filter
    $('#search').on('keyup', function() {
          var filter = $(this).val();
          var regex = new RegExp(filter, "gi");

          $(document).find('#clist .card, li').hide();
          $(document).find('#clist .card, li').filter(function() {

              if ($(this).text().match(regex)) {
                  return true;
              }
              return false;
          }).show();
      });
});


$(document).on("click","#delete_permission",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $("#modalTitle").text('<?=cclang("confirm")?>');
  $('#modalContent').html(`<p class="mb-4"><?=cclang("delete_description")?></p>
														<button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
	                          <button type='button' class='btn btn-primary btn-sm' id='ya-hapus' data-id=`+$(this).attr('alt')+`  data-url=`+$(this).attr('href')+`><?=cclang("delete_action")?></button>
														`);
  $("#modalGue").modal('show');
});


$(document).on('click','#ya-hapus',function(e){
  $(this).prop('disabled',true)
          .text('Processing...');
  $.ajax({
          url:$(this).data('url'),
          type:'POST',
          cache:false,
          dataType:'json',
          success:function(json){
            $('#modalGue').modal('hide');
            location.reload();
          }
        });
});

</script>
