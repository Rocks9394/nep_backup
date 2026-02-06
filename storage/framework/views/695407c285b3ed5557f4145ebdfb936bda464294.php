
<?php $__env->startSection('title', 'Goforfit Admin Activity'); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<h1 class="act-header">Activity</h1>					
					 <a href="<?php echo e(route('admin.activities.create')); ?>" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
				</div>
				<div class="col-md-10">
					<div class="act-filter-bar">
					<span class="ftr-academy flt-txt <?php if(!empty($_REQUEST['filterby'])){ if($_REQUEST['filterby'] == 'academy'){ echo 'active'; } }else{ echo 'active'; } ?> " id="btn-academy" onclick="getfilter('academy')">For Academy</span> 
					<span class="ftr-sports flt-txt <?php if(!empty($_REQUEST['filterby']) && $_REQUEST['filterby'] == 'sports'){ echo 'active'; } ?>" id="btn-sports" onclick="getfilter('sports')">For Sports</span>
					</div>
				</div>
			</div>
		</div>
    </section>
	
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
 <section class="content">
  <div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
      <div class="card">        
		<div class="card-header filter-head">  
		  <div class="row"> 
			<div class="col-md-12">
				<form class="form-inline fltr-row " type="get" action="<?php echo e(route('admin.activities.index')); ?>">				
					<input type="hidden" id="filterbyelem" name="filterby" value="<?php if(!empty($_GET['filterby'])){ echo $_GET['filterby']; }else{ echo 'academy'; }?>"/>
						<?php
						
							$aclasses ='<option value="">Class</option>';
							$sclasses ='<option value="">Class</option>';
							if(!empty($classes)){								
								foreach($classes as $cls){	
									$aclasses.= '<option value="'.$cls->id.'" ';
									if(!empty($_GET['aclass'])){
										if($cls->id == $_GET['aclass']){ $aclasses.= ' selected'; $aclsname = $cls->name; }
									} 
									$aclasses.= ' >'.$cls->name.'</option>';
									
									
									$sclasses.= '<option value="'.$cls->id.'" ';
									if(!empty($_GET['sclass'])){
										if($cls->id == $_GET['sclass']){ $sclasses.= ' selected'; $sclsname = $cls->name; }
									}
									$sclasses.= ' >'.$cls->name.'</option>';
									
								} 
							}
							
							$asubjects ='<option value="">Subject</option>';
							if(!empty($subjects)){								
								foreach($subjects as $cls){	
									$asubjects.= '<option value="'.$cls->id.'" ';
									if(!empty($_GET['subject'])){
										if($cls->id == $_GET['subject']){ $asubjects.= ' selected'; $asubjectname = $cls->name; }
									} 
									$asubjects.= ' >'.$cls->name.'</option>'; 								
								} 
							}
				 
				 
							$askillarea='<option value="">Skill Area</option>';
							if(!empty($skillareas)){								
								foreach($skillareas as $skillarea){	
									$askillarea.= '<option value="'.$skillarea->id.'" ';
									if(!empty($_GET['skillarea'])){
										if($skillarea->id == $_GET['skillarea']){ $askillarea.= ' selected'; $askillareaname = $skillarea->name; }
									}
									$askillarea.= ' >'.$skillarea->name.'</option>'; 								
								} 
							}
							
							$asportskills='<option value="">Skill/Sports</option>';
							if(!empty($sportskills)){								
								foreach($sportskills as $sportskill){	
									$asportskills.= '<option value="'.$sportskill->id.'" ';
									if(!empty($_GET['skillsports'])){
										if($sportskill->id == $_GET['skillsports']){ $asportskills.= ' selected'; $asportskillname= $sportskill->name;}
									}
									$asportskills.= '>'.$sportskill->name.'</option>'; 								
								} 
							}
							
							$atechniques='<option value="">Technique</option>';
							if(!empty($techniques)){								
								foreach($techniques as $technique){	
									$atechniques.= '<option value="'.$technique->id.'" ';
									if(!empty($_GET['technique'])){
										if($technique->id == $_GET['technique']){ $atechniques.= ' selected'; $atechniquename = $technique->name;}
									}
									$atechniques.=' >'.$technique->name.'</option>'; 								
								} 
							}
							?>
							
					<div class="fltr-drdwn form-group" id="fltr-academy" <?php if(!empty($_REQUEST['filterby']) && $_REQUEST['filterby'] == 'sports'){  echo 'style="display:none"';  } ?> >
						
						
						<select class="form-control selctopt" name="aclass" id="id_class0" onchange="getsubjects(0,this.value)" style="width:125px">
							<?=$aclasses?>
						</select>
						
	 
						<select class="form-control selctopt" id="id_subject0" name="subject" onchange="getchapters(0,this.value)" style="width:138px">
							<?=$asubjects?>
						</select>
						


						<select class="form-control selctopt" id="id_chapter0" name="chapter" onchange="getconcepts(0,this.value)" style="width:140px">
							<option value="">Chapter</option>
							<?php
							if(!empty( $_REQUEST['chapter'])){
								$actconcepts = DB::table('chapter')->where('id', $_REQUEST['chapter'])->first();
								echo '<option value="'.$actconcepts->id.'" selected>'.$actconcepts->name.'</option>';
								$achaptername = $actconcepts->name;
							}?>
						</select>
						
						<select class="form-control selctopt" name="concept" id="id_concept0" name="concept" style="width:145px">
							<option value="">Concept</option>
							<?php
							if(!empty( $_REQUEST['concept'])){
								$actconcepts = DB::table('concept')->where('id', $_REQUEST['concept'])->first();
								echo '<option value="'.$actconcepts->id.'" selected>'.$actconcepts->name.'</option>';
								$aconceptname = $actconcepts->name;
							}?>
						</select>
						
						
						<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"> <i class="fa fa-filter" aria-hidden="true"></i></button>  
					</div>

					

					<div class="fltr-drdwn form-group" id="fltr-sports" <?php if(empty($_REQUEST['filterby'])){ echo 'style="display:none"'; } ?> <?php if(!empty($_REQUEST['filterby']) && $_REQUEST['filterby'] == 'academy'){  echo 'style="display:none"';  } ?> >
						
						<?php if(!empty($classes)): ?> 
						  <select class="form-control selctopt" name="sclass" id="sclass0"  style="width:125px" onchange="getskillarea(0,this.value)">
							<?=$sclasses?>
						  </select>
						<?php endif; ?>	
	 
						<select class="form-control selctopt" id="skillarea0" name="skillarea" onchange="getskillsports(0,this.value)" style="width:125px">
							<?=$askillarea?>
						</select>
						
						<select class="form-control selctopt" id="skillsports0" name="skillsports" onchange="gettechnique(0,this.value)" style="width:145px"> 
							<?=$asportskills?>	
						</select>
						
						<select class="form-control selctopt" id="technique0" name="technique"  style="width:145px">
							<?=$atechniques?>	
						</select>
											 
						
						<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"> <i class="fa fa-filter" aria-hidden="true"></i></button>  
					</div>
					
				   
				   <?php if(!empty($_GET['activity_name'])){ $tname = $_GET['activity_name'];}else{ $tname='';  } ?> 
					
					<div class="fltr-srch form-group">                	 
							<input type="search" name="actname" value="<?=$tname?>" id="activity_name" class="form-control  fltr-txt-bx"  placeholder="Search Activity" width="180px">
							<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
					</div>
						
				 </form>			 
			<div class="fltr-keys">
			<?php 
					if(!empty($_GET['actname'])){
						echo 'Search by Activity: '.$_GET['actname'];
					}else if(!empty($_GET['filterby']) && $_GET['filterby'] == 'academy'){
						$filtervar = '';
						$filtervar .= 'Filter by:';
						$filtervar .= '<ul>';
							if(!empty($aclsname)){
								$filtervar .= '<li class="act-cls"><span>'.$aclsname.'</span> </li>'; 
							}
							if(!empty($asubjectname)){
								$filtervar .= '<li class="act-sub"> <span>'.$asubjectname.'</span></li>';
							}
							if(!empty($achaptername)){
								$filtervar .= '<li class="act-cptr"> Chapter: <span>'.$achaptername.'</span></li>';
							}
							if(!empty($aconceptname)){
								$filtervar .= '<li class="act-cont"> Concept: <span>'.$aconceptname.'</span></li>';
							}
						$filtervar .= '</ul>';
						
						echo $filtervar;
						
					}else if(!empty($_GET['filterby']) && $_GET['filterby'] == 'sports'){
						$filtervar = '';
						$filtervar .= 'Filter by: ';
						$filtervar .= '<ul>';
							if(!empty($sclsname)){
								$filtervar .= '<li class="act-cls"><span>'.$sclsname.'</span> </li>'; 
							}
							if(!empty($askillareaname)){
								$filtervar .= '<li class="act-sub"> <span>'.$askillareaname.'</span></li>';
							}
							if(!empty($asportskillname)){
								$filtervar .= '<li class="act-cptr"> Sports/Skills: <span>'.$asportskillname.'</span></li>';
							}
							if(!empty($atechniquename)){
								$filtervar .= '<li class="act-cont"> Technique: <span>'.$atechniquename.'</span></li>';
							}
						$filtervar .= '</ul>';
						
						echo $filtervar;
						
					}else{ }
					?>
					</div>
			</div>
		  </div>				
		</div>
		

		
		<div class="row"> 
			<div class="col-12 div-count">
				<div class="fltr-count">Activities Found: <span class="no-counts"><?php echo e($count); ?><span></div>
			</div>
        </div>		      
        
		
		
		<div class="card-body table-responsive p-0">              
			<table class="table table-striped projects table-grid grid-4">
				<thead>
					<tr class="thead-dark">
						<th scope="col">Image</th>
						<th scope="col">Title</th>
						<th scope="col">Teaching Through</th>                   
						<?php if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '4'): ?>	
						<th scope="col">Action</th>
						<?php endif; ?> 
					</tr>
				</thead>
            <tbody>
	        
            <?php if(!empty($posts)){
				
			 foreach($posts as $val){ 
			 ?>
			  
			  
			  <tr> 
					<td>
						 <?php  $word = "wp-content"; $mystring = $val->image;
						 if(strpos($mystring, $word)!== false){
						 ?>
						  <img src="<?php echo e(preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $val->image)); ?>" width="100" height="100"> 
						 <?php } else if (file_exists('public/uploads/'.$val->image)){ ?>
						  <img src="<?php echo e(asset('public/uploads').'/'.$val->image); ?>" alt="" width="100" height="100">              
						 <?php } else{ ?>        
						 <img src="<?php echo e(asset('public/uploads').'/'.'images.jpg'); ?>" width="100" height="100">
						 <?php }  ?>     
					</td> 
					
					<td><?php echo preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $val->title);?></td>
					
					<td>
						<?php
						   $var = explode(",",$val->teach_id);
						   foreach($teaching as $tch){                 
							 echo (in_array($tch->id, $var) ? ($tch->name == '' ? '' : '<span class="tag" >'.$tch->name . '</span>') : '');
						   } 
						?>         
					</td>
					<?php if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '4'): ?>					
				    <td>
					  <a class="btn btn-info btn-xs copy-btn pull-left" alt="Copy" title="Copy" href="<?php echo e(url('copy/'.$val->id)); ?>"> <i class="fa fa-copy"></i></a>
					  <a class="btn btn-info btn-xs edit-btn pull-left" title="Update" href="<?php echo e(route('admin.activities.edit',$val->id)); ?>"> <i class="fa fa-pencil-alt"></i></a>
					  <?php /* 
					   <form action="{{ route('admin.activities.destroy', $val->id) }}" class="pull-right" method="POST">
							  @csrf
							  @method('DELETE')
						   <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i></button> 
						 </form> */ ?>
						 
					 </td> 
					<?php endif; ?>

				<?php/* <?php if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '4'): ?> */?> 
					 
				<?php/* <?php endif; ?> */?> 
            </tr>
			
			  
			  
			<?php }
			  
			  } ?>
			  
          </tbody>
          </table>
		  
		  
		 
		  
		 <div class="d-flex justify-content-center"><?php echo e($posts->appends(request()->input())->links()); ?></div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </section>    
  
  
   
 </div> 
 
 <style>

 </style>
 
 <script>
 function getfilter(elem){
	
	if(elem == 'sports'){
		$('#filterbyelem').val("sports");
		$('#fltr-academy').hide();
		$('#fltr-sports').show();
		$('#btn-academy').toggleClass("active");
		$('#btn-sports').toggleClass("active");
		
	}else if(elem == 'academy'){
		$('#filterbyelem').val("academy");
		$('#fltr-academy').show();
		$('#fltr-sports').hide();
		$('#btn-academy').toggleClass("active");
		$('#btn-sports').toggleClass("active");
	}
	
 }
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/admin/activities/index.blade.php ENDPATH**/ ?>