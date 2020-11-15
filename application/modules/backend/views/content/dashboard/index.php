<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5><?=cclang("welcome",profile("name"))?></h5>
        <p class="card-description">
          <?=cclang("welcome_description")?>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 card-columns mt-3">

    <?php if (is_allowed("dashboard__view_profile_user")): ?>
        <div class="card" style="min-height:363px">
          <div class="card-body">
            <h3 class="card-title"><?=cclang("profile_user")?></h3>
            <div class="text-center">
              <?=imgView(profile("photo"),"img-thumbnail","border-radius:100%;height:100px;width:100px;margin-bottom:10px;border:3px solid #c2c2c2")?>
            </div>

            <table class="table-profile">
              <tr>
                <td>Name</td>
                <td>: <?=profile("name")?></td>
              </tr>

              <tr>
                <td>Email</td>
                <td>: <?=profile("email")?></td>
              </tr>

              <tr>
                <td>Group</td>
                <td>: <?=profile("group")?></td>
              </tr>

              <tr>
                <td>IP address</td>
                <td>: <?=$this->input->ip_address()?></td>
              </tr>

              <tr>
                <td>Last Login</td>
                <td>: <?=date("d/m/Y H:i", strtotime(profile("last_login")))?></td>
              </tr>

              <tr>
                <td>Created</td>
                <td>: <?=date("d/m/Y H:i", strtotime(profile("created")))?></td>
              </tr>
            </table>
          </div>
        </div>
    <?php endif; ?>


    <?php if (is_allowed("dashboard_view_total_user")): ?>
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left"><?=cclang("total_user")?></p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center" style="color: #686868;">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?=$this->model->get_data("auth_user",["is_delete"=> "0" , "id_user !=" => 1])->num_rows()?></h3>
              <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>
          </div>
        </div>
    <?php endif; ?>

    <?php if (is_allowed("dashboard_view_total_group")): ?>
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left"><?=cclang("total_group")?></p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center" style="color: #686868;">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?=$this->model->get_data("auth_group",[ "id !=" => 1])->num_rows()?></h3>
              <i class="mdi mdi-animation icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>
          </div>
        </div>
    <?php endif; ?>

    <?php if (is_allowed("dashboard_view_total_permission")): ?>
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">Total Permission</p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center" style="color: #686868;">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?=$this->model->get_data("auth_permission")->num_rows()?></h3>
              <i class="mdi mdi-buffer icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>
          </div>
        </div>
    <?php endif; ?>

    <?php if (is_allowed("dashboard_view_total_filemanager")): ?>
        <div class="card">
          <div class="card-body">
            <p class="card-title text-md-center text-xl-left">Total Filemanager</p>
            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center" style="color: #686868;">
              <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?=$this->model->get_data("filemanager")->num_rows()?></h3>
              <i class="mdi mdi-file-image icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
            </div>
          </div>
        </div>
    <?php endif; ?>

  </div>
</div>



<div class="row">


  <div class="col-md-6">

  </div>
</div>
