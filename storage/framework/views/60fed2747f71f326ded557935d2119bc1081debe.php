
<?php $__env->startSection('title', 'Goforfit - Concepts list'); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper" id="concept-main"> 

	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<h1 class="act-header">Concepts</h1>					
					 <a href="<?php echo e(route('admin.concepts.create')); ?>" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
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
							<?php if($errors->any()): ?>
								<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div><?php echo e($error); ?></div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
								</div>
							<?php endif; ?>

							<form class="form-inline fltr-row " type="get" action="<?php echo e(route('admin.concepts.index')); ?>">				
								
								<?php
									$aclasses ='<option value="">Select Class</option>';
									if(!empty($classes)){								
											foreach($classes as $cls){	
												$aclasses.= '<option value="'.$cls->id.'" ';
												if(!empty($_GET['aclass'])){
													if($cls->id == $_GET['aclass']){ $aclasses.= ' selected'; $aclsname = $cls->name; }
												} 
												$aclasses.= ' >'.$cls->name.'</option>';
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
									
									$achapters ='<option value="">Chapter</option>';
									if(!empty($chapters)){								
										foreach($chapters as $cls){	
											$achapters.= '<option value="'.$cls->id.'" ';
											if(!empty($_GET['chapter'])){
												if($cls->id == $_GET['chapter']){ $achapters.= ' selected'; $achaptername = $cls->name; }
											} 
											$achapters.= ' >'.$cls->name.'</option>'; 								
										} 
									}
									
									
								?>
								
								<div class="fltr-drdwn form-group" >
									<select class="form-control selctopt clsopt <?php $__errorArgs = ['aclass'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="aclass" id="id_class0" onchange="getsubjects(0,this.value)">
										<?=$aclasses?>
									</select>
									<select class="form-control selctopt" id="id_subject0" name="subject" onchange="getchapters(0,this.value)" style="width:140px">
										<?=$asubjects?>
									</select>
									
									<select class="form-control selctopt" id="id_chapter0" name="chapter" onchange="getconcepts(0,this.value)" style="width:140px">
									<?=$achapters?>
								</select>
						
									<button type="submit" name="search" value="searchdata" class="btn btn-primary btn-sm"> <i class="fa fa-filter" aria-hidden="true"></i></button>
								</div>

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  placeholder="Search Concept" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>
							
							
							<br>
							
						
							
							<div class="fltr-keys">
							<?php 
									if(!empty($_GET['name']) && $_GET['search']=='Search'){
										echo 'Search by: '.' <span class="search-txt">'.$_GET['name'].'</span>';
									}else if(!empty($_GET['search']) && $_GET['search']=='searchdata'){
										$filtervar = '';
										$filtervar .= 'Filter by:';
										$filtervar .= '<ul>';
											if(!empty($aclsname)){
												$filtervar .= '<li class="act-cls"><span>'.$aclsname.'</span> </li>'; 
											}
											if(!empty($asubjectname)){
												$filtervar .= '<li class="act-cls"><span>'.$asubjectname.'</span> </li>'; 
											}
											if(!empty($achaptername)){
												$filtervar .= '<li class="act-cls"><span>'.$achaptername.'</span> </li>'; 
											}
										$filtervar .= '</ul>';
										
										echo $filtervar;
										
									}else{ } ?>
							</div>
						</div>
					</div>				
				</div>
			
			
			
					<div class="col-md-12">
						<div class="row">
						
							<div class="col-md-8">
							<button class="btn btn-success btn-sm dwl" name="download" value="download"
							 onclick="window.location.href='concept_export?class=<?php echo e(request()->input('aclass')); ?>&subject=<?php echo e(request()->input('subject')); ?>&chapter=<?php echo e(request()->input('chapter')); ?>&search=search';" >
							<i class="fa fa-download"></i> Download</button>
							</div>
						

							<form action="<?php echo e(route('admin.updateconcept')); ?>" method="POST" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
               
								<div class="col-md-10">
									
									  <input type="file" name="file" required class="form-control" accept=".xlsx, .xls, .csv"/>
							          <button class="btn btn-primary btn-sm">Import Concept</button> 
								</div>
							
							</form>
					</div>
					</div>	
			
			
			
			
				<div class="row"> 
					<div class="col-12 div-count">
						<div class="fltr-count">Concept Found: <span class="no-counts"><?php echo e($count); ?><span></div>
					</div>
				</div>
			
				<div class="card-body table-responsive p-0">
					<table class="table table-striped projects table-grid grid-7">
						<thead>
							<tr class="thead-dark">
								<th scope="col">Image</th>
								<th scope="col">Class </th>
								<th scope="col">Subject </th>
								<th scope="col">Chapter</th>
								<th scope="col">Concept/Learning Objective</th>
								
								
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0; ?>
							<?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cls): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								
								<td>
									<?php if(Illuminate\Support\Str::contains( $cls->image,'storage/app/public/uploads')): ?>
										<img src="<?php echo e($cls->image); ?>" width="100" height="80">
									<?php elseif(!empty($cls->image)): ?>
										<img src="<?php echo e(asset('public/uploads').'/'.$cls->image); ?>" width="100" height="100">
									<?php else: ?>
										<img src="<?php echo e(asset('public/uploads').'/images.jpg'); ?>" width="100" height="100">
									<?php endif; ?>     
									
								</td>
								<td> <?php echo e($cls->clsname); ?> </td>
								<td>  <?php echo e($cls->subname); ?></td>
								<td> <?php echo e($cls->chapname); ?> </td>  
								<td><?php echo e($cls->name); ?></td>                   
								
								
								<td> <?=(!empty($cls->status)&& $cls->status== 1 ? 'Active' : 'In Active');?> </td>
								
								<?php if(Auth::user()->role_id == '1' ): ?>					
								<td>
								 
								  <a class="btn btn-info btn-xs edit-btn" title="Update" href="<?php echo e(route('admin.concepts.edit', $cls->id)); ?>"> <i class="fas fa-pencil-alt"></i></a>
								   <form action="<?php echo e(route('admin.concepts.destroy', $cls->id)); ?>" method="POST">
										  <?php echo csrf_field(); ?>
										  <?php echo method_field('DELETE'); ?>
									   <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
									 </form>
								</td> 
								<?php endif; ?>
								
								  
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
						
						
					</table>
					
					<?php if(empty($count)): ?>
							<div class="d-flex justify-content-center no-record"> No record found </div>
					<?php endif; ?>
					
					<div class="d-flex justify-content-center">
					   <?php echo e($results->appends(request()->query())->links()); ?>

					</div>
				</div>
			</div>
			</div>
			</div>
		</div>
    </section>
    
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/admin/concepts/index.blade.php ENDPATH**/ ?>