<form autocomplete="off">
  <div class="row">
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="nama" placeholder="Nama" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="email" placeholder="Email" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="telepon" placeholder="Telepon" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="alamat" placeholder="Alamat" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="foto" placeholder="Foto" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="tanggal" placeholder="Tanggal" />
		</div>
		<div class="form-group col-sm-6">
			<input type="text" class="form-control form-control-sm" id="tanggal_waktu" placeholder="Tanggal Waktu" />
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
