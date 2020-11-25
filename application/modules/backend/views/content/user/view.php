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
            <td>Photo</td>
            <td>
              <?=imgView($photo);?>
            </td>
          </tr>

          <tr>
            <td>Group</td>
            <td><?=$group?></td>
          </tr>

          <tr>
            <td>Is_active</td>
            <td><?=$is_active == "1" ? '<i class="mdi mdi-eye text-success"></i> Y':'<i class="mdi mdi-eye-off text-danger"></i> N'?></td>
          </tr>

          <tr>
            <td>Last login</td>
            <td><?=$last_login == "" ? "Null": date("d/m/Y H:i",strtotime($last_login))?></td>
          </tr>

          <tr>
            <td>Join</td>
            <td><?=$created == "" ? "Null": date("d/m/Y H:i",strtotime($created))?></td>
          </tr>

        </table>

        <a href="<?=url($this->uri->segment(2))?>" class="btn btn-sm btn-danger mt-3"><?=cclang("back")?></a>
      </div>
    </div>
  </div>
</div>
