
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
				<div class="col-12">
					<h1 class="act-header">All Teachers</h1>					
					 <a href="<?php echo e(route('admin.students.create')); ?>" class="create-btn"> <input type="submit" value="Add" class="btn btn-sm btn-success "></a>
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
							<form class="form-inline fltr-row " type="get" action="<?php echo e(route('admin.students.index')); ?>">				
								
								

							   <?php if(!empty($_GET['name'])){ $name = $_GET['name'];}else{ $name='';  } ?> 
								
								<div class="fltr-srch form-group">                	 
										<input type="search" name="name" value="<?=$name?>" id="name" class="form-control  fltr-txt-bx <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  placeholder="Search School" width="180px">
										
										<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>
									
							</form>
						</div>
					</div>
				</div>
        
		
        <div class="card-body table-responsive p-0">
         <table class="table table-striped projects">
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
                 
				
                  <tr>
                      <td>
                          <?php echo e(++$i); ?>

                      </td>
                      <td>
					  
                      </td>
					  <td>
                       
                      </td>
					   <td>
                          
                      </td>
					  <td>
                          
                      </td>
                      
                      
                      <td class="project-actions text-right">
                          
                          <a class="btn btn-info btn-xs edit-btn" title="Update" href=""><i class="fas fa-pencil-alt"></i></a>
                              
                           
						  
						 
                          <form action="" method="post">
							<?php echo csrf_field(); ?>
							<?php echo method_field('DELETE'); ?>
						 <button  class="btn btn-danger btn-xs delete-btn" type="submit" title="Delete" onclick="return confirm('Do you want to delete ?')" ><i class="fa fa-trash" aria-hidden="true" ></i></button>
						</form>
						
                      </td>
					 
                  </tr>
                  
			  
                  
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/admin/students/index.blade.php ENDPATH**/ ?>