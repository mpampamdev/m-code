<form autocomplete="off">
  <div class="row">
		<div class="form-group col-sm-12">
			<input type="text" class="form-control form-control-sm" id="file_name" placeholder="File Name" />
		</div>

    <div class="form-group col-sm-12">
			<input type="text" class="form-control form-control-sm" id="ket" placeholder="Ket" />
		</div>

    <div class="col-sm-12 mt-2">
      <button type='button' class='btn btn-default btn-sm' data-dismiss='modal'><?=cclang("cancel")?></button>
      <button type="button" class="btn btn-primary btn-sm" id="filter">Filter</button>
    </div>
  </div>
</form>

<script type="text/javascript">
$("#filter").click(function(){
  $('#modalGue').modal('hide');
  $("#table").DataTable().ajax.reload();  //just reload table
});
</script>
