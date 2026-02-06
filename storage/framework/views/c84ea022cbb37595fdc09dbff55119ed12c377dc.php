

<script src="<?php echo e(asset('admin/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);  
</script>
<script src="<?php echo e(asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!--<script src="<?php echo e(asset('admin/plugins/summernote/summernote-bs4.min.js')); ?>"></script> -->
<script src="<?php echo e(asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/inputmask/jquery.inputmask.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/bs-stepper/js/bs-stepper.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/dropzone/min/dropzone.min.js')); ?>"></script>

<!--<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> -->
<script src="<?php echo e(asset('admin/plugins/select2/js/select2.full.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script>
	

	function colned_data(rowId, picklist_name){

	  let lastRow = $(".row-wrapper:last"); 
    let selectedValues = {};

    lastRow.find("select").each(function () {
      let selectName = $(this).attr("name"); 
      let cleanName = selectName.replace(/\[\d+\]/, '');
      selectedValues[cleanName] = $(this).val();
    });

    console.log(selectedValues);


		jQuery.ajax({
			url: "<?php echo e(route('check_clone_data')); ?>",
			data: {  "rowId" : rowId, 'selectedValues':selectedValues,  "_token" : "<?php echo e(csrf_token()); ?>"} ,
			type: "GET",
			success: function(response) {
				jQuery('#' + response.picklist_name + rowId).html(response.picklist);
			}
		});
	}

	
	function getskillarea(i, val){
	val = parseInt(val);
	jQuery.ajax({
		url: "<?php echo e(route('get_skillarea')); ?>",
		data: {  "class_id" : val, "_token" : "<?php echo e(csrf_token()); ?>"} ,
		type: "GET",
		success: function(response) {
			//console.log(response);
			jQuery('#skillarea'+i).html(response);
		}
	});	
	}
	
	function getskillsports(i, val){
		val = parseInt(val);
		var class_id = jQuery('#sclass'+i).val();
		
	
	jQuery.ajax({
		url: "<?php echo e(route('get_skillsports')); ?>",
		data: { "skillarea_id" : val, "class_id" : class_id, "_token" : "<?php echo e(csrf_token()); ?>"} ,
		type: "GET",
		success: function(response) {
			console.log(response);
			jQuery('#skillsports'+i).html(response);
		}
	});	
	}
	
	
	function agetskillsports(i, val){
		val = parseInt(val);
		var class_id = jQuery('#skill_class'+i).val();
		
	
	jQuery.ajax({
		url: "<?php echo e(route('get_skillsports')); ?>",
		data: { "skillarea_id" : val, "class_id" : class_id, "_token" : "<?php echo e(csrf_token()); ?>"} ,
		type: "GET",
		success: function(response) {
			console.log(response);
			jQuery('#skillsports'+i).html(response);
		}
	});	
	}
	
	function gettechnique(i, val){
		val = parseInt(val);
		var class_id = jQuery('#sclass'+i).val();
		var skillarea_id = jQuery('#skillarea'+i).val();
		
		//console.log(i, val);
		 
		 jQuery.ajax({
			url : "<?php echo e(route('get_technique')); ?>",
			data: { "sports_id" : val,  "skillarea_id": skillarea_id,  "class_id":class_id, "_token" : "<?php echo e(csrf_token()); ?>"} ,
			type: 'GET',
			success: function(response) {
				
				jQuery('#technique'+i).html(response);
			}
		 });
	}
	function agettechnique(i, val){
		val = parseInt(val);
		var class_id = jQuery('#skill_class'+i).val();
		var skillarea_id = jQuery('#skillarea'+i).val();
		
		//console.log(i, val);
		 
		 jQuery.ajax({
			url : "<?php echo e(route('get_technique')); ?>",
			data: { "sports_id" : val,  "skillarea_id": skillarea_id,  "class_id":class_id, "_token" : "<?php echo e(csrf_token()); ?>"} ,
			type: 'GET',
			success: function(response) {
				console.log(response);
				jQuery('#technique'+i).html(response);
			}
		 });
	}
	
	


</script>

<script>
	function getsubjects(i, val){
		val = parseInt(val);
		
		jQuery.ajax({
					url: "<?php echo e(route('gets_subject')); ?>", 
					data: { "class_id" : val, "_token": "<?php echo e(csrf_token()); ?>"} ,
					type: 'GET',
					success: function(response){
					  // console.log(response);
					  jQuery('#id_subject'+i).html(response);
					}
		});
    
	}
	
	function getchapters(i, val){
		val = parseInt(val);
		var class_id = jQuery('#id_class'+i).val();
		//console.log('class', jQuery('#id_class'+i).val());
		
		jQuery.ajax({
					url: "<?php echo e(route('get_chapters')); ?>", 
					data: { "subject_id" : val, "class_id" : class_id, "_token": "<?php echo e(csrf_token()); ?>"} ,
					type: 'GET',
					success: function(response){
					  //console.log(response);
					  jQuery('#id_chapter'+i).html(response);
					}
		});
    
	}
	
	
	function getconcepts(i, val){
		val = parseInt(val);
		var class_id = jQuery('#id_class'+i).val();
		var subject_id = jQuery('#id_subject'+i).val();
		
		//console.log(i, val);
		jQuery.ajax({
					url: "<?php echo e(route('get_concepts')); ?>", 
					data: {  "subject_id" : subject_id, "class_id" : class_id, "chapter_id" : val, "_token": "<?php echo e(csrf_token()); ?>"} ,
					type: 'GET',
					success: function(response){
					 // console.log(response);
					  jQuery('#id_concept'+i).html(response);
					}
		});
    
	}
	
	$(function(){   
		$(".select2").select2()    
		$(".select2bs4").select2({
		  theme: "bootstrap4"
		});	
	});

/*
	 
	 $('#summernote').summernote()
	 $('#l-outcome').summernote()
	 $('#what-you-need').summernote()
	 $('#what-to-do').summernote()
	 $('#change-it').summernote()
	 $('#coaching').summernote()
	 $('#game-rules').summernote()
	 $('#equipment').summernote()
	 $('#playing-area').summernote()
	 $('#scoring').summernote()
	 $('#safety').summernote()
	 $('#ask_the_Players').summernote()
	 $('#assignments').summernote()
	 $('#projects').summernote()
	 //$('#learning_outcomes').summernote()
	// $('#description').summernote()
 */
 
	ClassicEditor.create( document.querySelector( '#learning_outcomes' ) );
	ClassicEditor.create( document.querySelector( '#description' ) );
	ClassicEditor.create( document.querySelector( '#variations' ) );
	ClassicEditor.create( document.querySelector( '#equipment' ) );
	ClassicEditor.create( document.querySelector( '#coaching' ) );
	
</script>
	

<script src="<?php echo e(asset('admin/dist/js/adminlte.js')); ?>"></script>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/admin/layouts/footer.blade.php ENDPATH**/ ?>