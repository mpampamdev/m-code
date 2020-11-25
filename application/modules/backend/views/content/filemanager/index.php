<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s">
    <div class="card m-b-30">
      <div class="card-header bg-primary text-white">
        <i class="ti-files"></i> <?=ucwords($title_module)?>
      </div>
      <div class="card-body">
        <div class="mb-1">
          <a href="<?=url("filemanager/add")?>" id="add" class="btn btn-sm btn-success btn-icon-text"><i class="fa fa-file btn-icon-prepend"></i> <?=cclang("add_new")?></a>
          <button type="button" id="reload" class="btn btn-sm btn-info-2 btn-icon-text"><i class="mdi mdi-backup-restore btn-icon-prepend"></i> <?=cclang("reload")?></button>
          <a href="<?=url("filemanager/filter/")?>" id="filter-show" class="btn btn-sm btn-primary btn-icon-text"><i class="mdi mdi-magnify btn-icon-prepend"></i> Filter</a>
          <a href="<?=url("filemanager/delete")?>" id="delete_select" class="btn btn-sm btn-danger btn-icon-text"><i class="ti-trash btn-icon-prepend"></i> <?=cclang("delete_selected")?></a>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
  							<th>File Name</th>
                <th>Ket</th>
                <th>Created</th>
                <th>#</th>
              </tr>
            </thead>
          </table>
        </div>

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
          "url": BASE_URL + "backend/filemanager/json",
          "type": "POST",
          "data":function(data){
      		data.file_name = $("#file_name").val();
          data.ket = $("#ket").val();
          }
      },

      //Set column definition initialisation properties.
        "columnDefs": [
					{   'width':'5px',
              'className': 'text-center',
              'orderable': false,
              'targets': 0
          },
          {
            'orderable': false,
            'targets': 1
          },
          {
            'orderable': false,
            'targets': 2
          },
  				{
            'orderable': false,
            'targets': 3
          },
          {
            'className': 'text-center',
            'orderable': false,
            'targets': 4
          },
          {
            'className': 'text-center',
            'orderable': false,
            'targets': 5
          }
      ],
    });


$("#reload").click(function(){
	$("#file_name").val("");
  $("#ket").val("");
  table.ajax.reload();
});


$(document).on("click","#filter-show",function(e){
  e.preventDefault();
  $('.modal-dialog').addClass('modal-md');
  $("#modalTitle").text('Filter');
  $('#modalContent').load($(this).attr('href'));
  $("#modalGue").modal('show');
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
