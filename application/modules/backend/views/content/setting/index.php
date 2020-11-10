<link rel="stylesheet" href="<?=base_url()?>_temp/backend/vendors/xeditable/bootstrap-editable.css">
<script src="<?=base_url()?>_temp/backend/vendors/xeditable/bootstrap-editable.min.js"></script>
<link href="<?=base_url()?>_temp/backend/vendors/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<script src="<?=base_url()?>_temp/backend/vendors/fine-upload/jquery.fine-uploader.js"></script>

<?php $this->load->view("content/core/fine_upload") ?>

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
                    <a href="javascript:void(0);" id="web_name" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="1" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('web_name')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title">Url</td>
                  <td>
                    <a href="javascript:void(0);" id="web_domain" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="2" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('web_domain')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title"><?=cclang("owner")?></td>
                  <td>
                    <a href="javascript:void(0);" id="web_owner" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="3" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('web_owner')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title">Email</td>
                  <td>
                    <a href="javascript:void(0);" id="email" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="4" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('email')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title"><?=cclang("phone")?></td>
                  <td>
                    <a href="javascript:void(0)" id="telepon" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="5" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('telepon')?></a>
                  </td>
                </tr>

                <tr>
                  <td class="table-title"><?=cclang("address")?></td>
                  <td>
                    <a href="javascript:void(0)" id="address" data-url="<?=site_url("backend/setting/update_action")?>" data-type="textarea" data-rows="4"  data-pk="6" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('address')?></a>
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
            <div id="user_avatar_galery" scr="<?=base_url()?>_temp/uploads/logo/<?=setting("logo")?>"></div>
            <input name="user_avatar_uuid" id="user_avatar_uuid" type="hidden" value="<?= set_value('user_avatar_uuid'); ?>">
            <input name="user_avatar_name" id="user_avatar_name" type="hidden" value="<?= set_value('user_avatar_name'); ?>">
            <small class="info help-block">
              Format file PNG, JPEG. Size 350x100 pixel
            </small>
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
                  <a href="javascript:void(0);" id="facebook" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="8" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('facebook')?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><i class="ti-instagram cl-instagram"></i> Instagram</td>
                <td>
                  <a href="javascript:void(0);" id="instagram" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="9" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('instagram')?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><i class="ti-youtube cl-youtube"></i> Youtube</td>
                <td>
                  <a href="javascript:void(0);" id="youtube" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="10" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('youtube')?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><i class="ti-twitter cl-twitter"></i> Twitter</td>
                <td>
                  <a href="javascript:void(0);" id="twitter" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="11" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('twitter')?></a>
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
                  <a href="javascript:void(0);" id="time_zone" data-url="<?=site_url("backend/setting/update_action")?>" data-type="select" data-value="<?=$this->config->item("time_zone")?>" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("time_zone")?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">Encryption Key</td>
                <td>
                  <a href="javascript:void(0);" id="encryption_key" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("encryption_key")?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">Encryption Url</td>
                <td>
                  <a href="javascript:void(0);" id="encryption_url" data-url="<?=site_url("backend/setting/update_action")?>" data-type="select" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("encryption_url") == 1 ? "Y":"N"?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title">url_suffix</td>
                <td>
                  <a href="javascript:void(0);" id="url_suffix" data-url="<?=site_url("backend/setting/update_action")?>" data-type="text" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("url_suffix")?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><?=cclang("language")?></td>
                <td>
                  <a href="javascript:void(0);" id="language" data-url="<?=site_url("backend/setting/update_action")?>" data-type="select" data-value="<?=$this->config->item("language")?>" data-pk="999" class="editable editable-click" title="<?=cclang("update")?>"><?=$this->config->item("language")?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><?=cclang("user_log_activity")?></td>
                <td>
                  <a href="javascript:void(0);" id="user_log_status" data-url="<?=site_url("backend/setting/update_action")?>" data-type="select" data-value="<?=setting('user_log_status')?>" data-pk="13" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('user_log_status')?></a>
                </td>
              </tr>

              <tr>
                <td class="table-title"><?=cclang("maintenance")?></td>
                <td>
                  <a href="javascript:void(0);" id="maintenance_status" data-url="<?=site_url("backend/setting/update_action")?>" data-type="select" data-value="<?=setting('maintenance_status')?>" data-pk="12" class="editable editable-click" title="<?=cclang("update")?>"><?=setting('maintenance_status')?></a>
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


  $('#user_avatar_galery').fineUploader({
        template: 'qq-template-gallery',
        dataType:'json',
        request: {
            endpoint: '<?=base_url()?>backend/setting/file_upload'
        },
        thumbnails: {
            placeholders: {
                waitingPath: '<?=base_url()?>_temp/backend/vendors/fine-upload/placeholders/waiting-generic.png',
                notAvailablePath: '<?=base_url()?>_temp/backend/vendors/fine-upload/placeholders/not_available-generic.png'
            }
        },
        session: {
             endpoint: '<?=base_url()?>backend/setting/get_avatar',
             refreshOnRequest: true
         },
        multiple: false,
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'png']
        },
        showMessage: function(json) {
            console.log(json);
            $.toast({
              text: json,
              showHideTransition: 'slide',
              icon: 'error',
              loaderBg: '#f96868',
              position: 'bottom-right'
            });
        },
        callbacks: {
            onComplete: function(id, fileName, response, xhr) {
                $.toast({
                  text: response.alert,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'bottom-right'
                });
            }
        }
    }); /*end image galey*/


});
</script>
