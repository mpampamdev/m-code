<div class="row">
  <div class="col-md-12 col-xl-10 mx-auto animated fadeIn delay-2s">
    <div class="card-header bg-primary text-white">
      <?=ucwords($title_module)?>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <tr>
            <td>Full Name</td>
            <td><?=$nama?></td>
          </tr>

          <tr>
            <td>Email</td>
            <td><?=$email?></td>
          </tr>

          <tr>
            <td>Group</td>
            <td><?=$group?></td>
          </tr>

          <tr>
            <td>Is_active</td>
            <td><?=$is_active == "1" ? '<i class="mdi mdi-eye text-success"></i> Y':'<i class="mdi mdi-eye-off text-danger"></i> N'?></td>
          </tr>
        </table>

        <a href="<?=site_url("backend/".$this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
