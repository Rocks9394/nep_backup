
<?php $__env->startSection('title', 'Teacher - Goforfit'); ?>

<?php $__env->startSection('content'); ?>
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper" id="class-main">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<h1 class="act-header">All Teachers</h1>					
					 <a href="<?php echo e(route('admin.teachers.create')); ?>" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
				</div>
			</div>
		</div>
    </section>
	
    <!-- Main content -->
     <section class="content">
		<div class="container-fluid">
			<div class="row">
			<div class="col-md-12">
			<div class="card">
			
				<div class="card-header filter-head">  
					<div class="row">
						<div class="col-md-12">					
							<form class="form-inline fltr-row " type="get" action="<?php echo e(route('admin.teachers.index')); ?>">				
								
								

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  placeholder="Search Teacher" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>
						</div>
					</div>
				</div>
        
		<div class="row"> 
					<div class="col-12 div-count">
						<div class="fltr-count">Teachers: <span class="no-counts"><?php echo e($count); ?><span></div>
					</div>
				</div>
		
		
        <div class="card-body table-responsive p-0 user-info">
         <table class="table table-striped projects table-grid grid-6">
              <thead>
                  <tr class="thead-dark">
                      <th>
                          #
                      </th>
                      <th>
                          Name
                      </th>
                      
                      <th class="text-left">
                          Email
                      </th>
					  <th>
                         Phone
                      </th>
                      
                      <th class="text-left">
                          State/District
                      </th>
					  <th class="text-left">
                          Action
                      </th>
					  
					  
					  
                      
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                 
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td>
                          <?php echo e(++$i); ?>

                      </td>
                      <td>
					  <?php echo e($user->name); ?>

                      </td>
					  <td>
                        <?php echo e($user->email); ?> 
                      </td>
					   <td>
                          <?php echo e($user->phone); ?>  
                      </td>
					  <td>
                          <?php echo e($user->state); ?> /  <?php echo e($user->district); ?> 
                      </td>
                      
                      
                      <td>
                          
                          <a class="btn btn-info btn-xs edit-btn" title="Update" href="<?php echo e(route('admin.teachers.edit', $user->id)); ?>"><i class="fas fa-pencil-alt"></i></a>
                              
                           
						  
						 
                          <form action="<?php echo e(route('admin.teachers.destroy', $user->id)); ?>" method="post">
							<?php echo csrf_field(); ?>
							<?php echo method_field('DELETE'); ?>
						 <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
						</form>
						
                      </td>
					 
                  </tr>
                  
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
                  
              </tbody>
          </table>
		  <div class="d-flex justify-content-center"><?php echo e($users->appends(request()->input())->links()); ?></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/admin/teachers/index.blade.php ENDPATH**/ ?>