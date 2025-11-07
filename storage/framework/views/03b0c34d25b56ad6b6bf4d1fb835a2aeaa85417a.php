<?php $__env->startSection('title', 'Goforfit'); ?>
<?php $__env->startSection('content'); ?>
<div class="pg-yallow-color">
<div class="container">
    <div class="fillter-rw navbar-expand-lg">
        <div id="fillter" class="" role="group" aria-label="Basic example">
            <?php
					if(!empty($_REQUEST['search']) && $_REQUEST['search']=='Search'){
					   $act2='active';
					   $sty2='display:block';
					 } else{
					   $act2='';
					   $sty2='display:none';
					 } 
						 
					 if(!empty($_REQUEST['searchdata']) && $_REQUEST['searchdata']=='searchdata'){
					   $act1='active';
					   $sty1='display:block';
					 } else{
					   $act1='';
					   $sty1='display:none';
					 }
					 
					 
					 if(empty($_REQUEST['search']) && empty($_REQUEST['searchdata'])){
						 
						$sty1='display:block';						 
					 }                    					 
				?>
           
            <div class="">
                <div class="row">
                    <div class="col-12 d-sm-none d-md-none d-xs-block"><span class="mob-pg-heading">Sports</span></div>
                    <div class="col-12 col-md-12 col-lg-2">
                        <div class="shot-contnts btn-group">
                            <button type="button" data-target="#activity_from_div" id="btn1" class="btn btn-light active <?=$act1?>"><span
                                    class="flt-txt">By Fillter</span><svg class="filter-i"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M23 0l-8.412 15h-5.215l-8.373-15h22zm-13 17v7h4v-7h-4z" />
                                </svg></button>
                            <button type="button" data-target="#activity_search_div" id="btn2" class="btn btn-light <?=$act2?>"><span
                                    class="flt-txt">By Search</span><svg class="serach-i"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M9.145 18.29c-5.042 0-9.145-4.102-9.145-9.145s4.103-9.145 9.145-9.145 9.145 4.103 9.145 9.145-4.102 9.145-9.145 9.145zm0-15.167c-3.321 0-6.022 2.702-6.022 6.022s2.702 6.022 6.022 6.022 6.023-2.702 6.023-6.022-2.702-6.022-6.023-6.022zm9.263 12.443c-.817 1.176-1.852 2.188-3.046 2.981l5.452 5.453 3.014-3.013-5.42-5.421z" />
                                </svg></button>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-10">

                        <div id="activity_from_div" class="sports-filtr overlay" style="<?=$sty1?>">
                            <form class="fltr-frm form-inline" type="get" name="activity_from"
                                id="activity_from_fillter" action="<?php echo e(route('sport')); ?>">
								
								 <?php
			$sclasses ='<option value="">Class</option>';
							if(!empty($classes)){								
								foreach($classes as $cls){	
									
									
									
									$sclasses.= '<option value="'.$cls->id.'" ';
									if(!empty($_GET['sclass'])){
										if($cls->id == $_GET['sclass']){ $sclasses.= ' selected'; $sclsname = $cls->name; }
									}
									$sclasses.= ' >'.$cls->name.'</option>';
									
								} 
							}
					$askillarea='<option value="">Skillarea</option>';					
					
					if(!empty($skillareas)){								
						foreach($skillareas as $skillarea){	
						
						   $kselect =(!empty($_REQUEST['skillarea']) &&($_REQUEST['skillarea']==$skillarea->id) ? 'selected="selected"' : ''); 
					
							$askillarea.= '<option value="'.$skillarea->id.'" '.$kselect.'>'.$skillarea->name.'</option>'; 								
						} 
					}
					
					$asportskills='<option value="">Skill/Sports</option>';
					if(!empty($sportskills)){								
						foreach($sportskills as $sportskill){
                            $spselect =(!empty($_REQUEST['skillsports']) &&($_REQUEST['skillsports']==$sportskill->id) ? 'selected="selected"' : ''); 							
							$asportskills.= '<option value="'.$sportskill->id.'" '.$spselect.'>'.$sportskill->name.'</option>'; 								
						} 
					}
					
					$atechniques='<option value="">Technique</option>';
					if(!empty($techniques)){								
						foreach($techniques as $technique){
                            $tselect =(!empty($_REQUEST['technique']) &&($_REQUEST['technique']==$technique->id) ? 'selected="selected"' : ''); 							
							$atechniques.= '<option value="'.$technique->id.'" '.$tselect.'>'.$technique->name.'</option>'; 								
						} 
					}
				?>				<?php if(!empty($classes)): ?> 
								 <select class="form-control selctopt" name="sclass" id="sclass0"   onchange="getskillarea(0,this.value)">
								<?=$sclasses?>
								</select>
                               <?php endif; ?>	

                                <select class="form-control selctopt" id="skillarea0" name="skillarea" onchange="getskillsports(0,this.value)" >
                                    <?=$askillarea?>
                                </select>

                                <select class="form-control selctopt" id="skillsports0" name="skillsports" onchange="gettechnique(0,this.value)">
                                    <?=$asportskills?>
                                </select>

                                <select class="form-control selctopt" id="technique0" name="technique">
                                    <?=$atechniques?>
                                </select>
                                <button type="submit" name="searchdata" id="activity_fillter" value="searchdata"
                                    class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Go</button>
                            </form>
                        </div>

                        <div id="activity_search_div" class="sports-srch overlay" style="<?=$sty2?>">
                            <form class="fltr-frm form-inline" type="get" name="activity_from_search"
                                id="activity_from_search" action="<?php echo e(route('sport')); ?>">
                                <input type="text" class="form-control"
                                    value="<?=!empty($_REQUEST['activity_name']) ? $_REQUEST['activity_name'] : '' ?>"
                                    name="activity_name" id="activity_name" placeholder="Activity Name..">
                                <button type="submit" name="search" id="activity_search" value="Search"
                                    class="btn btn-primary search-btn"><svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.172 24l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z"/></svg></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="container">
    <div class="all-chaptr-cards">
        <div class="row">
            <div class="col">
                <div class="heading-rw">
                    <h1><?php echo e($title); ?></h1>
                    <h2 class="show-rslt"> (Total Found <strong><?php echo e($count); ?></strong>)</h2>
                   
                </div>
            </div>
        </div>

        <div class="row">
            <?php if(count($posts)>0): ?>
            <?php if(!empty($posts)): ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('actconcepts/'.$act->id)); ?>"></a>
                    <?php				   
						 $word = "wp-content";
						 $mystring = $act->image;
										 
						 
						 if(strpos($mystring, $word)!== false){
						 ?>
                    <figure class="thumb-card"><img src="<?php echo e(preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $act->image)); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                    </figure>
                    <?php } else if (file_exists('public/uploads/'.$act->image)){ ?>
                    <figure class="thumb-card"><img src="<?php echo e(asset('public/uploads').'/'.$act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                    </figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img src="<?php echo e(asset('public/uploads').'/'.'images.jpg'); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
                    </figure>
                    <?php } ?>
                    <div class="card-body">
                        <span class="no-concents1"></span>
                        <h3><?php echo e(preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $act->title)); ?></h3>
                    </div>

                </div>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php else: ?>
            <div class="col-12 col-md-6 offset-md-3">
                
                    <div class="pg-not-found pt-3 pl-2 pb-4 pr-5 mt-4 mb-4">
						
                        <figure class="pt-3"><img src="<?php echo e(asset('resources/images/no-data-found.png')); ?>"
                                class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                alt="No data found"> </figure>
                        <div class="nofound-txt">
                            <h1>404</h1>
                            <h2>No Data Found...!</h2>
                            <p>Oops! The page you are looking for could not be found.</p>
                            <a href="<?php echo e(url('sport')); ?>" class="btn btn-primary"><svg class="bck-arw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>Back to Home</a>
                        </div>
                    </div>
                
                <!--<span class=""> No Activity Data Found ...!</span> -->

            </div>
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-center"><?php echo e($posts->onEachSide(1)->links()); ?></div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    $('#btn1').on('click', function() {
        //alert('aaaa');   
        $('#activity_from_div').show();
        $('#activity_search_div').hide();
        $(this).siblings().removeClass('active')
        $(this).addClass('active');
    });

    $('#btn2').on('click', function() {
        // alert('bbbb'); 	
        $('#activity_search_div').show();
        $('#activity_from_div').hide();
        $(this).siblings().removeClass('active')
        $(this).addClass('active');
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/nep/resources/views/sport.blade.php ENDPATH**/ ?>