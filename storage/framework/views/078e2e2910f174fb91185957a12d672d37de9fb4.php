<?php $__env->startSection('title','Academic'); ?>
<?php $__env->startSection('content'); ?>

<div class="pg-yallow-color">
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
            <div class="container">
                <div class="row">
                    <div class="col-12 d-sm-none d-md-none d-xs-block"><span class="mob-pg-heading">Academic</span>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="shot-contnts btn-group">
                            <button type="button" id="cbtn1" class="btn btn-light active <?=$act1?>"><span class="flt-txt">By
                                    Fillter</span><svg class="filter-i" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path d="M23 0l-8.412 15h-5.215l-8.373-15h22zm-13 17v7h4v-7h-4z" />
                                </svg></button>
                            <button type="button" id="cbtn2" class="btn btn-light  <?=$act2?>"><span
                                    class="flt-txt">By Search</span><svg class="serach-i"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M9.145 18.29c-5.042 0-9.145-4.102-9.145-9.145s4.103-9.145 9.145-9.145 9.145 4.103 9.145 9.145-4.102 9.145-9.145 9.145zm0-15.167c-3.321 0-6.022 2.702-6.022 6.022s2.702 6.022 6.022 6.022 6.023-2.702 6.023-6.022-2.702-6.022-6.023-6.022zm9.263 12.443c-.817 1.176-1.852 2.188-3.046 2.981l5.452 5.453 3.014-3.013-5.42-5.421z" />
                                </svg></button>
                        </div>

                        <!--<div class="shot-contnts btn-group">
                                <button type="button" class="btn btn-secondary active"><span class="flt-txt">By Fillter</span><svg class="filter-i" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23 0l-8.412 15h-5.215l-8.373-15h22zm-13 17v7h4v-7h-4z"/></svg></button>
                                <button type="button" class="btn btn-secondary"><span class="flt-txt">By Search</span><svg class="serach-i" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9.145 18.29c-5.042 0-9.145-4.102-9.145-9.145s4.103-9.145 9.145-9.145 9.145 4.103 9.145 9.145-4.102 9.145-9.145 9.145zm0-15.167c-3.321 0-6.022 2.702-6.022 6.022s2.702 6.022 6.022 6.022 6.023-2.702 6.023-6.022-2.702-6.022-6.023-6.022zm9.263 12.443c-.817 1.176-1.852 2.188-3.046 2.981l5.452 5.453 3.014-3.013-5.42-5.421z"/></svg></button>
                            </div>-->

                    </div>
                    <div class="col-12 col-md-9">
                        <div id="chpter_from_div" class="academic-filtr overlay" style="<?=$sty1?>">
                            <form class="fltr-frm form-inline" method="get" name="chpter_from" id="chpter_from"
                                action="<?php echo e(route('academic')); ?>">
                                <select class="form-control" name="aclass" id="id_class0"
                                    onchange="getsubjects(0,this.value)">
                                    <option value="">All Classes</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cls): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                     if(!empty($_REQUEST['aclass']) && $_REQUEST['aclass']==$cls->id){
                                       $stselect='selected';
                                     }else{
                                       $stselect='';
                                     }
                                 ?>
                                    <option value="<?php echo e($cls->id); ?>" <?=$stselect?>><?php echo e($cls->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <select class="form-control" id="id_subject0" name="subject"
                                    onchange="getchapters(0,this.value)">
                                    <option value="">Select Subjects</option>
                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sbj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
									 if(!empty($_REQUEST['subject'])&& $_REQUEST['subject']==$sbj->id){
									   $subs='selected';
									 }else{
									   $subs='';
									 }
                                  ?>
                                    <option value="<?php echo e($sbj->id); ?>" <?=$subs?>><?php echo e($sbj->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <button type="submit" name="searchdata" id="chpter_fillter" value="searchdata"
                                    class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Go</button>
                            </form>
                        </div>
                        <div id="chpter_search_div" class="academic-srch overlay" style="<?=$sty2?>">
                            <form class="fltr-frm form-inline" type="get" name="chpter_from_search"
                                id="chpter_from_search" action="<?php echo e(route('academic')); ?>">
                                <input type="text" class="form-control" name="chpter_name" id="chpter_name"
                                    placeholder="Chapter Name..">
                                <button type="submit" name="search" id="chpter_search" value="Search"
                                    class="btn btn-primary search-btn"><svg class="search-icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M21.172 24l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z" />
                                    </svg></button>
                            </form>
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
                    <h1>All Chapters</h1>
                    <h2 class="show-rslt"> (Total Found <strong><?php echo e($count); ?></strong>)</h2>
                    <!--<?php if($count>0): ?>
                    <a class="more-chptr" href="#a">Show more<svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path d="M21 12l-18 12v-24z" />
                        </svg></a>
                    <?php endif; ?>-->
                </div>
            </div>
        </div>
		
        <div class="row">
			
           
			
			<?php if(!empty($cl6hindi)): ?>
            <?php $__currentLoopData = $cl6hindi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			
			<?php elseif(!empty($cl6eng)): ?>
            <?php $__currentLoopData = $cl6eng; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($cl6math)): ?>
            <?php $__currentLoopData = $cl6math; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?> ,<?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			
			<?php elseif(!empty($cl6sc)): ?>
            <?php $__currentLoopData = $cl6sc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			
			<?php elseif(!empty($cl6sst)): ?>
            <?php $__currentLoopData = $cl6sst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($cl7hindi)): ?>
            <?php $__currentLoopData = $cl7hindi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($cl7eng)): ?>
            <?php $__currentLoopData = $cl7eng; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($cl7sc)): ?>
            <?php $__currentLoopData = $cl7sc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			
			<?php elseif(!empty($cl7sst)): ?>
            <?php $__currentLoopData = $cl7sst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($cl7math)): ?>
            <?php $__currentLoopData = $cl7math; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			
			<?php elseif(!empty($cl8hindi)): ?>
            <?php $__currentLoopData = $cl8hindi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($cl8eng)): ?>
            <?php $__currentLoopData = $cl8eng; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($cl8math)): ?>
            <?php $__currentLoopData = $cl8math; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($cl8sc)): ?>
            <?php $__currentLoopData = $cl8sc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			
			<?php elseif(!empty($cl8sst)): ?>
            <?php $__currentLoopData = $cl8sst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php elseif(!empty($chapter)): ?>
			<?php $__currentLoopData = $chapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 				
				  $con_result = DB::table('concept')->where('chapter_id', $act->id)->get();
				  $total = DB::table('concept')->where('chapter_id', $act->id)->count();
				$class = DB::table('class')->select('class.name')->where('class.id', $act->class_id)->first();
				
				$subject = DB::table('subject')->select('subject.name')->where('subject.id', $act->subject_id)->first();				  
				?>
				
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card chapter-bx">
                    <a href="<?php echo e(url('concepts/'.$act->id)); ?>"></a>
                    <?php if($act->image!=''){ ?>
                    <figure class="thumb-card"><img width="307" height="207" src="<?php echo e($act->image); ?>"
                            class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                            alt="Card image cap"></figure>
                    <?php } else{ ?>
                    <figure class="thumb-card"><img class="card-img-top"
                            src="<?php echo e(asset('resources/images').'/'.'default-chapter-img.png'); ?>" alt="Card image cap">
                    </figure>
                    <?php }  ?>
                    <div class="card-body">
                        <span class="no-concents"><?php echo e($total); ?> Concepts </span>
						<div class="class-sub"><?php echo e($class->name); ?>, <?php echo e($subject->name); ?></div>
                        <h3><?php echo e(($act->name)); ?></h3>
                    </div>

                </div>
				
            </div>
			
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			<div class="d-flex justify-content-center"><?php echo e($chapter->appends(request()->input())->links()); ?></div>

			<?php else: ?>
           <div class="col-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                
                    <div class="pg-not-found pt-3 pl-2 pb-4 pr-5 mt-4 mb-4">

                        <figure class="pt-3"><img src="<?php echo e(asset('resources/images/no-data-found.png')); ?>"
                                class="card-img-top attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                alt="No data found"> </figure>
                        <div class="nofound-txt">
                            <h1>404</h1>
                            <h2>No Activity Data Found...!</h2>
                            <p>Oops! The page you are looking for could not be found.</p>
                            <a href="<?php echo e(url('sport')); ?>" class="btn btn-primary"><svg class="bck-arw"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                </svg>Back to Home</a>
                        </div>
                    </div>
                
                <!--<span class=""> No Activity Data Found ...!</span> -->

            </div>
			<?php endif; ?>
           
        </div>
       
    </div>
</div>
<script type="text/javascript">
$(function() {
    $('#cbtn1').on('click', function() {
        //alert('aaaa'); chpter_search_div  
        $('#chpter_from_div').show();
        $('#chpter_search_div').hide();
        $(this).siblings().removeClass('active')
        $(this).addClass('active');
    });

    $('#cbtn2').on('click', function() {
        // alert('bbbb'); 	
        $('#chpter_search_div').show();
        $('#chpter_from_div').hide();
        $(this).siblings().removeClass('active')
        $(this).addClass('active');
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/nep/resources/views/academic.blade.php ENDPATH**/ ?>