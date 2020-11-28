<link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/xeditable/bootstrap-editable.css">
<script src="<?=base_url()?>_temp/backend/vendors/xeditable/bootstrap-editable.min.js"></script>
<div class="row">
  <div class="col-md-12 col-xl-12 mx-auto animated fadeIn delay-2s grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><?=ucfirst($title_module)?></h4>
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link text-primary active" id="umum-tab" data-toggle="tab" href="#umum" role="tab" aria-controls="umum" aria-selected="true"><i class="fa fa-window-restore"></i> Default</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" id="logo-tab" data-toggle="tab" href="#logo-1" role="tab" aria-controls="logo-1" aria-selected="false"><i class="fa fa-image"></i> Logo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" id="sosmed-tab" data-toggle="tab" href="#sosmed-1" role="tab" aria-controls="sosmed-1" aria-selected="false"><i class="fa fa-globe"></i> Social Media</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" id="config-tab" data-toggle="tab" href="#config-1" role="tab" aria-controls="config-1" aria-selected="false"><i class="fa fa-cogs"></i> System core</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade active show" id="umum" role="tabpanel" aria-labelledby="umum-tab">
            <?php if (!is_allowed('config_view_default')): ?>
                <div class="mt-4">
                  <?php $this->load->view("content/core/error403"); ?>
                </div>
              <?php else: ?>
              <table class="table-setting table-striped table-hover">
                <tr>
                  <td class="table-title"><?=cclang("title")?> Web/App</td>
                  <td>
                    <a href="javascript:void(0);" id="web_name" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="1" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('web_name')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title">Url/Domain</td>
                  <td>
                    <a href="javascript:void(0);" id="web_domain" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="2" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('web_domain')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title"><?=cclang("owner")?></td>
                  <td>
                    <a href="javascript:void(0);" id="web_owner" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="3" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('web_owner')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title">Email</td>
                  <td>
                    <a href="javascript:void(0);" id="email" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="4" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('email')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title"><?=cclang("phone")?></td>
                  <td>
                    <a href="javascript:void(0)" id="telepon" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="5" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('telepon')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title"><?=cclang("address")?></td>
                  <td>
                    <a href="javascript:void(0)" id="address" data-url="<?=get_url("setting/update_action")?>" data-type="textarea" data-rows="4"  data-pk="6" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('address')?></a>
                  </td>
                </tr>
              </table>
            <?php endif; ?>
          </div>

          <div class="tab-pane fade" id="logo-1" role="tabpanel" aria-labelledby="logo-tab">
            <?php if (!is_allowed('config_view_logo')): ?>
                <div class="mt-4">
                  <?php $this->load->view("content/core/error403"); ?>
                </div>
              <?php else: ?>
                <table class="table-setting table-striped table-hover">
                  <tr>
                    <td class="table-title">Logo (Size 350 x 100px)</td>
                    <td>
                      <a href="javascript:void(0);" id="logo" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="7" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('logo')?></a>
                    </td>
                  </tr>

                  <tr>
                    <td class="table-title">Logo Mini (Size 40 x 34px)</td>
                    <td>
                      <a href="javascript:void(0);" id="logo_mini" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="8" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('logo_mini')?></a>
                    </td>
                  </tr>

                  <tr>
                    <td class="table-title">Favicon</td>
                    <td>
                      <a href="javascript:void(0);" id="favicon" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="9" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('favicon')?></a>
                    </td>
                  </tr>
                </table>

                <p class="mt-4">
                  <a href="<?=url("filemanager")?>" class="text-waring" target="_blank"><i><b>Open Filemanager</b></i></a>
                </p>

            <?php endif; ?>
          </div>


          <div class="tab-pane fade" id="sosmed-1" role="tabpanel" aria-labelledby="sosmed-tab">
            <?php if (!is_allowed('config_view_sosmed')): ?>
                <div class="mt-4">
                  <?php $this->load->view("content/core/error403"); ?>
                </div>
              <?php else: ?>
            <table class="table-setting table-striped table-hover">
              <tr>
                <td class="table-title"><i class="ti-facebook cl-facebook"></i> Facebook</td>
                <td>
                  <a href="javascript:void(0);" id="facebook" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="50" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('facebook')?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><i class="ti-instagram cl-instagram"></i> Instagram</td>
                <td>
                  <a href="javascript:void(0);" id="instagram" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="51" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('instagram')?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><i class="ti-youtube cl-youtube"></i> Youtube</td>
                <td>
                  <a href="javascript:void(0);" id="youtube" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="52" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('youtube')?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><i class="ti-twitter cl-twitter"></i> Twitter</td>
                <td>
                  <a href="javascript:void(0);" id="twitter" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="53" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('twitter')?></a>
                </td>
              </tr>
            </table>
          <?php endif; ?>
          </div>


          <div class="tab-pane fade" id="config-1" role="tabpanel" aria-labelledby="config-tab">
            <?php if (!is_allowed('config_view_system')): ?>
                <div class="mt-4">
                  <?php $this->load->view("content/core/error403"); ?>
                </div>
              <?php else: ?>
            <table class="table-setting table-striped table-hover">
              <tr>
                <td class="table-title"><?=cclang("time_zone")?></td>
                <td>
                  <a href="javascript:void(0);" id="time_zone" data-url="<?=get_url("setting/update_action")?>" data-type="select" data-value="<?=$this->config->item("time_zone")?>" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("time_zone")?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">Encryption Key</td>
                <td>
                  <a href="javascript:void(0);" id="encryption_key" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("encryption_key")?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">Encryption Url</td>
                <td>
                  <a href="javascript:void(0);" id="encryption_url" data-url="<?=get_url("setting/update_action")?>" data-type="select" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("encryption_url") == 1 ? "Y":"N"?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">url_suffix</td>
                <td>
                  <a href="javascript:void(0);" id="url_suffix" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("url_suffix")?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">Route admin</td>
                <td>
                  <a href="javascript:void(0);" id="route_admin" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="998" class="editable editable-click" title="<?=cclang("update")?>"><?=ADMIN_ROUTE?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">Route login</td>
                <td>
                  <a href="javascript:void(0);" id="route_login" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="998" class="editable editable-click" title="<?=cclang("update")?>"><?=LOGIN_ROUTE?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">Max Upload</td>
                <td>
                  <a href="javascript:void(0);" id="max_upload" data-url="<?=get_url("setting/update_action")?>" data-type="text" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("max_upload")?></a> Kb
                </td>
              </tr>

              <tr>
                <td class="table-title"><?=cclang("language")?></td>
                <td>
                  <a href="javascript:void(0);" id="language" data-url="<?=get_url("setting/update_action")?>" data-type="select" data-value="<?=$this->config->item("language")?>" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("language")?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><?=cclang("user_log_activity")?></td>
                <td>
                  <a href="javascript:void(0);" id="user_log_status" data-url="<?=get_url("setting/update_action")?>" data-type="select" data-value="<?=setting('user_log_status')?>" data-pk="60" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('user_log_status')?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><?=cclang("maintenance")?></td>
                <td>
                  <a href="javascript:void(0);" id="maintenance_status" data-url="<?=get_url("setting/update_action")?>" data-type="select" data-value="<?=setting('maintenance_status')?>" data-pk="61" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('maintenance_status')?></a>
                </td>
              </tr>
            </table>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">
$(document).ready(function(){
  $.fn.editable.defaults.mode = 'inline';
  $.fn.editable.defaults.ajaxOptions = {type: "POST",dataType : 'JSON'};
   $.fn.editableform.buttons ='<button type="submit" class="btn btn-primary btn-sm editable-submit">' +
                               '<i class="fa fa-fw fa-check"></i>' +
                               '</button>' +
                               '<button type="button" class="btn btn-default btn-sm editable-cancel">' +
                               '<i class="fa fa-fw fa-times"></i>' +
                               '</button>';

  $('#web_name').editable({
     inputclass: 'form-control-sm',
     success: function(data) {
      if (data.success != true) {
        return data.msg;
      }
    }
  });

  $('#web_domain').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#logo').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#logo_mini').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#favicon').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#web_owner').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#telepon').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#email').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#address').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });


  $('#facebook').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#instagram').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#youtube').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#twitter').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#maintenance_status').editable({
    inputclass: 'form-control-sm',
    source: [
  			{value: 'Y', text: 'Y'},
  			{value: 'N', text: 'N'}
  		],
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#encryption_key').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#encryption_url').editable({
    inputclass: 'form-control-sm',
    source: [
  			{value: "TRUE", text: 'Y'},
  			{value: "FALSE", text: 'N'}
  		],
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#url_suffix').editable({
    inputclass: 'form-control-sm',
    success: function(data ,newValue) {
     if (data.success != true) {
       return data.msg;
     }else {
       location.href='<?=base_url("backend/setting")?>'+newValue;
     }
   }
  });

  $('#route_admin').editable({
    inputclass: 'form-control-sm',
    success: function(data ,newValue) {
     if (data.success != true) {
       return data.msg;
     }else {
       location.href='<?=base_url()?>'+data.value+"/setting";
     }
   }
  });

  $('#route_login').editable({
    inputclass: 'form-control-sm',
    success: function(data ,newValue) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#max_upload').editable({
    inputclass: 'form-control-sm',
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });


  $('#user_log_status').editable({
    inputclass: 'form-control-sm',
    source: [
  			{value: 'Y', text: 'Y'},
  			{value: 'N', text: 'N'}
  		],
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });

  $('#language').editable({
    inputclass: 'form-control-sm',
    source: [
  			{value: 'indonesia', text: 'indonesia'},
  			{value: 'english', text: 'english'}
  		],
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });




  $('#time_zone').editable({
    inputclass: 'form-control-sm',
    source: <?=$time_zone?>,
    success: function(data) {
     if (data.success != true) {
       return data.msg;
     }
   }
  });
});
</script>
