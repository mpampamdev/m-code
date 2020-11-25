<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-8">
            <a href="<?=url("permission/add")?>" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i><?=cclang("add_new")?></a>
            <button type="button" id="reload" class="btn btn-sm btn-info-2 btn-icon-text"><i class="mdi mdi-backup-restore btn-icon-prepend"></i> <?=cclang("reload")?></button>
            <a href="<?=url("permission/delete")?>" id="delete_select" class="btn btn-sm btn-danger btn-icon-text"><i class="ti-trash btn-icon-prepend"></i> <?=cclang("delete selected")?></a>
        </div>
          <div class="form-group col-sm-4 float-right">
            <div class="input-group">
              <input type="text" class="form-control" id="permission" style="height:35px!important" placeholder="Filter Permission">
              <div class="input-group-append">
                <button class="btn btn-sm btn-primary btn-icon-text" id="filter" style="height:35px!important" type="button"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Permission</th>
              <th>Alias</th>
              <th>Definition</th>
              <th>#</th>
            </tr>
          </thead>

        </table>

      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
var table;
//datatables
  table = $('#table').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "searching": false,
      // "info": false,
      "bLengthChange": false,
      oLanguage: {
          sProcessing: '<i class="fa fa-spinner fa-spin fa-fw"></i> Loading...'
      },

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url("backend/permission/json")?>",
          "type": "POST",
          "data":function(data)
          {
            data.permission = $("#permission").val();
          }
      },

      //Set column definition initialisation properties.
        "columnDefs": [
        {   "className": "text-center",
            "width":"10px",
            "orderable":false,
            "targets": 0, //first column / numbering column
        },
        {
            "targets": 1, //first column / numbering column
        },
        {   "orderable":false,
            "targets": 2, //first column / numbering column
        },
        {   "orderable":false,
            "targets": 3, //first column / numbering column
        },
        {   "orderable":false,
            "targets": 4, //first column / numbering column
        },
        {
            "className": "text-center",
            "orderable": false,
            "targets": 5
        },
      ],
    });

$("#filter").click(function(){
  table.ajax.reload();
});

$("#reload").click(function(){
	$("#permission").val("");
  table.ajax.reload();
});

$(document).on("click","#delete",function(e){
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
            swal(json.msg, {
              icon:json.type_msg
            })
            $('#table').DataTable().ajax.reload();
          }
        });
});

$(document).on("click","#delete_select",function(e){
  e.preventDefault();
  $('.modal-dialog').removeClass('modal-lg')
                    .removeClass('modal-md')
                    .addClass('modal-sm');
  $("#modalTitle").text('<?=cclang("confirm")?>');
  $('#modalContent').html(`<p class="mb-4"><?=cclang("delete_description")?></p>
														<button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
	                          <button type='button' class='btn btn-primary btn-sm' id='ya-hapus-select'  data-url=`+$(this).attr('href')+`><?=cclang("delete_action")?></button>
														`);
  $("#modalGue").modal('show');
});

$(document).on('click','#ya-hapus-select',function(e){
  var dataId = [];
  $("input[type='checkbox']:checked").each(function() {
      dataId.push($(this).val());
  });

  $(this).prop('disabled',true)
          .text('Processing...');
  $.ajax({
          url:$(this).data('url'),
          type:'POST',
          data:'id='+dataId,
          cache:false,
          dataType:'json',
          success:function(json){
            $('#modalGue').modal('hide');
            swal(json.msg, {
              icon:json.type_msg
            })
            $('#table').DataTable().ajax.reload();
          }
        });
});


});
</script>
