<link href="<?=base_url()?>_temp/backend/vendors/nestable/jquery.nestable.css" rel="stylesheet" />
<!--script for this page only-->
<script src="<?=base_url()?>_temp/backend/vendors/nestable/jquery.nestable.js"></script>

<style media="screen">
  .dd{
    max-width:100%!important;
  }

  .float-right a{
    display: inline-block!important;
  }
</style>
      <div class="row">
        <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
          <div class="card m-b-30">
            <div class="card-header bg-primary text-white">
              <?=ucwords($title_module)?>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <a href="<?=url('main_menu/add')?>" class="btn btn-sm btn-success"><i class="fa fa-file"></i> <?=cclang("add_new")?></a>
                <a href="<?=url("main_menu")?>" class="btn btn-sm btn-info text-white"><i class="fa fa-refresh"></i> <?=cclang("reload")?></a>
              </div>


              <?php
                $get_menu = $this->db->select("*")
                                     ->from("main_menu")
                                     ->where("is_parent",0)
                                     ->order_by("sort","ASC")
                                     ->get()->result();

               ?>
              <div class="custom-dd dd" id="main_menu">
                  <ol class="dd-list">
                    <?php foreach ($get_menu as $menu): ?>
                      <?php  $url_menu = ($menu->type == "controller") ? url("$menu->controller") : $menu->controller?>
                      <?php
                        $get_sub_menu = $this->db->select("*")
                                                 ->from("main_menu")
                                                 ->where("is_parent",$menu->id_menu)
                                                 ->order_by("sort","ASC")
                                                 ->get();
                      ?>
                      <?php if ($get_sub_menu->num_rows() > 0): ?>
                        <li class="dd-item" data-id="<?=$menu->id_menu?>">
                            <div class="dd-handle">
                                <?=strtoupper($menu->menu)?>
                                <div class="float-right dd-nodrag">
                                  <span class="text-success">[ # ]</span>
                                  <span class="text-primary">[ <?=$menu->is_active=="1" ? '<i class="mdi mdi-eye text-info"></i>':'<i class="mdi mdi-eye-off text-danger"></i>'?> ]</span>
                                  <a href="<?=url("main_menu/update/".enc_url($menu->id_menu))?>" class="badge badge-primary"><i class="fa fa-pencil"></i> <?=cclang("update")?></a>
                                  <a id="delete" href="<?=url("main_menu/delete/".enc_url($menu->id_menu))?>" class="badge badge-danger"><i class="fa fa-trash"></i> <?=cclang("delete")?></a>
                                </div>
                            </div>
                            <ol class="dd-list">
                                <?php foreach ($get_sub_menu->result() as $sub_menu): ?>
                                  <?php  $url_sub_menu = ($sub_menu->type == "controller") ? url("$sub_menu->controller") : $sub_menu->controller?>

                                  <li class="dd-item" data-id="<?=$sub_menu->id_menu?>">
                                      <div class="dd-handle">
                                          <?=strtoupper($sub_menu->menu)?>
                                          <div class="float-right dd-nodrag">
                                            <span class="text-success">[ <?=$url_sub_menu?> ]</span>
                                            <span class="text-primary">[ <?=$sub_menu->is_active=="1" ? '<i class="mdi mdi-eye text-info"></i>':'<i class="mdi mdi-eye-off text-danger"></i>'?> ]</span>
                                            <a href="<?=url("main_menu/update/".enc_url($sub_menu->id_menu))?>" class="badge badge-primary"><i class="fa fa-pencil"></i> <?=cclang("update")?></a>
                                            <a id="delete" href="<?=url("main_menu/delete/".enc_url($sub_menu->id_menu))?>" class="badge badge-danger"><i class="fa fa-trash"></i> <?=cclang("delete")?></a>
                                          </div>
                                      </div>
                                  </li>
                                <?php endforeach; ?>
                            </ol>
                        </li>
                        <?php else: ?>
                          <li class="dd-item" data-id="<?=$menu->id_menu?>">
                              <div class="dd-handle">
                                  <?=strtoupper($menu->menu)?>
                                  <div class="float-right dd-nodrag">
                                    <span class="text-success">[ <?=$url_menu?> ]</span>
                                    <span class="text-primary">[ <?=$menu->is_active=="1" ? '<i class="mdi mdi-eye text-info"></i>':'<i class="mdi mdi-eye-off text-danger"></i>'?> ]</span>
                                    <a href="<?=url("main_menu/update/".enc_url($menu->id_menu))?>" class="badge badge-primary"><i class="fa fa-pencil"></i> <?=cclang("update")?></a>
                                    <a id="delete" href="<?=url("main_menu/delete/".enc_url($menu->id_menu))?>" class="badge badge-danger"><i class="fa fa-trash"></i> <?=cclang("delete")?></a>
                                  </div>
                              </div>
                          </li>
                      <?php endif; ?>

                      <?php endforeach; ?>


                  </ol>


              </div>

            </div>
          </div>
        </div>
      </div>

<input type="hidden" id="main_menu_output">

<script type="text/javascript">
$(document).on("click","#delete",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $("#modalTitle").text('<?=cclang("confirm")?>');
  $('#modalContent').html(`<p class="mb-4"><?=cclang("delete_description")?></p>
														<button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
	                          <a  class='btn btn-primary btn-sm' id='ya-hapus' data-id=`+$(this).attr('alt')+`  href=`+$(this).attr('href')+`><?=cclang("delete_action")?></a>
														`);
  $("#modalGue").modal('show');
});



<?php if (is_allowed("menu_drag_positions")) { ?>
!function($) {
  "use strict";

  var Nestable = function() {};

  Nestable.prototype.updateOutput = function (e) {
      var list = e.length ? e : $(e.target),
          output = list.data('output');
      if (window.JSON) {
          output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
      } else {
          alert('JSON browser support required for this demo.');
      }
  },
  //init
  Nestable.prototype.init = function() {

      // activate Nestable for list 2
      $('#main_menu').nestable({
          group: 1,
          maxDepth:2
      }).on('change', this.updateOutput);

      this.updateOutput($('#main_menu').data('output', $('#main_menu_output')));




      // $('#nestable_list_menu').on('click', function (e) {
      //     var target = $(e.target),
      //         action = target.data('action');
      //     if (action === 'expand-all') {
      //         $('.dd').nestable('expandAll');
      //     }
      //     if (action === 'collapse-all') {
      //         $('.dd').nestable('collapseAll');
      //     }
      // });


      $('.dd').on('change', function() {
        $('#main_menu').toggleClass('drag_disabled drag_enabled');
        var dataString = {
             data : $("#main_menu_output").val(),
           };

       $.ajax({
           type: "POST",
           url: "<?=base_url()?>backend/main_menu/save",
           data: dataString,
           cache : false,
           // success: function(data){
           //   showToast(data.type_msg , data.msg)
           // },
           error: function(xhr, status, error) {
             alert(error);
           },
       });
    });

  },
  //init
  $.Nestable = new Nestable, $.Nestable.Constructor = Nestable
}(window.jQuery),

//initializing
function($) {
  "use strict";
  $.Nestable.init()
}(window.jQuery);

<?php } ?>
</script>
