
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<?php echo $__env->yieldPushContent('scripts'); ?>
<script type="text/javascript">

function getskillarea(i, val) 
{
    //val = parseInt(val);
    var nameArr = val.split('-');
    var customIDCLS = nameArr[0];
    var clsid       = nameArr[1];

    $("#custm_cls_id").val(customIDCLS);

    //alert(val);
    jQuery.ajax({
        url: "<?php echo e(route('get_skillarea')); ?>",
        data: {
            "class_id": clsid,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: "GET",
        success: function(response) {
            jQuery('#skillarea' + i).html(response);
        }
    });


}

function getskillsports(i, val)
{
    val = parseInt(val);
    var class_id = jQuery('#sclass' + i).val();


    jQuery.ajax({
        url: "<?php echo e(route('get_skillsports')); ?>",
        data: {
            "skillarea_id": val,
            "class_id": class_id,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: "GET",
        success: function(response) {
            jQuery('#skillsports' + i).html(response);
        }
    });
}


function gettechnique(i, val) 
{
    val = parseInt(val);
    var class_id = jQuery('#sclass' + i).val();
    var skillarea_id = jQuery('#skillarea' + i).val();

    jQuery.ajax({
        url: "<?php echo e(route('get_technique')); ?>",
        data: {
            "sports_id": val,
            "skillarea_id": skillarea_id,
            "class_id": class_id,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: 'GET',
        success: function(response) {
            jQuery('#technique' + i).html(response);
        }
    });
}


function getclasses(i, val) 
{

    val = parseInt(val);


    jQuery.ajax({
        url: "<?php echo e(route('testdata')); ?>",
        data: {
            "school_id": val,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: "GET",
        success: function(response) {
            jQuery('#sclass' + i).html(response);
        }
    });


}


function getactivity(i, val) 
{
    //alert();
    val = parseInt(val);
    var class_id     = jQuery('#sclass' + i).find(":selected").val();
    var skillarea_id = jQuery('#skillarea' + i).find(":selected").val();
    var sports_id    = jQuery('#skillsports' + i).find(":selected").val();
    var technique_id = jQuery('#technique' + i).find(":selected").val();


    jQuery.ajax({
        url: "<?php echo e(route('get_activity')); ?>",
        data: {
            "class_id": class_id,
            "skillarea_id": skillarea_id,
            "sports_id": sports_id,
            "technique_id": technique_id,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: 'GET',
        success: function(response) {
            
            jQuery('#activity_id').html(response);
        }
    });
}


function getstudents(i, val) 
{
    //alert();
    val = parseInt(val);
    var custm_cls_id     = jQuery('#custm_cls_id').val();
    var class_id     = jQuery('#sclass' + i).find(":selected").val();
    var school_id        = jQuery('#school_id').val();

    jQuery.ajax({
        url: "<?php echo e(route('get_students')); ?>",
        data: {
            "custm_cls_id": custm_cls_id,
            "class_id": class_id,
            "school_id": school_id,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: 'GET',
        success: function(response) {
           // var data = JSON.parse(response.result);
            $.each(response.result, function(key,val){
             //jQuery('#student_id').html(response);
             jQuery('#student_id').append('<option value="'+val.id+'">'+val.student_name+'</option>');

             //jQuery('#std_tbl_id').append('');

             jQuery('#std_tbl_id').append(' <tr><th><input type="hidden" id="std_idd-'+val.id+'" name="std_idd-'+val.id+'">'+val.student_name+'</th><th><select class="form-control mx-0 w-100" name="level-'+val.id+'" id="level_id-'+val.id+'"><option value="1">Absent</option><option value="2">Learning</option><option value="3">Progressing</option><option value="4">Desired</option><option value="5">Proficient</option><option value="6">Exemplary</option></select></th></tr>');

             //jQuery('#std_tbl_id').append('');

             //jQuery('#std_tbl_id').append('');




         });
            //jQuery('#activity_id').html(response);
        }
    });
}

function getsubjects(i, val) 
{
    val = parseInt(val);

    jQuery.ajax({
        url: "<?php echo e(route('gets_subject')); ?>",
        data: {
            "class_id": val,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: 'GET',
        success: function(response) {
            // 
            jQuery('#id_subject' + i).html(response);
        }
    });

}

function getchapters(i, val) 
{
    val = parseInt(val);
    var class_id = jQuery('#id_class' + i).val();

    jQuery.ajax({
        url: "<?php echo e(route('get_chapters')); ?>",
        data: {
            "subject_id": val,
            "class_id": class_id,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: 'GET',
        success: function(response) {
            //
            jQuery('#id_chapter' + i).html(response);
        }
    });

}


function getconcepts(i, val) {
    val = parseInt(val);
    var class_id = jQuery('#id_class' + i).val();
    var subject_id = jQuery('#id_subject' + i).val();

    jQuery.ajax({
        url: "<?php echo e(route('get_concepts')); ?>",
        data: {
            "subject_id": subject_id,
            "class_id": class_id,
            "chapter_id": val,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: 'GET',
        success: function(response) {
            // 
            jQuery('#id_concept' + i).html(response);
        }
    });

}

function submitLoader(){
    Swal.fire({
        title: 'Loading',
        text: 'Please wait...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function getskillarea(i, val) 
    {


        //val = parseInt(val);
        var nameArr = val.split('-');
        if(nameArr.length>1)
        {
        var customIDCLS = nameArr[0];
        var clsid       = nameArr[1];
        $("#custm_cls_id").val(customIDCLS); 
        }
        else
        {
        var  clsid = val;
        }
        
        jQuery.ajax({
            url: "<?php echo e(route('get_skillarea')); ?>",
            data: 
            {
                "class_id": clsid,
                "_token": "<?php echo e(csrf_token()); ?>"
            },
            type: "GET",
            success: function(response) 
            {
                jQuery('#skillarea' + i).html(response);
                //jQuery('#skillarea' + i).html('');
            }
        });


    }

    function getskillsports(i, val)
    {
        val           = parseInt(val);
        var class_id  = jQuery('#sclass' + i).val();
        var school_id = $("#school_id").val();
        
        $("#technique"+i).empty();
        $('#activity_id').empty();

        jQuery.ajax({
            url: "<?php echo e(route('get_skillsports')); ?>",
            data: 
            {
                "skillarea_id": val,
                "class_id": class_id,
                "school_id": school_id,
                "_token": "<?php echo e(csrf_token()); ?>"
            },
            type: "GET",
            success: function(response) {
                //
                jQuery('#skillsports' + i).html(response);
            }
        });
    }


    function gettechnique(i, val) 
    {
        jQuery('#std_tbl_id').empty();
        val = parseInt(val);
        var class_id = jQuery('#sclass' + i).val();
        var skillarea_id = jQuery('#skillarea' + i).val();
        
        
        //$("#skillsports"+i).empty();
        $("#technique"+i).empty();
        //$('#std_tbl_id').empty();
        $('#activity_id').empty();

        jQuery.ajax({
            url: "<?php echo e(route('get_technique')); ?>",
            data: {
                "sports_id": val,
                "skillarea_id": skillarea_id,
                "class_id": class_id,
                "_token": "<?php echo e(csrf_token()); ?>"
            },
            type: 'GET',
            success: function(response) {
                
                //
                $("#anchor-id").hide();
                jQuery('#technique' + i).html(response);
            }
        });
    }


    function getclasses(i, val) 
    {

        val = parseInt(val);
        //alert();

        jQuery.ajax({
            url: "<?php echo e(route('testdata')); ?>",
            data: {
                "school_id": val,
                "_token": "<?php echo e(csrf_token()); ?>"
            },
            type: "GET",
            success: function(response) {
                //
                jQuery('#sclass' + i).html(response);
            }
        });


    }


    function getactivity(i, val) 
    {
        
        //$("#skillsports"+i).empty();
        //$("#technique"+i).empty();
        //$('#std_tbl_id').empty();
        $('#activity_id').empty();

        val = parseInt(val);
        var class_id     = jQuery('#sclass' + i).find(":selected").val();
        var skillarea_id = jQuery('#skillarea' + i).find(":selected").val();
        var sports_id    = jQuery('#skillsports' + i).find(":selected").val();
        var technique_id = jQuery('#technique' + i).find(":selected").val();

        //alert("class_id---"+class_id+"---"+"skillarea_id--"+skillarea_id+"----"+"sports_id---"+sports_id+"----"+technique_id);

        jQuery.ajax({
            url: "<?php echo e(route('get_activity')); ?>",
            data: {
                "class_id": class_id,
                "skillarea_id": skillarea_id,
                "sports_id": sports_id,
                "technique_id": technique_id,
                "_token": "<?php echo e(csrf_token()); ?>"
            },
            type: 'GET',
            success: function(response) {
                $("#anchor-id").hide();
                jQuery('#activity_id').html(response);
            }
        });
    }


    function getstudents(i, val) 
    {
        $("#anchor-id").hide();
        jQuery('#std_tbl_id').empty();
        val = parseInt(val);
        var custm_cls_id = jQuery('#custm_cls_id').val();
        var class_id     = jQuery('#sclass' + i).find(":selected").val();
        var school_id    = jQuery('#school_id').val();
        var sports_id    = jQuery('#skillsports' + i).find(":selected").val();
        var skillarea_id = jQuery('#skillarea' + i).find(":selected").val();
        
        jQuery.ajax({
            url: "<?php echo e(route('get_students')); ?>",
            data: {
                "custm_cls_id": custm_cls_id,
                "class_id": class_id,
                "sports_id": sports_id,
                "school_id": school_id,
                "activity_id": val,
                "skillarea_id": skillarea_id,
                "_token": "<?php echo e(csrf_token()); ?>"
            },
            type: 'GET',
            success: function(response) 
            {
                
                //alert('---every day one more step to take--	');
                jQuery('#std_tbl_id').empty();
                
                
                if(response.result.length > 0){

                    $("#anchor-id").show();	
                    const submitButton = document.getElementById('activity_fillter_submit');
                    submitButton.disabled = false;

                }else{
                    alert("The student is not available for this mapping");
                    const submitButton = document.getElementById('activity_fillter_submit');
                    submitButton.disabled = true;
                }
                
                if ($('h3.list-heading').length === 0) {
                    // Insert heading only if it doesn't exist
                    $('#std_tbl_id').before('<h3 class="list-heading mb-4 mt-5">Name of Students</h3>');
                }
                
                
                $.each(response.result, function(key,val)
                {
                jQuery('#std_tbl_id').append('<li><input type="hidden" id="std_idd-'+val.id+'" name="std_idd[]" value="'+val.id+'"><label>'+ val.student_name + '</label><select class="form-control mx-0 w-100" name="level['+val.id+']" id="level_id-'+ val.id +'"><option value="1">L-1 Beginning</option><option value="2">L-2 Learning</option><option value="3" selected>L-3 Progressing</option> <option value="4">L-4 Developing</option><option value="5">L-5 Desired</option><option value="6">L-6 Proficient</option><option value="7">L-7 Exemplary</option><option value="0">Absent</option></select></li>');
                });
                
                /*
                $.each(response.result, function(key,val)
                {
                jQuery('#std_tbl_id').append('<li><input type="hidden" id="std_idd-'+val.id+'" name="std_idd[]" value="'+val.id+'"><label>'+val.student_name+'</label><select class="form-control mx-0 w-100" name="level['+val.id+']" id="level_id-'+val.id+'"><option value="1">Learning</option><option value="2">Progressing</option><option value="3" selected>Desired</option><option value="4">Proficient</option><option value="5">Exemplary</option><option value="0">Absent</option></select></li>');
                });
                */
                
                $("#model-title-id").html(response.getActivity.title);
                $("#model-description-id").html(response.getActivity.description);
                $("#modal-image-id").html(response.activityImg);
                $("#learning_outcomes_id").html(response.getActivity.learning_outcomes);
                $("#change_it_id").html(response.getActivity.change_it);
                $("#coaching_id").html(response.getActivity.coaching);
                $("#equipment_id").html(response.getActivity.equipment);
                
                if($("#learning_outcomes_id").text().length == 0 && $("#model-title-id").text().length == 0)
                { 
                    $("#anchor-id").hide();
                }else
                {
                    $("#anchor-id").show();		
                }
                
                
            }
        });
    }



    function getViewDartStudent(i, val) 
    {

        var nameArr = val.split('-');
        var customIDCLS = nameArr[0];
        var clsid       = nameArr[1];
        var view_school_id     = jQuery('#view_school_id').val();
    
        jQuery.ajax({
        url: "<?php echo e(route('view.dart.class')); ?>",
        data: {
            "custm_cls_id": customIDCLS,
            "class_id": clsid,
            "school_id": view_school_id,
            "_token": "<?php echo e(csrf_token()); ?>"
        },
        type: 'GET',
            success: function(response) 
            {
                
                jQuery('#view_student_dart_id').show();
                jQuery('#classwise_data_id').empty();
                //        
                $.each(response.result, function(key,val)
                {
                    var sno = key+1;
                    var pathreport = "<?php echo e(route('students.report')); ?>?sid="+val.id;
                    jQuery('#classwise_data_id').append('<tr><th scope="row">'+sno+'</th><td>'+val.student_name+'</td><td><a href="'+pathreport+'" target="_blank" class="btn btn-primary">View</a>&nbsp;&nbsp;</td></tr>');

                });
                
            }
        });

    }

    function getFillDARTskillarea(i, val) 
    {


        $("#skillarea"+i).empty();
        $("#skillsports"+i).empty();
        $("#technique"+i).empty();
        $('#std_tbl_id').empty();
        $('#activity_id').empty();

        var school_id = $("#school_id").val();
        var period_id = val;
        var date_id = $("#date").val();
        var sclass = $("#sclass"+i).val();     
        
        var nameArr = sclass.split('-');
        if(nameArr.length>1)
        {
        var customIDCLS = nameArr[0];
        var clsid       = nameArr[1];
        $("#custm_cls_id").val(customIDCLS); 
        }
        else
        {
        var  clsid = sclass;
        var  customIDCLS = 0;
        }
        
        jQuery.ajax({
            url: "<?php echo e(route('getFillDARTSkillArea')); ?>",
            data: 
            {
                "school_id": school_id,
                "date_id"  : date_id,
                "class_id" : clsid,
                "period_id" : period_id,
                "custom_class_id": customIDCLS,
                "_token": "<?php echo e(csrf_token()); ?>"
            },
            type: "GET",
            success: function(response) 
            { 
                if(response.alreadyexist)
                {
                    jQuery('#skillarea' + i).html(response.skillarea);
                    jQuery('#period_id').val(response.result[0].period);
                    jQuery('#skillarea' + i).val(response.result[0].skill_area_id);
                    getskillsports(0, response.result[0].skill_area_id);
                    gettechnique(0,response.result[0].skill_sports_id);
                
                    setTimeout(() => 
                    {
                    jQuery('#skillsports' + i).val(response.result[0].skill_sports_id);
                    jQuery('#technique' + i).val(response.result[0].technique_id);
                    getactivity(0, response.result[0].technique_id);
                    jQuery('#activity_id').val(response.result[0].activity_id);
                    }, "2000");

                    setTimeout(() => 
                    {
                    jQuery('#activity_id').val(response.result[0].activity_id);
                    getstudents(0,response.result[0].activity_id)
                    }, "4000");

                    setTimeout(() => 
                    {
                        $.each(response.result, function(key,val)
                        {

                        $("#level_id-"+val.student_id).val(val.level);
                        });
                
                    }, "5000");
                
                }else
                {
                    jQuery('#skillarea' + i).html(response.skillarea);
                }
                
            }
        });
    }

    function showMessages($icon, $title, $message) {
            Swal.fire({
                icon: $icon,
                title: $title,
                text: $message,
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        }


        function handleResponseMessages(icon, title, message, options = {}) {

            let config = {
                icon: icon,
                title: title,
                text: message,
                allowOutsideClick: false,
                allowEscapeKey: false,
                
                showConfirmButton: true,
                confirmButtonText: options.confirmText || 'OK',
                
                showCancelButton: options.showCancel || false,
                cancelButtonText: options.cancelText || 'Cancel',

            };

            if (options.showCancel) {
                config.showCancelButton = true;
                config.cancelButtonText = options.cancelText || 'Cancel';
            }


            if (options.timer) {
                config.timer = options.timer;
                config.showConfirmButton = false;
            }

            return Swal.fire(config).then((result) => {
                if (result.isConfirmed && typeof options.onConfirm === 'function') {
                    options.onConfirm();
                }
                if (result.dismiss === Swal.DismissReason.cancel && typeof options.onCancel === 'function') {
                    options.onCancel();
                }
            });
        }
</script><?php /**PATH C:\xampp\htdocs\nep\resources\views/layouts/footer.blade.php ENDPATH**/ ?>