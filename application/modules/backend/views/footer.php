</div>
<!-- content-wrapper ends -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Page rendered in <strong>{elapsed_time}</strong> seconds.<?=$this->config->item("author") ?> - <?=$this->config->item("version") ?> Copyright © <?=date("Y")?>. All rights reserved.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- modal -->
<div class="modal modal-top animated fadeInUp delay-30s" id="modalGue" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary  text-white">
				<h5 class="modal-title" id="modalTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalContent"></div>
		</div>
	</div>
</div>
<!-- end modal -->

<!-- js -->
<script src="<?=base_url()?>_temp/backend/js/off-canvas.js"></script>
<script src="<?=base_url()?>_temp/backend/js/hoverable-collapse.js"></script>
<script src="<?=base_url()?>_temp/backend/js/template.js"></script>
<script src="<?=base_url()?>_temp/backend/js/settings.js"></script>
<script src="<?=base_url()?>_temp/backend/js/todolist.js"></script>
<script src="<?=base_url()?>_temp/backend/js/clipboard.js"></script>
<script type="text/javascript">

 $(document).ready(function(){


   // upload single image
   $('.btn-remove-image').on('click',function(){
     $('.btn-remove-image').hide();
     $(".file-dir").val("");
     $(".file-name").val("");
     // $.ajax({
     //   url : BASE_URL +'backend/core/imageRemove',
     //   type:'POST',
     //   data:{'img': $(".file-name").val()},
     //   cache           : false,
     //   dataType        : 'JSON',
     //   success:function(data){
     //     if (data.success == true) {
     //       $('.btn-remove-image').hide();
     //       $(".file-dir").val("");
     //       $(".file-name").val("");
     //     }
     //   }
     // });
   });



   $('.file-upload-browse').on('click', function() {
     var file = $('.file-upload-default');
     file.trigger('click');
   });

   $('.file-upload-default').on('change', function() {
     $('.file-upload-browse').html(`<div class="spinner-border-custom spinner-border text-light" role="status"">
                                     <span class="sr-only">Loading...</span>
                                   </div>`);
      var file_data = $(".file-upload-default").prop("files")[0];
      var form_data = new FormData();
      form_data.append("file", file_data);
       $.ajax({
         url : BASE_URL +'backend/core/imageUpload',
         type: 'post',
         data: form_data,
         dataType: 'json',
         cache: false,
         contentType: false,
         processData: false,
         success:function(json)
         {
           $('.file-upload-browse').html("Select File");
           if (json.success!=true) {
             $(".file-dir").val("");
             $(".file-name").val("");
             $('.btn-remove-image').hide();
             showToast("error", json.msg);
           }else {
             if (json.select != false) {
               $(".file-dir").val(json.file_dir);
               $(".file-name").val(json.file_name);
               if ($(".file-name").val() != "") {
                 $('.btn-remove-image').show();
               }
             }
             console.log(json.msg);
           }
         }
       });
   });
 });


</script>

</body>

</html>
